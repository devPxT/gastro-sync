<?php
// php/classes/CardPayment.php
require_once __DIR__ . '/PaymentStrategyInterface.php';

class CardPayment implements PaymentStrategyInterface
{
    private array $receipt = [];
    private $gatewayClient; // opcional: injetar cliente de gateway

    public function __construct($gatewayClient = null)
    {
        $this->gatewayClient = $gatewayClient;
    }

    public function pay(float $amount, array $data): bool
    {
        // NÃO armazene ou logue o número completo do cartão em produção.
        if (empty($data['card_number'])) {
            return false;
        }

        // Se tiver um client real, use-o. Aqui, simulamos autorização.
        $authorized = true; // substituir por $this->gatewayClient->authorize(...)

        if (! $authorized) {
            return false;
        }

        $this->receipt = [
            'method' => 'Cartão',
            'amount' => $amount,
            'card' => '****' . substr($data['card_number'], -4),
            'installments' => $data['installments'] ?? 1,
            'auth' => 'SIMULATED-AUTH' // em real gateway use o código da autorização
        ];
        return true;
    }

    public function getReceiptInfo(): array
    {
        return $this->receipt;
    }
}
