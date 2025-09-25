<?php
require_once __DIR__ . '/MenuItem.php';

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
