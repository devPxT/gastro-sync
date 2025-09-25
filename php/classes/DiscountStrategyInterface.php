<?php
// php/classes/DiscountStrategyInterface.php
interface DiscountStrategyInterface
{
    /**
     * Retorna o valor do desconto (valor absoluto) dado o subtotal.
     * @param float $subtotal
     * @param array $context dados extras (ex: customer, coupon)
     * @return float
     */
    public function calculate(float $subtotal, array $context = []): float;
    public function getLabel(): string;
}
