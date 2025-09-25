<?php
// php/classes/PercentageDiscount.php
require_once __DIR__ . '/DiscountStrategyInterface.php';

class PercentageDiscount implements DiscountStrategyInterface
{
    private float $percent; // ex: 10 para 10%

    public function __construct(float $percent)
    {
        $this->percent = max(0, $percent);
    }

    public function calculate(float $subtotal, array $context = []): float
    {
        return round($subtotal * ($this->percent / 100.0), 2);
    }

    public function getLabel(): string { return "{$this->percent}% off"; }
}
