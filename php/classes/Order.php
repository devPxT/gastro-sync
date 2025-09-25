<?php
// php/classes/Order.php
require_once __DIR__ . '/MenuItem.php';
require_once __DIR__ . '/DiscountStrategyInterface.php';

class Order
{
    public ?int $id;
    public array $items = []; // cada item: ['name','price','quantity']
    public string $status = 'pending';

    public function __construct(?int $id = null)
    {
        $this->id = $id;
    }

    public function getSubtotal(): float
    {
        $sum = 0.0;
        foreach ($this->items as $it) {
            $sum += ((float)$it['price']) * ((int)$it['quantity']);
        }
        return round($sum, 2);
    }

    public function applyDiscount(DiscountStrategyInterface $strategy, array $context = []): array
    {
        $subtotal = $this->getSubtotal();
        $discountValue = $strategy->calculate($subtotal, $context);
        $total = max(0.0, round($subtotal - $discountValue, 2));
        return [
            'subtotal' => $subtotal,
            'discount' => $discountValue,
            'discount_label' => $strategy->getLabel(),
            'total' => $total
        ];
    }
}
