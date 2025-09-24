<?php
// php/classes/PaymentStrategyInterface.php
interface PaymentStrategyInterface
{
    public function pay(float $amount, array $data): bool;
    public function getReceiptInfo(): array;
}
