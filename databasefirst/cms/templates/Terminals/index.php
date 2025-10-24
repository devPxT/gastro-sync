<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Terminal> $terminals
 */
?>
<div class="terminals index content">
    <?= $this->Html->link(__('New Terminal'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Terminals') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('code') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= $this->Paginator->sort('location') ?></th>
                    <th><?= $this->Paginator->sort('active') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($terminals as $terminal): ?>
                <tr>
                    <td><?= $this->Number->format($terminal->id) ?></td>
                    <td><?= h($terminal->code) ?></td>
                    <td><?= h($terminal->description) ?></td>
                    <td><?= h($terminal->location) ?></td>
                    <td><?= h($terminal->active) ?></td>
                    <td><?= h($terminal->created_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $terminal->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $terminal->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $terminal->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $terminal->id),
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