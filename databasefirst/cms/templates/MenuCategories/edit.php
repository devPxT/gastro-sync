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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $menuCategory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $menuCategory->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Menu Categories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="menuCategories form content">
            <?= $this->Form->create($menuCategory) ?>
            <fieldset>
                <legend><?= __('Edit Menu Category') ?></legend>
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
