<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CashTransaction $cashTransaction
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Cash Transaction'), ['action' => 'edit', $cashTransaction->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Cash Transaction'), ['action' => 'delete', $cashTransaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cashTransaction->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Cash Transactions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Cash Transaction'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="cashTransactions view content">
            <h3><?= h($cashTransaction->type) ?></h3>
            <table>
                <tr>
                    <th><?= __('Cash Register') ?></th>
                    <td><?= $cashTransaction->hasValue('cash_register') ? $this->Html->link($cashTransaction->cash_register->name, ['controller' => 'CashRegisters', 'action' => 'view', $cashTransaction->cash_register->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= h($cashTransaction->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Payment Method') ?></th>
                    <td><?= $cashTransaction->hasValue('payment_method') ? $this->Html->link($cashTransaction->payment_method->name, ['controller' => 'PaymentMethods', 'action' => 'view', $cashTransaction->payment_method->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Reference') ?></th>
                    <td><?= h($cashTransaction->reference) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($cashTransaction->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Amount') ?></th>
                    <td><?= $this->Number->format($cashTransaction->amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Related Order Id') ?></th>
                    <td><?= $cashTransaction->related_order_id === null ? '' : $this->Number->format($cashTransaction->related_order_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $cashTransaction->created_by === null ? '' : $this->Number->format($cashTransaction->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($cashTransaction->created_at) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>