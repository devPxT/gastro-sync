<?php
// php/classes/DrinkCreator.php
require_once __DIR__ . '/MenuItemCreator.php';
require_once __DIR__ . '/Drink.php';

class DrinkCreator extends MenuItemCreator
{
    public function create(array $data): MenuItem
    {
        return new Drink($data['name'], (float)$data['price'], $data['alcoholic'] ?? false);
    }
}
