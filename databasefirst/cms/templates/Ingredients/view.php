<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ingredient $ingredient
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Ingredient'), ['action' => 'edit', $ingredient->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Ingredient'), ['action' => 'delete', $ingredient->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ingredient->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Ingredients'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Ingredient'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="ingredients view content">
            <h3><?= h($ingredient->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Sku') ?></th>
                    <td><?= h($ingredient->sku) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($ingredient->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Unit') ?></th>
                    <td><?= h($ingredient->unit) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($ingredient->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Stock Qty') ?></th>
                    <td><?= $ingredient->stock_qty === null ? '' : $this->Number->format($ingredient->stock_qty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Stock Threshold') ?></th>
                    <td><?= $ingredient->stock_threshold === null ? '' : $this->Number->format($ingredient->stock_threshold) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cost Price') ?></th>
                    <td><?= $ingredient->cost_price === null ? '' : $this->Number->format($ingredient->cost_price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($ingredient->updated_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Active') ?></th>
                    <td><?= $ingredient->active ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Inventory Movements') ?></h4>
                <?php if (!empty($ingredient->inventory_movements)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Ingredient Id') ?></th>
                            <th><?= __('Type') ?></th>
                            <th><?= __('Qty') ?></th>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Created By') ?></th>
                            <th><?= __('Created At') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($ingredient->inventory_movements as $inventoryMovement) : ?>
                        <tr>
                            <td><?= h($inventoryMovement->id) ?></td>
                            <td><?= h($inventoryMovement->ingredient_id) ?></td>
                            <td><?= h($inventoryMovement->type) ?></td>
                            <td><?= h($inventoryMovement->qty) ?></td>
                            <td><?= h($inventoryMovement->reference) ?></td>
                            <td><?= h($inventoryMovement->created_by) ?></td>
                            <td><?= h($inventoryMovement->created_at) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'InventoryMovements', 'action' => 'view', $inventoryMovement->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'InventoryMovements', 'action' => 'edit', $inventoryMovement->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'InventoryMovements', 'action' => 'delete', $inventoryMovement->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $inventoryMovement->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Menu Item Ingredients') ?></h4>
                <?php if (!empty($ingredient->menu_item_ingredients)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Menu Item Id') ?></th>
                            <th><?= __('Ingredient Id') ?></th>
                            <th><?= __('Qty Per Item') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($ingredient->menu_item_ingredients as $menuItemIngredient) : ?>
                        <tr>
                            <td><?= h($menuItemIngredient->menu_item_id) ?></td>
                            <td><?= h($menuItemIngredient->ingredient_id) ?></td>
                            <td><?= h($menuItemIngredient->qty_per_item) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'MenuItemIngredients', 'action' => 'view', $menuItemIngredient->menu_item_id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'MenuItemIngredients', 'action' => 'edit', $menuItemIngredient->menu_item_id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'MenuItemIngredients', 'action' => 'delete', $menuItemIngredient->menu_item_id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $menuItemIngredient->menu_item_id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>