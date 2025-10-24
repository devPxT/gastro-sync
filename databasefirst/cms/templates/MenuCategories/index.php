<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\MenuCategory> $menuCategories
 */
?>
<div class="menuCategories index content">
    <?= $this->Html->link(__('New Menu Category'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Menu Categories') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('position') ?></th>
                    <th><?= $this->Paginator->sort('active') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menuCategories as $menuCategory): ?>
                <tr>
                    <td><?= $this->Number->format($menuCategory->id) ?></td>
                    <td><?= h($menuCategory->name) ?></td>
                    <td><?= $menuCategory->position === null ? '' : $this->Number->format($menuCategory->position) ?></td>
                    <td><?= h($menuCategory->active) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $menuCategory->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $menuCategory->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $menuCategory->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $menuCategory->id),
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