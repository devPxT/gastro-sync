<?php
// php/classes/PaymentContext.php
require_once __DIR__ . '/PaymentStrategyInterface.php';

class PaymentContext
{
    private PaymentStrategyInterface $strategy;

    public function __construct(PaymentStrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    public function setStrategy(PaymentStrategyInterface $strategy): void
    {
        $this->strategy = $strategy;
    }

    public function pay(float $amount, array $data = []): bool
    {
        return $this->strategy->pay($amount, $data);
    }

    public function getReceipt(): array
    {
        return $this->strategy->getReceiptInfo();
    }
}
