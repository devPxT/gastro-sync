<?php
// php/classes/NoDiscount.php
require_once __DIR__ . '/DiscountStrategyInterface.php';

class NoDiscount implements DiscountStrategyInterface
{
    public function calculate(float $subtotal, array $context = []): float
    {
        return 0.0;
    }
    public function getLabel(): string { return 'Sem desconto'; }
}
