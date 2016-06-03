<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Access Role Door'), ['action' => 'edit', $accessRoleDoor->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Access Role Door'), ['action' => 'delete', $accessRoleDoor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $accessRoleDoor->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Access Role Doors'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Access Role Door'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Doors'), ['controller' => 'Doors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Door'), ['controller' => 'Doors', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Access Roles'), ['controller' => 'AccessRoles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Access Role'), ['controller' => 'AccessRoles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="accessRoleDoors view large-9 medium-8 columns content">
    <h3><?= h($accessRoleDoor->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Door') ?></th>
            <td><?= $accessRoleDoor->has('door') ? $this->Html->link($accessRoleDoor->door->name, ['controller' => 'Doors', 'action' => 'view', $accessRoleDoor->door->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Access Role') ?></th>
            <td><?= $accessRoleDoor->has('access_role') ? $this->Html->link($accessRoleDoor->access_role->name, ['controller' => 'AccessRoles', 'action' => 'view', $accessRoleDoor->access_role->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($accessRoleDoor->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($accessRoleDoor->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($accessRoleDoor->modified) ?></td>
        </tr>
    </table>
</div>
