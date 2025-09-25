<?php
// php/classes/CashPayment.php
require_once __DIR__ . '/PaymentStrategyInterface.php';

class CashPayment implements PaymentStrategyInterface
{
    private array $receipt = [];

    public function pay(float $amount, array $data): bool
    {
        $received = $data['received'] ?? $amount;
        if ($received < $amount) {
            return false;
        }
        $this->receipt = [
            'method' => 'Dinheiro',
            'amount' => $amount,
            'received' => $received,
            'change' => $received - $amount
        ];
        return true;
    }

    public function getReceiptInfo(): array
    {
        return $this->receipt;
    }
}
