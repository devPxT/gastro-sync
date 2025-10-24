<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderItem $orderItem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Order Item'), ['action' => 'edit', $orderItem->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Order Item'), ['action' => 'delete', $orderItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderItem->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Order Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Order Item'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="orderItems view content">
            <h3><?= h($orderItem->name_snapshot) ?></h3>
            <table>
                <tr>
                    <th><?= __('Order') ?></th>
                    <td><?= $orderItem->hasValue('order') ? $this->Html->link($orderItem->order->order_number, ['controller' => 'Orders', 'action' => 'view', $orderItem->order->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Menu Item') ?></th>
                    <td><?= $orderItem->hasValue('menu_item') ? $this->Html->link($orderItem->menu_item->name, ['controller' => 'MenuItems', 'action' => 'view', $orderItem->menu_item->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Name Snapshot') ?></th>
                    <td><?= h($orderItem->name_snapshot) ?></td>
                </tr>
                <tr>
                    <th><?= __('Note') ?></th>
                    <td><?= h($orderItem->note) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($orderItem->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Kitchen Station') ?></th>
                    <td><?= $orderItem->hasValue('kitchen_station') ? $this->Html->link($orderItem->kitchen_station->name, ['controller' => 'KitchenStations', 'action' => 'view', $orderItem->kitchen_station->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Station') ?></th>
                    <td><?= $orderItem->hasValue('station') ? $this->Html->link($orderItem->station->name, ['controller' => 'KitchenStations', 'action' => 'view', $orderItem->station->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($orderItem->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qty') ?></th>
                    <td><?= $this->Number->format($orderItem->qty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Unit Price') ?></th>
                    <td><?= $this->Number->format($orderItem->unit_price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Total Price') ?></th>
                    <td><?= $this->Number->format($orderItem->total_price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($orderItem->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($orderItem->updated_at) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>