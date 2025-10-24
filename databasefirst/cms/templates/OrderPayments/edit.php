<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderPayment $orderPayment
 * @var string[]|\Cake\Collection\CollectionInterface $orders
 * @var string[]|\Cake\Collection\CollectionInterface $paymentMethods
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $orderPayment->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $orderPayment->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Order Payments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="orderPayments form content">
            <?= $this->Form->create($orderPayment) ?>
            <fieldset>
                <legend><?= __('Edit Order Payment') ?></legend>
                <?php
                    echo $this->Form->control('order_id', ['options' => $orders]);
                    echo $this->Form->control('payment_method_id', ['options' => $paymentMethods]);
                    echo $this->Form->control('amount');
                    echo $this->Form->control('reference');
                    echo $this->Form->control('processed_by');
                    echo $this->Form->control('created_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
