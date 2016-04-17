<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Access Role Person'), ['action' => 'edit', $accessRolePerson->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Access Role Person'), ['action' => 'delete', $accessRolePerson->id], ['confirm' => __('Are you sure you want to delete # {0}?', $accessRolePerson->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Access Role People'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Access Role Person'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="accessRolePeople view large-9 medium-8 columns content">
    <h3><?= h($accessRolePerson->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($accessRolePerson->id) ?></td>
        </tr>
        <tr>
            <th><?= __('People Id') ?></th>
            <td><?= $this->Number->format($accessRolePerson->people_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Access Role') ?></th>
            <td><?= $this->Number->format($accessRolePerson->access_role) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($accessRolePerson->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($accessRolePerson->modified) ?></td>
        </tr>
    </table>
</div>
