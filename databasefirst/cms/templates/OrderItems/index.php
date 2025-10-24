<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\OrderItem> $orderItems
 */
?>
<div class="orderItems index content">
    <?= $this->Html->link(__('New Order Item'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Order Items') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('order_id') ?></th>
                    <th><?= $this->Paginator->sort('menu_item_id') ?></th>
                    <th><?= $this->Paginator->sort('name_snapshot') ?></th>
                    <th><?= $this->Paginator->sort('qty') ?></th>
                    <th><?= $this->Paginator->sort('unit_price') ?></th>
                    <th><?= $this->Paginator->sort('total_price') ?></th>
                    <th><?= $this->Paginator->sort('note') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('kitchen_station_id') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('updated_at') ?></th>
                    <th><?= $this->Paginator->sort('station_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderItems as $orderItem): ?>
                <tr>
                    <td><?= $this->Number->format($orderItem->id) ?></td>
                    <td><?= $orderItem->hasValue('order') ? $this->Html->link($orderItem->order->order_number, ['controller' => 'Orders', 'action' => 'view', $orderItem->order->id]) : '' ?></td>
                    <td><?= $orderItem->hasValue('menu_item') ? $this->Html->link($orderItem->menu_item->name, ['controller' => 'MenuItems', 'action' => 'view', $orderItem->menu_item->id]) : '' ?></td>
                    <td><?= h($orderItem->name_snapshot) ?></td>
                    <td><?= $this->Number->format($orderItem->qty) ?></td>
                    <td><?= $this->Number->format($orderItem->unit_price) ?></td>
                    <td><?= $this->Number->format($orderItem->total_price) ?></td>
                    <td><?= h($orderItem->note) ?></td>
                    <td><?= h($orderItem->status) ?></td>
                    <td><?= $orderItem->hasValue('kitchen_station') ? $this->Html->link($orderItem->kitchen_station->name, ['controller' => 'KitchenStations', 'action' => 'view', $orderItem->kitchen_station->id]) : '' ?></td>
                    <td><?= h($orderItem->created_at) ?></td>
                    <td><?= h($orderItem->updated_at) ?></td>
                    <td><?= $orderItem->hasValue('station') ? $this->Html->link($orderItem->station->name, ['controller' => 'KitchenStations', 'action' => 'view', $orderItem->station->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $orderItem->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orderItem->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $orderItem->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $orderItem->id),
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