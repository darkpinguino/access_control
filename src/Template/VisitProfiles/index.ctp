<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Visit Profile'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List People'), ['controller' => 'People', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Person'), ['controller' => 'People', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Reason Visits'), ['controller' => 'ReasonVisits', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Reason Visit'), ['controller' => 'ReasonVisits', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="visitProfiles index large-9 medium-8 columns content">
    <h3><?= __('Visit Profiles') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('person_id') ?></th>
                <th><?= $this->Paginator->sort('reason_visit_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($visitProfiles as $visitProfile): ?>
            <tr>
                <td><?= $this->Number->format($visitProfile->id) ?></td>
                <td><?= $visitProfile->has('person') ? $this->Html->link($visitProfile->person->name, ['controller' => 'People', 'action' => 'view', $visitProfile->person->id]) : '' ?></td>
                <td><?= $visitProfile->has('reason_visit') ? $this->Html->link($visitProfile->reason_visit->id, ['controller' => 'ReasonVisits', 'action' => 'view', $visitProfile->reason_visit->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $visitProfile->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $visitProfile->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $visitProfile->id], ['confirm' => __('Are you sure you want to delete # {0}?', $visitProfile->id)]) ?>
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
