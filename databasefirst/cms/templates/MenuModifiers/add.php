<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MenuModifier $menuModifier
 * @var \Cake\Collection\CollectionInterface|string[] $menuItems
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Menu Modifiers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="menuModifiers form content">
            <?= $this->Form->create($menuModifier) ?>
            <fieldset>
                <legend><?= __('Add Menu Modifier') ?></legend>
                <?php
                    echo $this->Form->control('menu_item_id', ['options' => $menuItems]);
                    echo $this->Form->control('name');
                    echo $this->Form->control('extra_price');
                    echo $this->Form->control('required');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
