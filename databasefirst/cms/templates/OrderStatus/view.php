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
            <?= $this->Html->link(__('Edit Order Status'), ['action' => 'edit', $orderStatus->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Order Status'), ['action' => 'delete', $orderStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderStatus->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Order Status'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Order Status'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="orderStatus view content">
            <h3><?= h($orderStatus->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Code') ?></th>
                    <td><?= h($orderStatus->code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($orderStatus->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($orderStatus->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Seq Order') ?></th>
                    <td><?= $orderStatus->seq_order === null ? '' : $this->Number->format($orderStatus->seq_order) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($orderStatus->created_at) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>