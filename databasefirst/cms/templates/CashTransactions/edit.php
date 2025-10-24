<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CashTransaction $cashTransaction
 * @var string[]|\Cake\Collection\CollectionInterface $cashRegisters
 * @var string[]|\Cake\Collection\CollectionInterface $paymentMethods
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $cashTransaction->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $cashTransaction->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Cash Transactions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="cashTransactions form content">
            <?= $this->Form->create($cashTransaction) ?>
            <fieldset>
                <legend><?= __('Edit Cash Transaction') ?></legend>
                <?php
                    echo $this->Form->control('cash_register_id', ['options' => $cashRegisters]);
                    echo $this->Form->control('type');
                    echo $this->Form->control('amount');
                    echo $this->Form->control('payment_method_id', ['options' => $paymentMethods, 'empty' => true]);
                    echo $this->Form->control('related_order_id');
                    echo $this->Form->control('reference');
                    echo $this->Form->control('created_by');
                    echo $this->Form->control('created_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
