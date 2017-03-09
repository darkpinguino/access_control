<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $alert->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $alert->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Alerts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Access Request'), ['controller' => 'AccessRequest', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Access Request'), ['controller' => 'AccessRequest', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Notifications'), ['controller' => 'Notifications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Notification'), ['controller' => 'Notifications', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="alerts form large-9 medium-8 columns content">
    <?= $this->Form->create($alert) ?>
    <fieldset>
        <legend><?= __('Edit Alert') ?></legend>
        <?php
            echo $this->Form->control('access_request_id', ['options' => $accessRequest]);
            echo $this->Form->control('notification_id', ['options' => $notifications]);
            echo $this->Form->control('type');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
