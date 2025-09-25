<?php
require_once __DIR__ . '/autoload.php';

// registrar creators das strategies
require_once __DIR__ . '/classes/PaymentFactory.php';

// register tipos pagamento
PaymentFactory::register('cash', function($opts = []) {
    return new CashPayment();
});

PaymentFactory::register('card', function($opts = []) {
    // se você tiver um gateway client criado em bootstrap, injete aqui via $opts['gateway'] ou variável externa
    $gateway = $opts['gateway'] ?? null;
    return new CardPayment($gateway);
});

PaymentFactory::register('pix', function($opts = []) {
    $pixClient = $opts['pix_client'] ?? null;
    return new PixPayment($pixClient);
});
// register tipos pagamento

// registrar observers globais
// criar subject (pode manter instância em variável global ou injetar em services)
$inventorySubject = new InventorySubject();

// anexa observers
$inventorySubject->attach(new LowStockLogObserver());
$inventorySubject->attach(new LowStockEmailObserver(['chef@restaurante.com','gerente@restaurante.com']));
$inventorySubject->attach(new LowStockReorderObserver(2.0));

// opcional: guardar no container simples/global para reutilizar
$GLOBALS['INVENTORY_SUBJECT'] = $inventorySubject;
