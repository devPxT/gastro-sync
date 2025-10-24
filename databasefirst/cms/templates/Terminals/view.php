<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Terminal $terminal
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Terminal'), ['action' => 'edit', $terminal->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Terminal'), ['action' => 'delete', $terminal->id], ['confirm' => __('Are you sure you want to delete # {0}?', $terminal->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Terminals'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Terminal'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="terminals view content">
            <h3><?= h($terminal->code) ?></h3>
            <table>
                <tr>
                    <th><?= __('Code') ?></th>
                    <td><?= h($terminal->code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($terminal->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Location') ?></th>
                    <td><?= h($terminal->location) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($terminal->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($terminal->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Active') ?></th>
                    <td><?= $terminal->active ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Cash Registers') ?></h4>
                <?php if (!empty($terminal->cash_registers)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Terminal Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Opened By') ?></th>
                            <th><?= __('Opened At') ?></th>
                            <th><?= __('Closed At') ?></th>
                            <th><?= __('Opening Amount') ?></th>
                            <th><?= __('Closing Amount') ?></th>
                            <th><?= __('State') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($terminal->cash_registers as $cashRegister) : ?>
                        <tr>
                            <td><?= h($cashRegister->id) ?></td>
                            <td><?= h($cashRegister->terminal_id) ?></td>
                            <td><?= h($cashRegister->name) ?></td>
                            <td><?= h($cashRegister->opened_by) ?></td>
                            <td><?= h($cashRegister->opened_at) ?></td>
                            <td><?= h($cashRegister->closed_at) ?></td>
                            <td><?= h($cashRegister->opening_amount) ?></td>
                            <td><?= h($cashRegister->closing_amount) ?></td>
                            <td><?= h($cashRegister->state) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'CashRegisters', 'action' => 'view', $cashRegister->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'CashRegisters', 'action' => 'edit', $cashRegister->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'CashRegisters', 'action' => 'delete', $cashRegister->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $cashRegister->id),
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
                <?php if (!empty($terminal->orders)) : ?>
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
                        <?php foreach ($terminal->orders as $order) : ?>
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