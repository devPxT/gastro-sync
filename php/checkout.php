<?php

require_once __DIR__ . '/php/bootstrap.php'; // autoload + registro
require_once __DIR__ . '/php/classes/DbConnection.php';
require_once __DIR__ . '/php/classes/Logger.php';
require_once __DIR__ . '/php/classes/Order.php';
require_once __DIR__ . '/php/classes/PaymentFactory.php';
require_once __DIR__ . '/php/classes/PaymentContext.php';

// Strategy de desconto
$order = new Order();
$order->items = [
    ['menu_item_id' => 1, 'name' => 'X-Burguer', 'price' => 18.50, 'quantity' => 1],
    ['menu_item_id' => 3, 'name' => 'Suco', 'price' => 6.00, 'quantity' => 1],
];

// --- 1) aplicar desconto (se tiver) ---
$discountStrategy = new PercentageDiscount(10); // por exemplo
$discountInfo = $order->applyDiscount($discountStrategy, []);
$amountToPay = $discountInfo['total'];

// --- 2) executar pagamento via PaymentFactory/Strategy ---
$method = $_POST['method'] ?? 'cash';
$data = $_POST; // sanitize na prática!

try {
    // se algum creator precisa de opções/deps, passe-as como segundo argumento
    $strategy = PaymentFactory::create($method, ['gateway' => $mpClient ?? null]);
} catch (Exception $e) {
    echo "<div class='alert alert-danger'>Método de pagamento inválido</div>";
    exit;
}

$paymentContext = new PaymentContext($strategy);
$paymentOk = $paymentContext->pay($amountToPay, $data);

if (! $paymentOk) {
    echo "<div class='alert alert-danger'>Pagamento falhou.</div>";
    exit;
}

// pagamento ok -> persistir pedido + consumir estoque em transação
$conn = DbConnection::getInstance()->getConnection();

