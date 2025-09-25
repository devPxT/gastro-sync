<?php

require_once __DIR__ . '/php/bootstrap.php'; // autoload + registro

// Strategy de desconto
$order = new Order();
$order->items = [
    ['name'=>'X-Burguer','price'=>18.5,'quantity'=>1],
    ['name'=>'Suco','price'=>6.0,'quantity'=>1]
];

// escolher estratégia (p.ex. vindo do admin, cupom, cliente)
$discountStrategy = new PercentageDiscount(10); // 10%
$result = $order->applyDiscount($discountStrategy);

// então usar $result['total'] para criar pagamento
$amountToPay = $result['total'];
// Strategy de desconto


// Strategy de pagamento com Factory
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
// Strategy de pagamento com Factory
