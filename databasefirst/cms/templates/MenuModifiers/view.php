<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MenuModifier $menuModifier
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Menu Modifier'), ['action' => 'edit', $menuModifier->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Menu Modifier'), ['action' => 'delete', $menuModifier->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menuModifier->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Menu Modifiers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Menu Modifier'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="menuModifiers view content">
            <h3><?= h($menuModifier->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Menu Item') ?></th>
                    <td><?= $menuModifier->hasValue('menu_item') ? $this->Html->link($menuModifier->menu_item->name, ['controller' => 'MenuItems', 'action' => 'view', $menuModifier->menu_item->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($menuModifier->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($menuModifier->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Extra Price') ?></th>
                    <td><?= $menuModifier->extra_price === null ? '' : $this->Number->format($menuModifier->extra_price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Required') ?></th>
                    <td><?= $menuModifier->required ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>