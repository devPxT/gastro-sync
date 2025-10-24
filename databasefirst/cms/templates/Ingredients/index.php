<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Ingredient> $ingredients
 */
?>
<div class="ingredients index content">
    <?= $this->Html->link(__('New Ingredient'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Ingredients') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('sku') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('unit') ?></th>
                    <th><?= $this->Paginator->sort('stock_qty') ?></th>
                    <th><?= $this->Paginator->sort('stock_threshold') ?></th>
                    <th><?= $this->Paginator->sort('cost_price') ?></th>
                    <th><?= $this->Paginator->sort('active') ?></th>
                    <th><?= $this->Paginator->sort('updated_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ingredients as $ingredient): ?>
                <tr>
                    <td><?= $this->Number->format($ingredient->id) ?></td>
                    <td><?= h($ingredient->sku) ?></td>
                    <td><?= h($ingredient->name) ?></td>
                    <td><?= h($ingredient->unit) ?></td>
                    <td><?= $ingredient->stock_qty === null ? '' : $this->Number->format($ingredient->stock_qty) ?></td>
                    <td><?= $ingredient->stock_threshold === null ? '' : $this->Number->format($ingredient->stock_threshold) ?></td>
                    <td><?= $ingredient->cost_price === null ? '' : $this->Number->format($ingredient->cost_price) ?></td>
                    <td><?= h($ingredient->active) ?></td>
                    <td><?= h($ingredient->updated_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $ingredient->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ingredient->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $ingredient->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $ingredient->id),
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