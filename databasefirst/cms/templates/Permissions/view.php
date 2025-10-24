<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Permission $permission
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Permission'), ['action' => 'edit', $permission->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Permission'), ['action' => 'delete', $permission->id], ['confirm' => __('Are you sure you want to delete # {0}?', $permission->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Permissions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Permission'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="permissions view content">
            <h3><?= h($permission->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Code') ?></th>
                    <td><?= h($permission->code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($permission->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($permission->id) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($permission->description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Role Permissions') ?></h4>
                <?php if (!empty($permission->role_permissions)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Role Id') ?></th>
                            <th><?= __('Permission Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($permission->role_permissions as $rolePermission) : ?>
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