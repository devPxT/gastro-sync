<?php
// php/bootstrap.php
require_once __DIR__ . '/autoload.php';

/**
 * Garante diretório de logs portável (Windows/Linux).
 * Retorna o caminho do diretório de logs efetivo (pode ser sys_get_temp_dir() como fallback).
 */
function ensure_logs_dir(): string
{
    // path desejado (projeto-root/logs)
    $preferred = realpath(__DIR__ . '/..') . DIRECTORY_SEPARATOR . 'logs';

    // se já existe, só retorna (e garante permissões escritas)
    if (is_dir($preferred)) {
        if (is_writable($preferred)) return $preferred;
        // existe mas não é gravável: tentamos continuar (pode falhar ao escrever)
        return $preferred;
    }

    // tentar criar com recursividade
    $ok = @mkdir($preferred, 0775, true);
    if ($ok && is_dir($preferred)) {
        return $preferred;
    }

    // se falhou, tenta criar em sys_get_temp_dir() (fallback seguro)
    $tmp = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'my_restaurant_logs';
    if (!is_dir($tmp)) {
        @mkdir($tmp, 0775, true);
    }
    // se mesmo assim não deu, lançar warning e usar tmp do sistema (pode sempre escrever aí)
    return $tmp;
}

// usar a função
$logsDir = ensure_logs_dir();

// criar arquivos padrão se não existirem
$defaultFiles = [
    'inventory.log',
    'reorders.log',
    'email.log',
    'kitchen.log',
    'waiter.log',
    'orders.log',
    'app.log'
];

foreach ($defaultFiles as $f) {
    $path = $logsDir . DIRECTORY_SEPARATOR . $f;
    if (!file_exists($path)) {
        @file_put_contents($path, '', LOCK_EX);
    }
}

$GLOBALS['LOGS_DIR'] = $logsDir;

// opcional: verificar tudo gravável (só debug)
if (!is_writable($logsDir)) {
    // não interrompe a execução, mas registra aviso no error_log do PHP
    error_log("Warning: logs directory '{$logsDir}' is not writable by the webserver. Create it manually or adjust permissions.");
}
// --- fim do snippet ---

// TO DO: verificar se autoload cobre tudo, caso contrário adicionar requires manuais.
// se o autoload não cobrir, as require_once abaixo garantem que tudo esteja carregado
require_once __DIR__ . '/classes/PaymentFactory.php';

// Inventory observers/subject
require_once __DIR__ . '/classes/InventorySubject.php';
require_once __DIR__ . '/classes/InventoryObserverInterface.php';
require_once __DIR__ . '/classes/LowStockLogObserver.php';
require_once __DIR__ . '/classes/LowStockEmailObserver.php';
require_once __DIR__ . '/classes/LowStockReorderObserver.php';

// Order observers/subject
require_once __DIR__ . '/classes/OrderSubject.php';
require_once __DIR__ . '/classes/OrderObserverInterface.php';
require_once __DIR__ . '/classes/OrderLogObserver.php';
require_once __DIR__ . '/classes/OrderKitchenObserver.php';
require_once __DIR__ . '/classes/OrderWaiterObserver.php';

// Logger (se não autoload)
require_once __DIR__ . '/classes/Logger.php';

// register tipos pagamento (mantém como você já tinha)
PaymentFactory::register('cash', function($opts = []) {
    return new CashPayment();
});
PaymentFactory::register('card', function($opts = []) {
    $gateway = $opts['gateway'] ?? null;
    return new CardPayment($gateway);
});
PaymentFactory::register('pix', function($opts = []) {
    $pixClient = $opts['pix_client'] ?? null;
    return new PixPayment($pixClient);
});

// ------------------ Registrar observers globais ------------------

// InventorySubject + observers
$inventorySubject = new InventorySubject();
$inventorySubject->attach(new LowStockLogObserver());
$inventorySubject->attach(new LowStockEmailObserver(['chef@restaurante.com','gerente@restaurante.com']));
$inventorySubject->attach(new LowStockReorderObserver(2.0));
$GLOBALS['INVENTORY_SUBJECT'] = $inventorySubject;

// OrderSubject + observers
$orderSubject = new OrderSubject();
$orderSubject->attach(new OrderLogObserver());
$orderSubject->attach(new OrderKitchenObserver());
$orderSubject->attach(new OrderWaiterObserver('Garçom João'));
$GLOBALS['ORDER_SUBJECT'] = $orderSubject;
