<?php
// php/classes/InventoryObserverInterface.php
interface InventoryObserverInterface
{
    /**
     * @param InventorySubject $subject
     * @param array $ingredient associative row (id, name, quantity, threshold, unit)
     * @return void
     */
    public function updateInventory(InventorySubject $subject, array $ingredient): void;
}