try {
    $conn->begin_transaction();

    // inserir orders
    $customerName = $_POST['customer_name'] ?? 'Cliente';
    $tableNumber = $_POST['table_number'] ?? null;
    $status = 'paid';
    $total = $amountToPay;

    $stmtOrder = $conn->prepare("INSERT INTO orders (customer_name, table_number, total, status) VALUES (?, ?, ?, ?)");
    $stmtOrder->bind_param('ssds', $customerName, $tableNumber, $total, $status);
    $stmtOrder->execute();
    $orderId = $stmtOrder->insert_id;
    $stmtOrder->close();

    // preparar stmt com menu_item_id conhecido
    $stmtItemWithId = $conn->prepare("INSERT INTO order_items (order_id, menu_item_id, name, price, quantity) VALUES (?, ?, ?, ?, ?)");
    // preparar stmt sem menu_item_id (inserir NULL)
    $stmtItemWithoutId = $conn->prepare("INSERT INTO order_items (order_id, menu_item_id, name, price, quantity) VALUES (?, NULL, ?, ?, ?)");

    foreach ($order->items as $it) {
        $qty = (int)($it['quantity'] ?? 1);
        $price = (float)($it['price'] ?? 0.0);
        $name = (string)($it['name'] ?? '');
        $menuItemId = isset($it['menu_item_id']) ? (int)$it['menu_item_id'] : null;

        // if ($menuItemId) {
        //     $stmtItemWithId->bind_param('iisd i', $orderId, $menuItemId, $name, $price, $qty);
        //     // note: correct types => i (order_id), i (menu_item_id), s (name), d (price), i (quantity)
        //     // but bind_param expects a string types param - we'll use 'iisd i' not allowed; we'll use correct below
        // }

        // // Because bind_param requires a single types string, we'll do properly:
        // if ($menuItemId) {
        //     $stmtItemWithId->bind_param('iisd i', $orderId, $menuItemId, $name, $price, $qty); // placeholder - replaced below by correct block
        // } else {
        //     $stmtItemWithoutId->bind_param('issd', $orderId, $name, $price, $qty); // placeholder - replaced below by correct block
        // }

        // --- Simples e robusto: use queries mais diretas para evitar confusão no exemplo ---
        if ($menuItemId) {
            $nameEsc = $conn->real_escape_string($name);
            $conn->query("INSERT INTO order_items (order_id, menu_item_id, name, price, quantity) VALUES ({$orderId}, {$menuItemId}, '{$nameEsc}', {$price}, {$qty})");
        } else {
            $nameEsc = $conn->real_escape_string($name);
            $conn->query("INSERT INTO order_items (order_id, menu_item_id, name, price, quantity) VALUES ({$orderId}, NULL, '{$nameEsc}', {$price}, {$qty})");
        }

        // --- 3) consumir ingredientes via InventorySubject ---
        // preferível: menu_item_id disponível e válido (usado pela recipes table)
        if ($menuItemId && isset($GLOBALS['INVENTORY_SUBJECT'])) {
            // chama o método que decrementa o estoque e notifica observers se necessário
            $GLOBALS['INVENTORY_SUBJECT']->consumeIngredientsForMenuItem($menuItemId, $qty);
        } else {
            // alternativa: tentar descobrir menu_item_id pela coluna name (menos robusto)
            if (isset($GLOBALS['INVENTORY_SUBJECT'])) {
                $safeName = $conn->real_escape_string($name);
                $row = $conn->query("SELECT id FROM menu_items WHERE name = '{$safeName}' LIMIT 1")->fetch_assoc();
                if ($row && isset($row['id'])) {
                    $foundId = (int)$row['id'];
                    $GLOBALS['INVENTORY_SUBJECT']->consumeIngredientsForMenuItem($foundId, $qty);
                } else {
                    // sem menu_item_id e sem match por nome: não decrementar automaticamente
                    Logger::getInstance()->log('warning', 'Não foi possível identificar menu_item_id para decrementar estoque', ['name' => $name]);
                }
            }
        }
    }

    // commit se tudo ok
    $conn->commit();

    // mostrar recibo / sucesso
    $receipt = $paymentContext->getReceipt();
    echo "<div class='alert alert-success'>Pagamento efetuado e pedido criado (id: {$orderId})</div>";
    echo "<pre>" . htmlspecialchars(json_encode($receipt, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) . "</pre>";

    // notificar cozinheiro, garçom e log através do OrderSubject (Observer)
    try {
        if (isset($GLOBALS['ORDER_SUBJECT']) && is_object($GLOBALS['ORDER_SUBJECT'])) {
            // Atualiza status do pedido e notifica observers.
            // Observers recebem o order atualizado, oldStatus->newStatus.
            // Aqui escolhemos 'preparing' para sinalizar a cozinha que precisa iniciar.
            $notifyOk = $GLOBALS['ORDER_SUBJECT']->updateStatus($orderId, 'preparing');
            if (! $notifyOk) {
                // caso updateStatus retorne false, logamos
                Logger::getInstance()->log('warning', "Falha ao notificar ORDER_SUBJECT para order {$orderId}");
            }
        } else {
            // fallback: log se não há subject registrado
            Logger::getInstance()->log('warning', 'ORDER_SUBJECT não encontrado ao tentar notificar após checkout', ['order_id' => $orderId]);
        }
    } catch (Throwable $ex) {
        // observer falhou — não reverte o pedido, apenas loga o erro
        Logger::getInstance()->log('error', 'Exceção ao notificar observers após checkout: ' . $ex->getMessage(), ['order_id' => $orderId]);
    }

} catch (Throwable $e) {
    $conn->rollback();
    Logger::getInstance()->log('error', 'Erro ao criar pedido/atualizar estoque: ' . $e->getMessage());
    echo "<div class='alert alert-danger'>Erro interno ao processar o pedido. Tente novamente.</div>";
    exit;
}
