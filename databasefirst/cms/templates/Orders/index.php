<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Order> $orders
 */
?>
<div class="orders index content">
    <?= $this->Html->link(__('New Order'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Orders') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('order_guid') ?></th>
                    <th><?= $this->Paginator->sort('order_number') ?></th>
                    <th><?= $this->Paginator->sort('table_number') ?></th>
                    <th><?= $this->Paginator->sort('customer_id') ?></th>
                    <th><?= $this->Paginator->sort('waiter_id') ?></th>
                    <th><?= $this->Paginator->sort('terminal_id') ?></th>
                    <th><?= $this->Paginator->sort('cash_register_id') ?></th>
                    <th><?= $this->Paginator->sort('status_id') ?></th>
                    <th><?= $this->Paginator->sort('is_takeaway') ?></th>
                    <th><?= $this->Paginator->sort('is_delivery') ?></th>
                    <th><?= $this->Paginator->sort('scheduled_at') ?></th>
                    <th><?= $this->Paginator->sort('subtotal') ?></th>
                    <th><?= $this->Paginator->sort('discount') ?></th>
                    <th><?= $this->Paginator->sort('tax') ?></th>
                    <th><?= $this->Paginator->sort('service_charge') ?></th>
                    <th><?= $this->Paginator->sort('total') ?></th>
                    <th><?= $this->Paginator->sort('payment_status') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('updated_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $this->Number->format($order->id) ?></td>
                    <td><?= h($order->order_guid) ?></td>
                    <td><?= h($order->order_number) ?></td>
                    <td><?= h($order->table_number) ?></td>
                    <td><?= $order->hasValue('customer') ? $this->Html->link($order->customer->name, ['controller' => 'Customers', 'action' => 'view', $order->customer->id]) : '' ?></td>
                    <td><?= $order->hasValue('waiter') ? $this->Html->link($order->waiter->username, ['controller' => 'Employees', 'action' => 'view', $order->waiter->id]) : '' ?></td>
                    <td><?= $order->hasValue('terminal') ? $this->Html->link($order->terminal->code, ['controller' => 'Terminals', 'action' => 'view', $order->terminal->id]) : '' ?></td>
                    <td><?= $order->hasValue('cash_register') ? $this->Html->link($order->cash_register->name, ['controller' => 'CashRegisters', 'action' => 'view', $order->cash_register->id]) : '' ?></td>
                    <td><?= $order->hasValue('status') ? $this->Html->link($order->status->name, ['controller' => 'OrderStatus', 'action' => 'view', $order->status->id]) : '' ?></td>
                    <td><?= h($order->is_takeaway) ?></td>
                    <td><?= h($order->is_delivery) ?></td>
                    <td><?= h($order->scheduled_at) ?></td>
                    <td><?= $order->subtotal === null ? '' : $this->Number->format($order->subtotal) ?></td>
                    <td><?= $order->discount === null ? '' : $this->Number->format($order->discount) ?></td>
                    <td><?= $order->tax === null ? '' : $this->Number->format($order->tax) ?></td>
                    <td><?= $order->service_charge === null ? '' : $this->Number->format($order->service_charge) ?></td>
                    <td><?= $order->total === null ? '' : $this->Number->format($order->total) ?></td>
                    <td><?= h($order->payment_status) ?></td>
                    <td><?= h($order->created_at) ?></td>
                    <td><?= h($order->updated_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $order->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $order->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $order->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $order->id),
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