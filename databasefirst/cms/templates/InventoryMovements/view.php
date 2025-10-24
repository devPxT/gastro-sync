<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InventoryMovement $inventoryMovement
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Inventory Movement'), ['action' => 'edit', $inventoryMovement->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Inventory Movement'), ['action' => 'delete', $inventoryMovement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $inventoryMovement->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Inventory Movements'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Inventory Movement'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="inventoryMovements view content">
            <h3><?= h($inventoryMovement->type) ?></h3>
            <table>
                <tr>
                    <th><?= __('Ingredient') ?></th>
                    <td><?= $inventoryMovement->hasValue('ingredient') ? $this->Html->link($inventoryMovement->ingredient->name, ['controller' => 'Ingredients', 'action' => 'view', $inventoryMovement->ingredient->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= h($inventoryMovement->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Reference') ?></th>
                    <td><?= h($inventoryMovement->reference) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($inventoryMovement->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qty') ?></th>
                    <td><?= $this->Number->format($inventoryMovement->qty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $inventoryMovement->created_by === null ? '' : $this->Number->format($inventoryMovement->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($inventoryMovement->created_at) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>