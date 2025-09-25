<?php
// php/classes/FixedAmountDiscount.php
require_once __DIR__ . '/DiscountStrategyInterface.php';

class FixedAmountDiscount implements DiscountStrategyInterface
{
    private float $amount;

    public function __construct(float $amount)
    {
        $this->amount = max(0, $amount);
    }

    public function calculate(float $subtotal, array $context = []): float
    {
        return min($this->amount, $subtotal); // não reduzir abaixo de zero
    }

    public function getLabel(): string { return "R$ " . number_format($this->amount, 2, ',', '.'); }
}
