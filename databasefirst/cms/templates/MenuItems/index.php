<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\MenuItem> $menuItems
 */
?>
<div class="menuItems index content">
    <?= $this->Html->link(__('New Menu Item'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Menu Items') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('sku') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('category_id') ?></th>
                    <th><?= $this->Paginator->sort('price') ?></th>
                    <th><?= $this->Paginator->sort('cost') ?></th>
                    <th><?= $this->Paginator->sort('available') ?></th>
                    <th><?= $this->Paginator->sort('prep_time_minutes') ?></th>
                    <th><?= $this->Paginator->sort('active') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menuItems as $menuItem): ?>
                <tr>
                    <td><?= $this->Number->format($menuItem->id) ?></td>
                    <td><?= h($menuItem->sku) ?></td>
                    <td><?= h($menuItem->name) ?></td>
                    <td><?= $menuItem->hasValue('category') ? $this->Html->link($menuItem->category->name, ['controller' => 'MenuCategories', 'action' => 'view', $menuItem->category->id]) : '' ?></td>
                    <td><?= $this->Number->format($menuItem->price) ?></td>
                    <td><?= $menuItem->cost === null ? '' : $this->Number->format($menuItem->cost) ?></td>
                    <td><?= h($menuItem->available) ?></td>
                    <td><?= $menuItem->prep_time_minutes === null ? '' : $this->Number->format($menuItem->prep_time_minutes) ?></td>
                    <td><?= h($menuItem->active) ?></td>
                    <td><?= h($menuItem->created_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $menuItem->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $menuItem->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $menuItem->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $menuItem->id),
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