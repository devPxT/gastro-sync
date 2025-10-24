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
            <?= $this->Html->link(__('List Menu Categories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="menuCategories form content">
            <?= $this->Form->create($menuCategory) ?>
            <fieldset>
                <legend><?= __('Add Menu Category') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('description');
                    echo $this->Form->control('position');
                    echo $this->Form->control('active');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
