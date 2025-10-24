<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RolePermission $rolePermission
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Role Permission'), ['action' => 'edit', $rolePermission->role_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Role Permission'), ['action' => 'delete', $rolePermission->role_id], ['confirm' => __('Are you sure you want to delete # {0}?', $rolePermission->role_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Role Permissions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Role Permission'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="rolePermissions view content">
            <h3><?= h($rolePermission->Array) ?></h3>
            <table>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= $rolePermission->hasValue('role') ? $this->Html->link($rolePermission->role->name, ['controller' => 'Roles', 'action' => 'view', $rolePermission->role->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Permission') ?></th>
                    <td><?= $rolePermission->hasValue('permission') ? $this->Html->link($rolePermission->permission->name, ['controller' => 'Permissions', 'action' => 'view', $rolePermission->permission->id]) : '' ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>