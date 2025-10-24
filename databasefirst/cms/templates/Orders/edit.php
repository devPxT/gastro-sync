<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 * @var string[]|\Cake\Collection\CollectionInterface $customers
 * @var string[]|\Cake\Collection\CollectionInterface $waiters
 * @var string[]|\Cake\Collection\CollectionInterface $terminals
 * @var string[]|\Cake\Collection\CollectionInterface $cashRegisters
 * @var string[]|\Cake\Collection\CollectionInterface $statuses
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $order->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $order->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Orders'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="orders form content">
            <?= $this->Form->create($order) ?>
            <fieldset>
                <legend><?= __('Edit Order') ?></legend>
                <?php
                    echo $this->Form->control('order_guid');
                    echo $this->Form->control('order_number');
                    echo $this->Form->control('table_number');
                    echo $this->Form->control('customer_id', ['options' => $customers, 'empty' => true]);
                    echo $this->Form->control('waiter_id', ['options' => $waiters, 'empty' => true]);
                    echo $this->Form->control('terminal_id', ['options' => $terminals, 'empty' => true]);
                    echo $this->Form->control('cash_register_id', ['options' => $cashRegisters, 'empty' => true]);
                    echo $this->Form->control('status_id', ['options' => $statuses]);
                    echo $this->Form->control('is_takeaway');
                    echo $this->Form->control('is_delivery');
                    echo $this->Form->control('scheduled_at');
                    echo $this->Form->control('subtotal');
                    echo $this->Form->control('discount');
                    echo $this->Form->control('tax');
                    echo $this->Form->control('service_charge');
                    echo $this->Form->control('total');
                    echo $this->Form->control('payment_status');
                    echo $this->Form->control('created_at');
                    echo $this->Form->control('updated_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
