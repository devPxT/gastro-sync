<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CashRegister $cashRegister
 * @var string[]|\Cake\Collection\CollectionInterface $terminals
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $cashRegister->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $cashRegister->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Cash Registers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="cashRegisters form content">
            <?= $this->Form->create($cashRegister) ?>
            <fieldset>
                <legend><?= __('Edit Cash Register') ?></legend>
                <?php
                    echo $this->Form->control('terminal_id', ['options' => $terminals]);
                    echo $this->Form->control('name');
                    echo $this->Form->control('opened_by');
                    echo $this->Form->control('opened_at');
                    echo $this->Form->control('closed_at');
                    echo $this->Form->control('opening_amount');
                    echo $this->Form->control('closing_amount');
                    echo $this->Form->control('state');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
