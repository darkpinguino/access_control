<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $accessRoleDoor->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $accessRoleDoor->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Access Role Doors'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Doors'), ['controller' => 'Doors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Door'), ['controller' => 'Doors', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Access Roles'), ['controller' => 'AccessRoles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Access Role'), ['controller' => 'AccessRoles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="accessRoleDoors form large-9 medium-8 columns content">
    <?= $this->Form->create($accessRoleDoor) ?>
    <fieldset>
        <legend><?= __('Edit Access Role Door') ?></legend>
        <?php
            echo $this->Form->input('door_id', ['options' => $doors]);
            echo $this->Form->input('access_role_id', ['options' => $accessRoles]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
