<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Customer'), ['action' => 'edit', $customer->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Customer'), ['action' => 'delete', $customer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customer->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Customers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Customer'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="customers view content">
            <h3><?= h($customer->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($customer->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone') ?></th>
                    <td><?= h($customer->phone) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($customer->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($customer->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($customer->created_at) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Address') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($customer->address)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Notes') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($customer->notes)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Orders') ?></h4>
                <?php if (!empty($customer->orders)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Order Guid') ?></th>
                            <th><?= __('Order Number') ?></th>
                            <th><?= __('Table Number') ?></th>
                            <th><?= __('Customer Id') ?></th>
                            <th><?= __('Waiter Id') ?></th>
                            <th><?= __('Terminal Id') ?></th>
                            <th><?= __('Cash Register Id') ?></th>
                            <th><?= __('Status Id') ?></th>
                            <th><?= __('Is Takeaway') ?></th>
                            <th><?= __('Is Delivery') ?></th>
                            <th><?= __('Scheduled At') ?></th>
                            <th><?= __('Subtotal') ?></th>
                            <th><?= __('Discount') ?></th>
                            <th><?= __('Tax') ?></th>
                            <th><?= __('Service Charge') ?></th>
                            <th><?= __('Total') ?></th>
                            <th><?= __('Payment Status') ?></th>
                            <th><?= __('Created At') ?></th>
                            <th><?= __('Updated At') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($customer->orders as $order) : ?>
                        <tr>
                            <td><?= h($order->id) ?></td>
                            <td><?= h($order->order_guid) ?></td>
                            <td><?= h($order->order_number) ?></td>
                            <td><?= h($order->table_number) ?></td>
                            <td><?= h($order->customer_id) ?></td>
                            <td><?= h($order->waiter_id) ?></td>
                            <td><?= h($order->terminal_id) ?></td>
                            <td><?= h($order->cash_register_id) ?></td>
                            <td><?= h($order->status_id) ?></td>
                            <td><?= h($order->is_takeaway) ?></td>
                            <td><?= h($order->is_delivery) ?></td>
                            <td><?= h($order->scheduled_at) ?></td>
                            <td><?= h($order->subtotal) ?></td>
                            <td><?= h($order->discount) ?></td>
                            <td><?= h($order->tax) ?></td>
                            <td><?= h($order->service_charge) ?></td>
                            <td><?= h($order->total) ?></td>
                            <td><?= h($order->payment_status) ?></td>
                            <td><?= h($order->created_at) ?></td>
                            <td><?= h($order->updated_at) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Orders', 'action' => 'view', $order->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Orders', 'action' => 'edit', $order->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Orders', 'action' => 'delete', $order->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $order->id),
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