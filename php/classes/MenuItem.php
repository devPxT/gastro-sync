<?php
// php/classes/MenuItem.php
abstract class MenuItem
{
    public string $name;
    public float $price;
    public string $type;

    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    abstract public function getDescription(): string;
}
