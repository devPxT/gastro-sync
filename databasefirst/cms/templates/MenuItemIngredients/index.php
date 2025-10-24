<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\MenuItemIngredient> $menuItemIngredients
 */
?>
<div class="menuItemIngredients index content">
    <?= $this->Html->link(__('New Menu Item Ingredient'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Menu Item Ingredients') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('menu_item_id') ?></th>
                    <th><?= $this->Paginator->sort('ingredient_id') ?></th>
                    <th><?= $this->Paginator->sort('qty_per_item') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menuItemIngredients as $menuItemIngredient): ?>
                <tr>
                    <td><?= $menuItemIngredient->hasValue('menu_item') ? $this->Html->link($menuItemIngredient->menu_item->name, ['controller' => 'MenuItems', 'action' => 'view', $menuItemIngredient->menu_item->id]) : '' ?></td>
                    <td><?= $menuItemIngredient->hasValue('ingredient') ? $this->Html->link($menuItemIngredient->ingredient->name, ['controller' => 'Ingredients', 'action' => 'view', $menuItemIngredient->ingredient->id]) : '' ?></td>
                    <td><?= $this->Number->format($menuItemIngredient->qty_per_item) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $menuItemIngredient->menu_item_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $menuItemIngredient->menu_item_id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $menuItemIngredient->menu_item_id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $menuItemIngredient->menu_item_id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>