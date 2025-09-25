<?php
// php/classes/MenuItemCreator.php
require_once __DIR__ . '/MenuItem.php';

abstract class MenuItemCreator
{
    /**
     * Factory Method - cada subclasse cria o MenuItem apropriado.
     * @param array $data
     * @return MenuItem
     */
    abstract public function create(array $data): MenuItem;

    /**
     * Hook: validação/etapas comuns antes da criação.
     * Pode lançar exceções em caso de dados inválidos.
     */
    public function createWithValidation(array $data): MenuItem
    {
        if (empty($data['name']) || !isset($data['price'])) {
            throw new InvalidArgumentException('Dados inválidos para criar MenuItem (name/price obrigatórios).');
        }
        return $this->create($data);
    }
}
