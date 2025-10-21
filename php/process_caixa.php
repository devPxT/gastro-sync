<?php
// php/process_caixa.php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/classes/DbConnection.php';
require_once __DIR__ . '/classes/Logger.php';
require_once __DIR__ . '/classes/PaymentFactory.php';
require_once __DIR__ . '/classes/PaymentContext.php';

// session + ACL
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/templates/acl.php';
requirePermissionOrRedirect($_SESSION['user_id'] ?? 0, 'caixa.view');

// pegar POST
$customerName = trim($_POST['customer_name'] ?? '');
$tableNumber  = trim($_POST['table_number'] ?? '');
$cartJson     = $_POST['cart_json'] ?? '[]';
$paymentMethod= $_POST['payment_method'] ?? 'cash';
$discountType = $_POST['discount_type'] ?? 'none';
$discountVal  = floatval($_POST['discount_value'] ?? 0.0);
$paymentData  = $_POST; // extra payment fields passed to strategy

$cartClient = json_decode($cartJson, true);
if (!is_array($cartClient) || count($cartClient) === 0) {
    $_SESSION['flash_alert'] = 'Carrinho vazio.';
    header('Location: ../caixa.php'); exit;
}

$conn = DbConnection::getInstance()->getConnection();

try {
    // Validate: collect menu_item_ids from client
    $ids = array_map(fn($i) => intval($i['id'] ?? 0), $cartClient);
    $ids = array_values(array_filter($ids, fn($v) => $v > 0));
    if (count($ids) === 0) {
        $_SESSION['flash_alert'] = 'Itens inválidos no carrinho.';
        header('Location: ../caixa.php'); exit;
    }

    // fetch items from DB (prevenir manipulação de preço)
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $types = str_repeat('i', count($ids));
    $sql = "SELECT id, name, price FROM menu_items WHERE id IN ($placeholders)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) throw new Exception("Prepare failed: " . $conn->error);
    // bind params dynamically
    $bind_names[] = $types;
    for ($i=0; $i<count($ids); $i++) {
        $bind_name = 'param' . $i;
        $$bind_name = $ids[$i];
        $bind_names[] = &$$bind_name;
    }
    call_user_func_array([$stmt, 'bind_param'], $bind_names);
    $stmt->execute();
    $res = $stmt->get_result();
    $dbItems = [];
    while ($r = $res->fetch_assoc()) $dbItems[intval($r['id'])] = $r;
    $stmt->close();

    // Ensure all ids exist
    foreach ($ids as $id) {
        if (!isset($dbItems[$id])) {
            $_SESSION['flash_alert'] = "Item do cardápio (id={$id}) não encontrado.";
            header('Location: ../caixa.php'); exit;
        }
    }

    // rebuild server-side cart using DB prices/names
    $serverCart = [];
    foreach ($cartClient as $entry) {
        $id = intval($entry['id'] ?? 0);
        $qty = max(1, intval($entry['qty'] ?? 1));
        if (!isset($dbItems[$id])) continue;
        $serverCart[] = [
            'id' => $id,
            'name' => $dbItems[$id]['name'],
            'price' => floatval($dbItems[$id]['price']),
            'qty' => $qty
        ];
    }
    if (count($serverCart) === 0) {
        $_SESSION['flash_alert'] = 'Carrinho inválido.';
        header('Location: ../caixa.php'); exit;
    }

    // compute totals
    $subtotal = 0.0;
    foreach ($serverCart as $it) $subtotal += $it['price'] * $it['qty'];
    $discount = 0.0;
    if ($discountType === 'percent') $discount = $subtotal * ($discountVal/100.0);
    elseif ($discountType === 'fixed') $discount = $discountVal;
    $discount = max(0.0, min($discount, $subtotal));
    $total = round($subtotal - $discount, 2);

    // Begin transaction
    $conn->begin_transaction();

    // insert order (status paid then will be set to preparing via ORDER_SUBJECT)
    $stmt = $conn->prepare("INSERT INTO orders (customer_name, table_number, total, discount, status) VALUES (?, ?, ?, ?, 'paid')");
    if ($stmt === false) throw new Exception("Prepare failed: " . $conn->error);
    $stmt->bind_param('ssdd', $customerName, $tableNumber, $total, $discount);
    $stmt->execute();
    $orderId = $stmt->insert_id;
    $stmt->close();

    // insert order items (prepared once)
    $stmtItem = $conn->prepare("INSERT INTO order_items (order_id, menu_item_id, name, price, quantity) VALUES (?, ?, ?, ?, ?)");
    if ($stmtItem === false) throw new Exception("Prepare failed: " . $conn->error);

    foreach ($serverCart as $it) {
        $stmtItem->bind_param('iisdi', $orderId, $it['id'], $it['name'], $it['price'], $it['qty']);
        $stmtItem->execute();
    }
    $stmtItem->close();

    // process payment via factory/strategy
    $strategy = PaymentFactory::create($paymentMethod, []);
    $context = new PaymentContext($strategy);
    $paid = $context->pay($total, $paymentData);
    if (! $paid) {
        $conn->rollback();
        $_SESSION['flash_alert'] = 'Pagamento falhou. Verifique os dados.';
        header('Location: ../caixa.php'); exit;
    }

    // persist payment record (save receipt JSON)
    $receipt = $context->getReceipt();
    $receiptJson = json_encode($receipt, JSON_UNESCAPED_UNICODE);
    $stmtPay = $conn->prepare("INSERT INTO payments (order_id, method, amount, data) VALUES (?, ?, ?, ?)");
    if ($stmtPay === false) throw new Exception("Prepare failed: " . $conn->error);
    $stmtPay->bind_param('isds', $orderId, $paymentMethod, $total, $receiptJson);
    $stmtPay->execute();
    $stmtPay->close();

    // commit
    $conn->commit();

    // AFTER COMMIT: decrement ingredients and notify kitchen
    if (isset($GLOBALS['INVENTORY_SUBJECT'])) {
        foreach ($serverCart as $it) {
            try {
                $GLOBALS['INVENTORY_SUBJECT']->consumeIngredientsForMenuItem(intval($it['id']), intval($it['qty']));
            } catch (Throwable $e) {
                Logger::getInstance()->log('error', "Erro ao decrementar estoque para menu_item {$it['id']}: " . $e->getMessage(), ['order_id'=>$orderId]);
            }
        }
    }

    // notify order subject to set status to preparing and notify observers (kitchen)
    if (isset($GLOBALS['ORDER_SUBJECT'])) {
        try {
            $GLOBALS['ORDER_SUBJECT']->updateStatus($orderId, 'preparing');
        } catch (Throwable $e) {
            Logger::getInstance()->log('error', "Erro ao notificar ORDER_SUBJECT: " . $e->getMessage(), ['order_id'=>$orderId]);
        }
    }

    $_SESSION['flash_alert'] = "Pedido #{$orderId} registrado. Total: R$ " . number_format($total, 2, ',', '.');
    header('Location: ../home.php');
    exit;

} catch (Throwable $e) {
    // rollback if in transaction
    if ($conn->in_transaction) $conn->rollback();
    Logger::getInstance()->log('error', 'Erro process_caixa: ' . $e->getMessage(), ['post'=>$_POST]);
    $_SESSION['flash_alert'] = 'Erro interno ao processar pedido. Tente novamente.';
    header('Location: ../caixa.php');
    exit;
}
