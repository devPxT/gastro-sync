<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\OrderPayment> $orderPayments
 */
?>
<div class="orderPayments index content">
    <?= $this->Html->link(__('New Order Payment'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Order Payments') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('order_id') ?></th>
                    <th><?= $this->Paginator->sort('payment_method_id') ?></th>
                    <th><?= $this->Paginator->sort('amount') ?></th>
                    <th><?= $this->Paginator->sort('reference') ?></th>
                    <th><?= $this->Paginator->sort('processed_by') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderPayments as $orderPayment): ?>
                <tr>
                    <td><?= $this->Number->format($orderPayment->id) ?></td>
                    <td><?= $orderPayment->hasValue('order') ? $this->Html->link($orderPayment->order->order_number, ['controller' => 'Orders', 'action' => 'view', $orderPayment->order->id]) : '' ?></td>
                    <td><?= $orderPayment->hasValue('payment_method') ? $this->Html->link($orderPayment->payment_method->name, ['controller' => 'PaymentMethods', 'action' => 'view', $orderPayment->payment_method->id]) : '' ?></td>
                    <td><?= $this->Number->format($orderPayment->amount) ?></td>
                    <td><?= h($orderPayment->reference) ?></td>
                    <td><?= $orderPayment->processed_by === null ? '' : $this->Number->format($orderPayment->processed_by) ?></td>
                    <td><?= h($orderPayment->created_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $orderPayment->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orderPayment->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $orderPayment->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $orderPayment->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>