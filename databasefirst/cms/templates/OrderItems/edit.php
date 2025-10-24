<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderItem $orderItem
 * @var string[]|\Cake\Collection\CollectionInterface $orders
 * @var string[]|\Cake\Collection\CollectionInterface $menuItems
 * @var string[]|\Cake\Collection\CollectionInterface $kitchenStations
 * @var string[]|\Cake\Collection\CollectionInterface $stations
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $orderItem->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $orderItem->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Order Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="orderItems form content">
            <?= $this->Form->create($orderItem) ?>
            <fieldset>
                <legend><?= __('Edit Order Item') ?></legend>
                <?php
                    echo $this->Form->control('order_id', ['options' => $orders]);
                    echo $this->Form->control('menu_item_id', ['options' => $menuItems]);
                    echo $this->Form->control('name_snapshot');
                    echo $this->Form->control('qty');
                    echo $this->Form->control('unit_price');
                    echo $this->Form->control('total_price');
                    echo $this->Form->control('note');
                    echo $this->Form->control('status');
                    echo $this->Form->control('kitchen_station_id', ['options' => $kitchenStations, 'empty' => true]);
                    echo $this->Form->control('created_at');
                    echo $this->Form->control('updated_at');
                    echo $this->Form->control('station_id', ['options' => $stations, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
