<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MenuCategory $menuCategory
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Menu Category'), ['action' => 'edit', $menuCategory->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Menu Category'), ['action' => 'delete', $menuCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menuCategory->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Menu Categories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Menu Category'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="menuCategories view content">
            <h3><?= h($menuCategory->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($menuCategory->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($menuCategory->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Position') ?></th>
                    <td><?= $menuCategory->position === null ? '' : $this->Number->format($menuCategory->position) ?></td>
                </tr>
                <tr>
                    <th><?= __('Active') ?></th>
                    <td><?= $menuCategory->active ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($menuCategory->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>