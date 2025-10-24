<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MenuItemIngredient $menuItemIngredient
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Menu Item Ingredient'), ['action' => 'edit', $menuItemIngredient->menu_item_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Menu Item Ingredient'), ['action' => 'delete', $menuItemIngredient->menu_item_id], ['confirm' => __('Are you sure you want to delete # {0}?', $menuItemIngredient->menu_item_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Menu Item Ingredients'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Menu Item Ingredient'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="menuItemIngredients view content">
            <h3><?= h($menuItemIngredient->Array) ?></h3>
            <table>
                <tr>
                    <th><?= __('Menu Item') ?></th>
                    <td><?= $menuItemIngredient->hasValue('menu_item') ? $this->Html->link($menuItemIngredient->menu_item->name, ['controller' => 'MenuItems', 'action' => 'view', $menuItemIngredient->menu_item->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Ingredient') ?></th>
                    <td><?= $menuItemIngredient->hasValue('ingredient') ? $this->Html->link($menuItemIngredient->ingredient->name, ['controller' => 'Ingredients', 'action' => 'view', $menuItemIngredient->ingredient->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Qty Per Item') ?></th>
                    <td><?= $this->Number->format($menuItemIngredient->qty_per_item) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>