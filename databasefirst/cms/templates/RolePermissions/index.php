<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\RolePermission> $rolePermissions
 */
?>
<div class="rolePermissions index content">
    <?= $this->Html->link(__('New Role Permission'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Role Permissions') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('role_id') ?></th>
                    <th><?= $this->Paginator->sort('permission_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rolePermissions as $rolePermission): ?>
                <tr>
                    <td><?= $rolePermission->hasValue('role') ? $this->Html->link($rolePermission->role->name, ['controller' => 'Roles', 'action' => 'view', $rolePermission->role->id]) : '' ?></td>
                    <td><?= $rolePermission->hasValue('permission') ? $this->Html->link($rolePermission->permission->name, ['controller' => 'Permissions', 'action' => 'view', $rolePermission->permission->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $rolePermission->role_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $rolePermission->role_id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $rolePermission->role_id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $rolePermission->role_id),
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