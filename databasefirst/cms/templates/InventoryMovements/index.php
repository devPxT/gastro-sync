<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\InventoryMovement> $inventoryMovements
 */
?>
<div class="inventoryMovements index content">
    <?= $this->Html->link(__('New Inventory Movement'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Inventory Movements') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('ingredient_id') ?></th>
                    <th><?= $this->Paginator->sort('type') ?></th>
                    <th><?= $this->Paginator->sort('qty') ?></th>
                    <th><?= $this->Paginator->sort('reference') ?></th>
                    <th><?= $this->Paginator->sort('created_by') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inventoryMovements as $inventoryMovement): ?>
                <tr>
                    <td><?= $this->Number->format($inventoryMovement->id) ?></td>
                    <td><?= $inventoryMovement->hasValue('ingredient') ? $this->Html->link($inventoryMovement->ingredient->name, ['controller' => 'Ingredients', 'action' => 'view', $inventoryMovement->ingredient->id]) : '' ?></td>
                    <td><?= h($inventoryMovement->type) ?></td>
                    <td><?= $this->Number->format($inventoryMovement->qty) ?></td>
                    <td><?= h($inventoryMovement->reference) ?></td>
                    <td><?= $inventoryMovement->created_by === null ? '' : $this->Number->format($inventoryMovement->created_by) ?></td>
                    <td><?= h($inventoryMovement->created_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $inventoryMovement->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $inventoryMovement->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $inventoryMovement->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $inventoryMovement->id),
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