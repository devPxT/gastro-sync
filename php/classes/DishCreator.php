<?php
// php/classes/DishCreator.php
require_once __DIR__ . '/MenuItemCreator.php';
require_once __DIR__ . '/Dish.php';

class DishCreator extends MenuItemCreator
{
    public function create(array $data): MenuItem
    {
        return new Dish($data['name'], (float)$data['price'], $data['size'] ?? 'M');
    }
}
