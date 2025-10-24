<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\KitchenStation> $kitchenStations
 */
?>
<div class="kitchenStations index content">
    <?= $this->Html->link(__('New Kitchen Station'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Kitchen Stations') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('code') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('active') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kitchenStations as $kitchenStation): ?>
                <tr>
                    <td><?= $this->Number->format($kitchenStation->id) ?></td>
                    <td><?= h($kitchenStation->code) ?></td>
                    <td><?= h($kitchenStation->name) ?></td>
                    <td><?= h($kitchenStation->active) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $kitchenStation->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $kitchenStation->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $kitchenStation->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $kitchenStation->id),
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