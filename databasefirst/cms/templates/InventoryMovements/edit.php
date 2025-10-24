<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InventoryMovement $inventoryMovement
 * @var string[]|\Cake\Collection\CollectionInterface $ingredients
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $inventoryMovement->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $inventoryMovement->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Inventory Movements'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="inventoryMovements form content">
            <?= $this->Form->create($inventoryMovement) ?>
            <fieldset>
                <legend><?= __('Edit Inventory Movement') ?></legend>
                <?php
                    echo $this->Form->control('ingredient_id', ['options' => $ingredients]);
                    echo $this->Form->control('type');
                    echo $this->Form->control('qty');
                    echo $this->Form->control('reference');
                    echo $this->Form->control('created_by');
                    echo $this->Form->control('created_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
