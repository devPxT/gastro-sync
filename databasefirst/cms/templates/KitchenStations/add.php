<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\KitchenStation $kitchenStation
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Kitchen Stations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="kitchenStations form content">
            <?= $this->Form->create($kitchenStation) ?>
            <fieldset>
                <legend><?= __('Add Kitchen Station') ?></legend>
                <?php
                    echo $this->Form->control('code');
                    echo $this->Form->control('name');
                    echo $this->Form->control('description');
                    echo $this->Form->control('active');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
