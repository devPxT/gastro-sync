<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\KitchenStation $kitchenStation
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Kitchen Station'), ['action' => 'edit', $kitchenStation->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Kitchen Station'), ['action' => 'delete', $kitchenStation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $kitchenStation->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Kitchen Stations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Kitchen Station'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="kitchenStations view content">
            <h3><?= h($kitchenStation->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Code') ?></th>
                    <td><?= h($kitchenStation->code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($kitchenStation->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($kitchenStation->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Active') ?></th>
                    <td><?= $kitchenStation->active ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($kitchenStation->description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Order Items') ?></h4>
                <?php if (!empty($kitchenStation->order_items)) : ?>
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
                        <?php foreach ($kitchenStation->order_items as $orderItem) : ?>
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
        </div>
    </div>
</div>