<?php
// php/classes/MenuFactory.php
require_once __DIR__ . '/MenuItemCreator.php';

class MenuFactory
{
    /**
     * Retorna um MenuItem criado via Factory Method (delegando ao Creator concreto).
     *
     * @param string $kind - 'dish'|'drink'|'combo'|'dessert'
     * @param array $data
     * @return MenuItem
     * @throws InvalidArgumentException
     */
    public static function create(string $kind, array $data): MenuItem
    {
        $creator = self::createCreatorForKind($kind);
        return $creator->createWithValidation($data);
    }

    /**
     * Instancia o Creator apropriado para o tipo pedido.
     * Aqui é onde se "escolhe" a subclasse do Factory Method.
     *
     * @param string $kind
     * @return MenuItemCreator
     * @throws InvalidArgumentException
     */
    private static function createCreatorForKind(string $kind): MenuItemCreator
    {
        switch (strtolower($kind)) {
            case 'dish':
                require_once __DIR__ . '/DishCreator.php';
                return new DishCreator();
            case 'drink':
                require_once __DIR__ . '/DrinkCreator.php';
                return new DrinkCreator();
            case 'combo':
                require_once __DIR__ . '/ComboCreator.php';
                return new ComboCreator();
            case 'dessert':
                require_once __DIR__ . '/DessertCreator.php';
                return new DessertCreator();
            default:
                throw new InvalidArgumentException("Tipo inválido na MenuFactory: {$kind}");
        }
    }
}
