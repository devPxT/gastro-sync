<?php
// php/classes/Combo.php
require_once __DIR__ . '/MenuItem.php';

class Combo extends MenuItem
{
    public array $items;

    public function __construct(string $name, array $items, float $price)
    {
        parent::__construct($name, $price);
        $this->type = 'combo';
        $this->items = $items;
    }

    public function getDescription(): string
    {
        $parts = array_map(fn($i) => $i->name, $this->items);
        return "{$this->name} (Combo: " . implode(', ', $parts) . ") - R$ " . number_format($this->price, 2, ',', '.');
    }
}
