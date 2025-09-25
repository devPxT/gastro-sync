<?php
// php/classes/PixPayment.php
require_once __DIR__ . '/PaymentStrategyInterface.php';

class PixPayment implements PaymentStrategyInterface
{
    private array $receipt = [];
    private $pixClient; // opcional, para integração real

    public function __construct($pixClient = null)
    {
        $this->pixClient = $pixClient;
    }

    public function pay(float $amount, array $data): bool
    {
        $key = $data['pix_key'] ?? null;
        if (!$key) return false;

        // Em integração real, chamaria $this->pixClient->createPayment(...) e aguardaria confirmação.
        // Aqui simulamos pagamento instantâneo.
        $txid = bin2hex(random_bytes(6));
        $this->receipt = [
            'method' => 'PIX',
            'amount' => $amount,
            'pix_key' => $key,
            'txid' => $txid
        ];
        return true;
    }

    public function getReceiptInfo(): array
    {
        return $this->receipt;
    }
}
