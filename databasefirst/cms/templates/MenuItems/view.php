<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MenuItem $menuItem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Menu Item'), ['action' => 'edit', $menuItem->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Menu Item'), ['action' => 'delete', $menuItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menuItem->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Menu Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Menu Item'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="menuItems view content">
            <h3><?= h($menuItem->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Sku') ?></th>
                    <td><?= h($menuItem->sku) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($menuItem->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Category') ?></th>
                    <td><?= $menuItem->hasValue('category') ? $this->Html->link($menuItem->category->name, ['controller' => 'MenuCategories', 'action' => 'view', $menuItem->category->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($menuItem->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $this->Number->format($menuItem->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cost') ?></th>
                    <td><?= $menuItem->cost === null ? '' : $this->Number->format($menuItem->cost) ?></td>
                </tr>
                <tr>
                    <th><?= __('Prep Time Minutes') ?></th>
                    <td><?= $menuItem->prep_time_minutes === null ? '' : $this->Number->format($menuItem->prep_time_minutes) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($menuItem->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Available') ?></th>
                    <td><?= $menuItem->available ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Active') ?></th>
                    <td><?= $menuItem->active ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($menuItem->description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Menu Item Ingredients') ?></h4>
                <?php if (!empty($menuItem->menu_item_ingredients)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Menu Item Id') ?></th>
                            <th><?= __('Ingredient Id') ?></th>
                            <th><?= __('Qty Per Item') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($menuItem->menu_item_ingredients as $menuItemIngredient) : ?>
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
            <div class="related">
                <h4><?= __('Related Menu Modifiers') ?></h4>
                <?php if (!empty($menuItem->menu_modifiers)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Menu Item Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Extra Price') ?></th>
                            <th><?= __('Required') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($menuItem->menu_modifiers as $menuModifier) : ?>
                        <tr>
                            <td><?= h($menuModifier->id) ?></td>
                            <td><?= h($menuModifier->menu_item_id) ?></td>
                            <td><?= h($menuModifier->name) ?></td>
                            <td><?= h($menuModifier->extra_price) ?></td>
                            <td><?= h($menuModifier->required) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'MenuModifiers', 'action' => 'view', $menuModifier->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'MenuModifiers', 'action' => 'edit', $menuModifier->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'MenuModifiers', 'action' => 'delete', $menuModifier->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $menuModifier->id),
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
                <h4><?= __('Related Order Items') ?></h4>
                <?php if (!empty($menuItem->order_items)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Order Id') ?></th>
                            <th><?= __('Menu Item Id') ?></th>
                            <th><?= __('Name Snapshot') ?></th>
                            <th><?= __('Qty') ?></th>
                            <th><?= __('Unit Price') ?></th>
                            <th><?= __('Total Price') ?></th>
                            <th><?= __('Note') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Kitchen Station Id') ?></th>
                            <th><?= __('Created At') ?></th>
                            <th><?= __('Updated At') ?></th>
                            <th><?= __('Station Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($menuItem->order_items as $orderItem) : ?>
                        <tr>
                            <td><?= h($orderItem->id) ?></td>
                            <td><?= h($orderItem->order_id) ?></td>
                            <td><?= h($orderItem->menu_item_id) ?></td>
                            <td><?= h($orderItem->name_snapshot) ?></td>
                            <td><?= h($orderItem->qty) ?></td>
                            <td><?= h($orderItem->unit_price) ?></td>
                            <td><?= h($orderItem->total_price) ?></td>
                            <td><?= h($orderItem->note) ?></td>
                            <td><?= h($orderItem->status) ?></td>
                            <td><?= h($orderItem->kitchen_station_id) ?></td>
                            <td><?= h($orderItem->created_at) ?></td>
                            <td><?= h($orderItem->updated_at) ?></td>
                            <td><?= h($orderItem->station_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'OrderItems', 'action' => 'view', $orderItem->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'OrderItems', 'action' => 'edit', $orderItem->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'OrderItems', 'action' => 'delete', $orderItem->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $orderItem->id),
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
                <h4><?= __('Related V Top Items') ?></h4>
                <?php if (!empty($menuItem->v_top_items)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Menu Item Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Total Sold') ?></th>
                            <th><?= __('Total Income') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($menuItem->v_top_items as $vTopItem) : ?>
                        <tr>
                            <td><?= h($vTopItem->menu_item_id) ?></td>
                            <td><?= h($vTopItem->name) ?></td>
                            <td><?= h($vTopItem->total_sold) ?></td>
                            <td><?= h($vTopItem->total_income) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'VTopItems', 'action' => 'view', $vTopItem->]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'VTopItems', 'action' => 'edit', $vTopItem->]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'VTopItems', 'action' => 'delete', $vTopItem->],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $vTopItem->),
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