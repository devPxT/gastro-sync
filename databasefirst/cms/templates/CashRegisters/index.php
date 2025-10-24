<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\CashRegister> $cashRegisters
 */
?>
<div class="cashRegisters index content">
    <?= $this->Html->link(__('New Cash Register'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Cash Registers') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('terminal_id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('opened_by') ?></th>
                    <th><?= $this->Paginator->sort('opened_at') ?></th>
                    <th><?= $this->Paginator->sort('closed_at') ?></th>
                    <th><?= $this->Paginator->sort('opening_amount') ?></th>
                    <th><?= $this->Paginator->sort('closing_amount') ?></th>
                    <th><?= $this->Paginator->sort('state') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cashRegisters as $cashRegister): ?>
                <tr>
                    <td><?= $this->Number->format($cashRegister->id) ?></td>
                    <td><?= $cashRegister->hasValue('terminal') ? $this->Html->link($cashRegister->terminal->code, ['controller' => 'Terminals', 'action' => 'view', $cashRegister->terminal->id]) : '' ?></td>
                    <td><?= h($cashRegister->name) ?></td>
                    <td><?= $cashRegister->opened_by === null ? '' : $this->Number->format($cashRegister->opened_by) ?></td>
                    <td><?= h($cashRegister->opened_at) ?></td>
                    <td><?= h($cashRegister->closed_at) ?></td>
                    <td><?= $cashRegister->opening_amount === null ? '' : $this->Number->format($cashRegister->opening_amount) ?></td>
                    <td><?= $cashRegister->closing_amount === null ? '' : $this->Number->format($cashRegister->closing_amount) ?></td>
                    <td><?= h($cashRegister->state) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $cashRegister->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cashRegister->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $cashRegister->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $cashRegister->id),
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