<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\CashTransaction> $cashTransactions
 */
?>
<div class="cashTransactions index content">
    <?= $this->Html->link(__('New Cash Transaction'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Cash Transactions') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('cash_register_id') ?></th>
                    <th><?= $this->Paginator->sort('type') ?></th>
                    <th><?= $this->Paginator->sort('amount') ?></th>
                    <th><?= $this->Paginator->sort('payment_method_id') ?></th>
                    <th><?= $this->Paginator->sort('related_order_id') ?></th>
                    <th><?= $this->Paginator->sort('reference') ?></th>
                    <th><?= $this->Paginator->sort('created_by') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cashTransactions as $cashTransaction): ?>
                <tr>
                    <td><?= $this->Number->format($cashTransaction->id) ?></td>
                    <td><?= $cashTransaction->hasValue('cash_register') ? $this->Html->link($cashTransaction->cash_register->name, ['controller' => 'CashRegisters', 'action' => 'view', $cashTransaction->cash_register->id]) : '' ?></td>
                    <td><?= h($cashTransaction->type) ?></td>
                    <td><?= $this->Number->format($cashTransaction->amount) ?></td>
                    <td><?= $cashTransaction->hasValue('payment_method') ? $this->Html->link($cashTransaction->payment_method->name, ['controller' => 'PaymentMethods', 'action' => 'view', $cashTransaction->payment_method->id]) : '' ?></td>
                    <td><?= $cashTransaction->related_order_id === null ? '' : $this->Number->format($cashTransaction->related_order_id) ?></td>
                    <td><?= h($cashTransaction->reference) ?></td>
                    <td><?= $cashTransaction->created_by === null ? '' : $this->Number->format($cashTransaction->created_by) ?></td>
                    <td><?= h($cashTransaction->created_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $cashTransaction->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cashTransaction->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $cashTransaction->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $cashTransaction->id),
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