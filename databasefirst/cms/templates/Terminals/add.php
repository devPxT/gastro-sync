<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Terminal $terminal
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Terminals'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="terminals form content">
            <?= $this->Form->create($terminal) ?>
            <fieldset>
                <legend><?= __('Add Terminal') ?></legend>
                <?php
                    echo $this->Form->control('code');
                    echo $this->Form->control('description');
                    echo $this->Form->control('location');
                    echo $this->Form->control('active');
                    echo $this->Form->control('created_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
