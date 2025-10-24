<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\OrderStatus> $orderStatus
 */
?>
<div class="orderStatus index content">
    <?= $this->Html->link(__('New Order Status'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Order Status') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('code') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('seq_order') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderStatus as $orderStatus): ?>
                <tr>
                    <td><?= $this->Number->format($orderStatus->id) ?></td>
                    <td><?= h($orderStatus->code) ?></td>
                    <td><?= h($orderStatus->name) ?></td>
                    <td><?= $orderStatus->seq_order === null ? '' : $this->Number->format($orderStatus->seq_order) ?></td>
                    <td><?= h($orderStatus->created_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $orderStatus->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orderStatus->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $orderStatus->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $orderStatus->id),
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