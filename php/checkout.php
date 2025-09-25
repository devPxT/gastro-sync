<?php

require_once __DIR__ . '/php/bootstrap.php'; // autoload + registro

$method = $_POST['method'] ?? 'cash';
$amount = $order->total;
$data = $_POST; // sanitize antes!

try {
    // se algum creator precisa de opções/deps, passe-as como segundo argumento
    $strategy = PaymentFactory::create($method, ['gateway' => $mpClient ?? null]);
} catch (Exception $e) {
    echo "<div class='alert alert-danger'>Método de pagamento inválido</div>";
    exit;
}

$context = new PaymentContext($strategy);
if ($context->pay($amount, $data)) {
    $receipt = $context->getReceipt();
    // persistir, logar, etc.
} else {
    echo "<div class='alert alert-danger'>Pagamento falhou.</div>";
}
