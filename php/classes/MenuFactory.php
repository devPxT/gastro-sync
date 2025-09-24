<?php
// php/classes/MenuFactory.php
require_once __DIR__ . '/ConcreteMenuItems.php';

class MenuFactory
{
    public static function create(string $kind, array $data): MenuItem
    {
        switch ($kind) {
            case 'dish':
                return new Dish($data['name'], (float)$data['price'], $data['size'] ?? 'M');
            case 'drink':
                return new Drink($data['name'], (float)$data['price'], $data['alcoholic'] ?? false);
            case 'combo':
                $items = $data['items'] ?? [];
                $menuItems = array_map(function($it) {
                    if ($it instanceof MenuItem) return $it;
                    return new Dish($it['name'], (float)$it['price'], $it['size'] ?? 'M');
                }, $items);
                return new Combo($data['name'], $menuItems, (float)$data['price']);
            default:
                throw new InvalidArgumentException("Tipo inválido: $kind");
        }
    }
}
