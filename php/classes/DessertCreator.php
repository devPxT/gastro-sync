<?php
// php/classes/DessertCreator.php
require_once __DIR__ . '/MenuItemCreator.php';
require_once __DIR__ . '/Dessert.php';

class DessertCreator extends MenuItemCreator
{
    public function create(array $data): MenuItem
    {
        return new Dessert($data['name'], (float)$data['price'], $data['sweetness'] ?? null);
    }
}
