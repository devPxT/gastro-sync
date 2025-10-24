<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MenuItem $menuItem
 * @var \Cake\Collection\CollectionInterface|string[] $categories
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Menu Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="menuItems form content">
            <?= $this->Form->create($menuItem) ?>
            <fieldset>
                <legend><?= __('Add Menu Item') ?></legend>
                <?php
                    echo $this->Form->control('sku');
                    echo $this->Form->control('name');
                    echo $this->Form->control('category_id', ['options' => $categories, 'empty' => true]);
                    echo $this->Form->control('description');
                    echo $this->Form->control('price');
                    echo $this->Form->control('cost');
                    echo $this->Form->control('available');
                    echo $this->Form->control('prep_time_minutes');
                    echo $this->Form->control('active');
                    echo $this->Form->control('created_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
