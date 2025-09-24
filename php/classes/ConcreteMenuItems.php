<?php
// php/classes/ConcreteMenuItems.php
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

class Drink extends MenuItem
{
    public bool $alcoholic;

    public function __construct(string $name, float $price, bool $alcoholic = false)
    {
        parent::__construct($name, $price);
        $this->type = 'drink';
        $this->alcoholic = $alcoholic;
    }

    public function getDescription(): string
    {
        $alc = $this->alcoholic ? 'Alcoólico' : 'Não alcoólico';
        return "{$this->name} (Bebida) - {$alc} - R$ " . number_format($this->price, 2, ',', '.');
    }
}

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
