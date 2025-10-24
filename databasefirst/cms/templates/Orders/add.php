<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 * @var \Cake\Collection\CollectionInterface|string[] $customers
 * @var \Cake\Collection\CollectionInterface|string[] $waiters
 * @var \Cake\Collection\CollectionInterface|string[] $terminals
 * @var \Cake\Collection\CollectionInterface|string[] $cashRegisters
 * @var \Cake\Collection\CollectionInterface|string[] $statuses
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Orders'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="orders form content">
            <?= $this->Form->create($order) ?>
            <fieldset>
                <legend><?= __('Add Order') ?></legend>
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
