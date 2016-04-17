<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Access Role Door'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Doors'), ['controller' => 'Doors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Door'), ['controller' => 'Doors', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Access Roles'), ['controller' => 'AccessRoles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Access Role'), ['controller' => 'AccessRoles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="accessRoleDoors index large-9 medium-8 columns content">
    <h3><?= __('Access Role Doors') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('door_id') ?></th>
                <th><?= $this->Paginator->sort('access_role_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($accessRoleDoors as $accessRoleDoor): ?>
            <tr>
                <td><?= $this->Number->format($accessRoleDoor->id) ?></td>
                <td><?= $accessRoleDoor->has('door') ? $this->Html->link($accessRoleDoor->door->name, ['controller' => 'Doors', 'action' => 'view', $accessRoleDoor->door->id]) : '' ?></td>
                <td><?= $accessRoleDoor->has('access_role') ? $this->Html->link($accessRoleDoor->access_role->name, ['controller' => 'AccessRoles', 'action' => 'view', $accessRoleDoor->access_role->id]) : '' ?></td>
                <td><?= h($accessRoleDoor->created) ?></td>
                <td><?= h($accessRoleDoor->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $accessRoleDoor->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $accessRoleDoor->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $accessRoleDoor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $accessRoleDoor->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
