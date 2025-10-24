<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Employee'), ['action' => 'edit', $employee->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Employee'), ['action' => 'delete', $employee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employee->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Employees'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Employee'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="employees view content">
            <h3><?= h($employee->username) ?></h3>
            <table>
                <tr>
                    <th><?= __('Username') ?></th>
                    <td><?= h($employee->username) ?></td>
                </tr>
                <tr>
                    <th><?= __('First Name') ?></th>
                    <td><?= h($employee->first_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Name') ?></th>
                    <td><?= h($employee->last_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($employee->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone') ?></th>
                    <td><?= h($employee->phone) ?></td>
                </tr>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= $employee->hasValue('role') ? $this->Html->link($employee->role->name, ['controller' => 'Roles', 'action' => 'view', $employee->role->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Password Hash') ?></th>
                    <td><?= h($employee->password_hash) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($employee->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Login') ?></th>
                    <td><?= h($employee->last_login) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($employee->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $employee->is_active ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>