<?php
// php/classes/Dessert.php
require_once __DIR__ . '/MenuItem.php';

class Dessert extends MenuItem
{
    public ?string $sweetness; // exemplo de meta info

    public function __construct(string $name, float $price, ?string $sweetness = null)
    {
        parent::__construct($name, $price);
        $this->type = 'dessert';
        $this->sweetness = $sweetness;
    }

    public function getDescription(): string
    {
        $s = $this->sweetness ? "Doçura: {$this->sweetness} - " : '';
        return "{$this->name} (Sobremesa) - {$s}R$ " . number_format($this->price, 2, ',', '.');
    }
}
