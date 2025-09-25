<?php
// php/classes/ComboCreator.php
require_once __DIR__ . '/MenuItemCreator.php';
require_once __DIR__ . '/Combo.php';
require_once __DIR__ . '/Dish.php'; // fallback caso items cheguem como dados crus

class ComboCreator extends MenuItemCreator
{
    public function create(array $data): MenuItem
    {
        $items = $data['items'] ?? [];
        $menuItems = array_map(function($it) {
            if ($it instanceof MenuItem) return $it;
            // se for array simples, cria um Dish como fallback
            return new Dish($it['name'], (float)$it['price'], $it['size'] ?? 'M');
        }, $items);
        return new Combo($data['name'], $menuItems, (float)$data['price']);
    }
}
