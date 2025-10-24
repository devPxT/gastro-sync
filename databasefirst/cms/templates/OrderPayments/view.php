<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderPayment $orderPayment
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Order Payment'), ['action' => 'edit', $orderPayment->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Order Payment'), ['action' => 'delete', $orderPayment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderPayment->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Order Payments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Order Payment'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="orderPayments view content">
            <h3><?= h($orderPayment->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Order') ?></th>
                    <td><?= $orderPayment->hasValue('order') ? $this->Html->link($orderPayment->order->order_number, ['controller' => 'Orders', 'action' => 'view', $orderPayment->order->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Payment Method') ?></th>
                    <td><?= $orderPayment->hasValue('payment_method') ? $this->Html->link($orderPayment->payment_method->name, ['controller' => 'PaymentMethods', 'action' => 'view', $orderPayment->payment_method->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Reference') ?></th>
                    <td><?= h($orderPayment->reference) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($orderPayment->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Amount') ?></th>
                    <td><?= $this->Number->format($orderPayment->amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Processed By') ?></th>
                    <td><?= $orderPayment->processed_by === null ? '' : $this->Number->format($orderPayment->processed_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($orderPayment->created_at) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>