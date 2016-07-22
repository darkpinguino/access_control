<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Visit Profile'), ['action' => 'edit', $visitProfile->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Visit Profile'), ['action' => 'delete', $visitProfile->id], ['confirm' => __('Are you sure you want to delete # {0}?', $visitProfile->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Visit Profiles'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Visit Profile'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List People'), ['controller' => 'People', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Person'), ['controller' => 'People', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Reason Visits'), ['controller' => 'ReasonVisits', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reason Visit'), ['controller' => 'ReasonVisits', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="visitProfiles view large-9 medium-8 columns content">
    <h3><?= h($visitProfile->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Person') ?></th>
            <td><?= $visitProfile->has('person') ? $this->Html->link($visitProfile->person->name, ['controller' => 'People', 'action' => 'view', $visitProfile->person->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Reason Visit') ?></th>
            <td><?= $visitProfile->has('reason_visit') ? $this->Html->link($visitProfile->reason_visit->id, ['controller' => 'ReasonVisits', 'action' => 'view', $visitProfile->reason_visit->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($visitProfile->id) ?></td>
        </tr>
    </table>
</div>
