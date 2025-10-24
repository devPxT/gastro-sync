<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\MenuModifier> $menuModifiers
 */
?>
<div class="menuModifiers index content">
    <?= $this->Html->link(__('New Menu Modifier'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Menu Modifiers') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('menu_item_id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('extra_price') ?></th>
                    <th><?= $this->Paginator->sort('required') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menuModifiers as $menuModifier): ?>
                <tr>
                    <td><?= $this->Number->format($menuModifier->id) ?></td>
                    <td><?= $menuModifier->hasValue('menu_item') ? $this->Html->link($menuModifier->menu_item->name, ['controller' => 'MenuItems', 'action' => 'view', $menuModifier->menu_item->id]) : '' ?></td>
                    <td><?= h($menuModifier->name) ?></td>
                    <td><?= $menuModifier->extra_price === null ? '' : $this->Number->format($menuModifier->extra_price) ?></td>
                    <td><?= h($menuModifier->required) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $menuModifier->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $menuModifier->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $menuModifier->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $menuModifier->id),
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