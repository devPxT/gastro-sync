<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RolePermission $rolePermission
 * @var \Cake\Collection\CollectionInterface|string[] $roles
 * @var \Cake\Collection\CollectionInterface|string[] $permissions
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Role Permissions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="rolePermissions form content">
            <?= $this->Form->create($rolePermission) ?>
            <fieldset>
                <legend><?= __('Add Role Permission') ?></legend>
                <?php
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
