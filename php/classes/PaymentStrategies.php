<?php
// php/classes/PaymentStrategies.php
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

class CardPayment implements PaymentStrategyInterface
{
    private array $receipt = [];

    public function pay(float $amount, array $data): bool
    {
        if (empty($data['card_number'])) {
            return false;
        }
        // simula autorização de cartão
        $this->receipt = [
            'method' => 'Cartão',
            'amount' => $amount,
            'card' => '****' . substr($data['card_number'], -4),
            'installments' => $data['installments'] ?? 1
        ];
        return true;
    }

    public function getReceiptInfo(): array
    {
        return $this->receipt;
    }
}

class PixPayment implements PaymentStrategyInterface
{
    private array $receipt = [];

    public function pay(float $amount, array $data): bool
    {
        $key = $data['pix_key'] ?? null;
        if (!$key) return false;
        $this->receipt = [
            'method' => 'PIX',
            'amount' => $amount,
            'pix_key' => $key,
            'txid' => bin2hex(random_bytes(6))
        ];
        return true;
    }

    public function getReceiptInfo(): array
    {
        return $this->receipt;
    }
}
