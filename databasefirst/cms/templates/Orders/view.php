<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Order'), ['action' => 'edit', $order->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Order'), ['action' => 'delete', $order->id], ['confirm' => __('Are you sure you want to delete # {0}?', $order->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Orders'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Order'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="orders view content">
            <h3><?= h($order->order_number) ?></h3>
            <table>
                <tr>
                    <th><?= __('Order Guid') ?></th>
                    <td><?= h($order->order_guid) ?></td>
                </tr>
                <tr>
                    <th><?= __('Order Number') ?></th>
                    <td><?= h($order->order_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Table Number') ?></th>
                    <td><?= h($order->table_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Customer') ?></th>
                    <td><?= $order->hasValue('customer') ? $this->Html->link($order->customer->name, ['controller' => 'Customers', 'action' => 'view', $order->customer->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Waiter') ?></th>
                    <td><?= $order->hasValue('waiter') ? $this->Html->link($order->waiter->username, ['controller' => 'Employees', 'action' => 'view', $order->waiter->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Terminal') ?></th>
                    <td><?= $order->hasValue('terminal') ? $this->Html->link($order->terminal->code, ['controller' => 'Terminals', 'action' => 'view', $order->terminal->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Cash Register') ?></th>
                    <td><?= $order->hasValue('cash_register') ? $this->Html->link($order->cash_register->name, ['controller' => 'CashRegisters', 'action' => 'view', $order->cash_register->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $order->hasValue('status') ? $this->Html->link($order->status->name, ['controller' => 'OrderStatus', 'action' => 'view', $order->status->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Payment Status') ?></th>
                    <td><?= h($order->payment_status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($order->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Subtotal') ?></th>
                    <td><?= $order->subtotal === null ? '' : $this->Number->format($order->subtotal) ?></td>
                </tr>
                <tr>
                    <th><?= __('Discount') ?></th>
                    <td><?= $order->discount === null ? '' : $this->Number->format($order->discount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tax') ?></th>
                    <td><?= $order->tax === null ? '' : $this->Number->format($order->tax) ?></td>
                </tr>
                <tr>
                    <th><?= __('Service Charge') ?></th>
                    <td><?= $order->service_charge === null ? '' : $this->Number->format($order->service_charge) ?></td>
                </tr>
                <tr>
                    <th><?= __('Total') ?></th>
                    <td><?= $order->total === null ? '' : $this->Number->format($order->total) ?></td>
                </tr>
                <tr>
                    <th><?= __('Scheduled At') ?></th>
                    <td><?= h($order->scheduled_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($order->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($order->updated_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Takeaway') ?></th>
                    <td><?= $order->is_takeaway ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Delivery') ?></th>
                    <td><?= $order->is_delivery ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Order Items') ?></h4>
                <?php if (!empty($order->order_items)) : ?>
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
                        <?php foreach ($order->order_items as $orderItem) : ?>
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
                <h4><?= __('Related Order Payments') ?></h4>
                <?php if (!empty($order->order_payments)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Order Id') ?></th>
                            <th><?= __('Payment Method Id') ?></th>
                            <th><?= __('Amount') ?></th>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Processed By') ?></th>
                            <th><?= __('Created At') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($order->order_payments as $orderPayment) : ?>
                        <tr>
                            <td><?= h($orderPayment->id) ?></td>
                            <td><?= h($orderPayment->order_id) ?></td>
                            <td><?= h($orderPayment->payment_method_id) ?></td>
                            <td><?= h($orderPayment->amount) ?></td>
                            <td><?= h($orderPayment->reference) ?></td>
                            <td><?= h($orderPayment->processed_by) ?></td>
                            <td><?= h($orderPayment->created_at) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'OrderPayments', 'action' => 'view', $orderPayment->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'OrderPayments', 'action' => 'edit', $orderPayment->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'OrderPayments', 'action' => 'delete', $orderPayment->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $orderPayment->id),
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