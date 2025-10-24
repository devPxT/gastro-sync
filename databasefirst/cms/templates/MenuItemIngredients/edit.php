<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MenuItemIngredient $menuItemIngredient
 * @var string[]|\Cake\Collection\CollectionInterface $menuItems
 * @var string[]|\Cake\Collection\CollectionInterface $ingredients
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $menuItemIngredient->menu_item_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $menuItemIngredient->menu_item_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Menu Item Ingredients'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="menuItemIngredients form content">
            <?= $this->Form->create($menuItemIngredient) ?>
            <fieldset>
                <legend><?= __('Edit Menu Item Ingredient') ?></legend>
                <?php
                    echo $this->Form->control('qty_per_item');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
