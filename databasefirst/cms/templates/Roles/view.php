<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Role $role
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Role'), ['action' => 'edit', $role->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Role'), ['action' => 'delete', $role->id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Roles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Role'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="roles view content">
            <h3><?= h($role->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Code') ?></th>
                    <td><?= h($role->code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($role->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($role->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($role->created_at) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($role->description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Employees') ?></h4>
                <?php if (!empty($role->employees)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Username') ?></th>
                            <th><?= __('First Name') ?></th>
                            <th><?= __('Last Name') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Phone') ?></th>
                            <th><?= __('Role Id') ?></th>
                            <th><?= __('Password Hash') ?></th>
                            <th><?= __('Is Active') ?></th>
                            <th><?= __('Last Login') ?></th>
                            <th><?= __('Created At') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($role->employees as $employee) : ?>
                        <tr>
                            <td><?= h($employee->id) ?></td>
                            <td><?= h($employee->username) ?></td>
                            <td><?= h($employee->first_name) ?></td>
                            <td><?= h($employee->last_name) ?></td>
                            <td><?= h($employee->email) ?></td>
                            <td><?= h($employee->phone) ?></td>
                            <td><?= h($employee->role_id) ?></td>
                            <td><?= h($employee->password_hash) ?></td>
                            <td><?= h($employee->is_active) ?></td>
                            <td><?= h($employee->last_login) ?></td>
                            <td><?= h($employee->created_at) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Employees', 'action' => 'view', $employee->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Employees', 'action' => 'edit', $employee->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Employees', 'action' => 'delete', $employee->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $employee->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Role Permissions') ?></h4>
                <?php if (!empty($role->role_permissions)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Role Id') ?></th>
                            <th><?= __('Permission Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($role->role_permissions as $rolePermission) : ?>
                        <tr>
                            <td><?= h($rolePermission->role_id) ?></td>
                            <td><?= h($rolePermission->permission_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'RolePermissions', 'action' => 'view', $rolePermission->role_id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'RolePermissions', 'action' => 'edit', $rolePermission->role_id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'RolePermissions', 'action' => 'delete', $rolePermission->role_id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $rolePermission->role_id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>