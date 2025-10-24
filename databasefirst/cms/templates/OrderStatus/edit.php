<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderStatus $orderStatus
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $orderStatus->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $orderStatus->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Order Status'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="orderStatus form content">
            <?= $this->Form->create($orderStatus) ?>
            <fieldset>
                <legend><?= __('Edit Order Status') ?></legend>
                <?php
                    echo $this->Form->control('code');
                    echo $this->Form->control('name');
                    echo $this->Form->control('seq_order');
                    echo $this->Form->control('created_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
