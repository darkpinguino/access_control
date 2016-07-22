<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $visitProfile->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $visitProfile->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Visit Profiles'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List People'), ['controller' => 'People', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Person'), ['controller' => 'People', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Reason Visits'), ['controller' => 'ReasonVisits', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Reason Visit'), ['controller' => 'ReasonVisits', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="visitProfiles form large-9 medium-8 columns content">
    <?= $this->Form->create($visitProfile) ?>
    <fieldset>
        <legend><?= __('Edit Visit Profile') ?></legend>
        <?php
            echo $this->Form->input('person_id', ['options' => $people]);
            echo $this->Form->input('reason_visit_id', ['options' => $reasonVisits]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
