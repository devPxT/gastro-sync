<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ingredient $ingredient
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $ingredient->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $ingredient->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Ingredients'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="ingredients form content">
            <?= $this->Form->create($ingredient) ?>
            <fieldset>
                <legend><?= __('Edit Ingredient') ?></legend>
                <?php
                    echo $this->Form->control('sku');
                    echo $this->Form->control('name');
                    echo $this->Form->control('unit');
                    echo $this->Form->control('stock_qty');
                    echo $this->Form->control('stock_threshold');
                    echo $this->Form->control('cost_price');
                    echo $this->Form->control('active');
                    echo $this->Form->control('updated_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
