<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PaymentMethod $paymentMethod
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Payment Method'), ['action' => 'edit', $paymentMethod->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Payment Method'), ['action' => 'delete', $paymentMethod->id], ['confirm' => __('Are you sure you want to delete # {0}?', $paymentMethod->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Payment Methods'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Payment Method'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="paymentMethods view content">
            <h3><?= h($paymentMethod->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Code') ?></th>
                    <td><?= h($paymentMethod->code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($paymentMethod->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Extra Info') ?></th>
                    <td><?= h($paymentMethod->extra_info) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($paymentMethod->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($paymentMethod->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Active') ?></th>
                    <td><?= $paymentMethod->active ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Cash Transactions') ?></h4>
                <?php if (!empty($paymentMethod->cash_transactions)) : ?>
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
                        <?php foreach ($paymentMethod->cash_transactions as $cashTransaction) : ?>
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
                <h4><?= __('Related Order Payments') ?></h4>
                <?php if (!empty($paymentMethod->order_payments)) : ?>
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
                        <?php foreach ($paymentMethod->order_payments as $orderPayment) : ?>
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