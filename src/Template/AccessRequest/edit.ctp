<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $accessRequest->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $accessRequest->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Access Request'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List People'), ['controller' => 'People', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Person'), ['controller' => 'People', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Doors'), ['controller' => 'Doors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Door'), ['controller' => 'Doors', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vehicle Access Request'), ['controller' => 'VehicleAccessRequest', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vehicle Access Request'), ['controller' => 'VehicleAccessRequest', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="accessRequest form large-9 medium-8 columns content">
    <?= $this->Form->create($accessRequest) ?>
    <fieldset>
        <legend><?= __('Edit Access Request') ?></legend>
        <?php
            echo $this->Form->input('people_id', ['options' => $people]);
            echo $this->Form->input('door_id', ['options' => $doors]);
            echo $this->Form->input('access_status_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
