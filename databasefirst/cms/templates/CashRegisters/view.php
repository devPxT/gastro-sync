<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CashRegister $cashRegister
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Cash Register'), ['action' => 'edit', $cashRegister->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Cash Register'), ['action' => 'delete', $cashRegister->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cashRegister->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Cash Registers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Cash Register'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="cashRegisters view content">
            <h3><?= h($cashRegister->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Terminal') ?></th>
                    <td><?= $cashRegister->hasValue('terminal') ? $this->Html->link($cashRegister->terminal->code, ['controller' => 'Terminals', 'action' => 'view', $cashRegister->terminal->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($cashRegister->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('State') ?></th>
                    <td><?= h($cashRegister->state) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($cashRegister->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Opened By') ?></th>
                    <td><?= $cashRegister->opened_by === null ? '' : $this->Number->format($cashRegister->opened_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Opening Amount') ?></th>
                    <td><?= $cashRegister->opening_amount === null ? '' : $this->Number->format($cashRegister->opening_amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Closing Amount') ?></th>
                    <td><?= $cashRegister->closing_amount === null ? '' : $this->Number->format($cashRegister->closing_amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Opened At') ?></th>
                    <td><?= h($cashRegister->opened_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Closed At') ?></th>
                    <td><?= h($cashRegister->closed_at) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Cash Transactions') ?></h4>
                <?php if (!empty($cashRegister->cash_transactions)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Cash Register Id') ?></th>
                            <th><?= __('Type') ?></th>
                            <th><?= __('Amount') ?></th>
                            <th><?= __('Payment Method Id') ?></th>
                            <th><?= __('Related Order Id') ?></th>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Created By') ?></th>
                            <th><?= __('Created At') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($cashRegister->cash_transactions as $cashTransaction) : ?>
                        <tr>
                            <td><?= h($cashTransaction->id) ?></td>
                            <td><?= h($cashTransaction->cash_register_id) ?></td>
                            <td><?= h($cashTransaction->type) ?></td>
                            <td><?= h($cashTransaction->amount) ?></td>
                            <td><?= h($cashTransaction->payment_method_id) ?></td>
                            <td><?= h($cashTransaction->related_order_id) ?></td>
                            <td><?= h($cashTransaction->reference) ?></td>
                            <td><?= h($cashTransaction->created_by) ?></td>
                            <td><?= h($cashTransaction->created_at) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'CashTransactions', 'action' => 'view', $cashTransaction->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'CashTransactions', 'action' => 'edit', $cashTransaction->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'CashTransactions', 'action' => 'delete', $cashTransaction->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $cashTransaction->id),
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
                <h4><?= __('Related Orders') ?></h4>
                <?php if (!empty($cashRegister->orders)) : ?>
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
                        <?php foreach ($cashRegister->orders as $order) : ?>
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