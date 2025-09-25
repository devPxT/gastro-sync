<?php
// php/classes/Dish.php
require_once __DIR__ . '/MenuItem.php';

class Dish extends MenuItem
{
    public string $size;

    public function __construct(string $name, float $price, string $size = 'M')
    {
        parent::__construct($name, $price);
        $this->type = 'dish';
        $this->size = $size;
    }

    public function getDescription(): string
    {
        return "{$this->name} (Prato) - Tamanho: {$this->size} - R$ " . number_format($this->price, 2, ',', '.');
    }
}
