<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Access Role Person'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="accessRolePeople index large-9 medium-8 columns content">
    <h3><?= __('Access Role People') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('people_id') ?></th>
                <th><?= $this->Paginator->sort('access_role') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($accessRolePeople as $accessRolePerson): ?>
            <tr>
                <td><?= $this->Number->format($accessRolePerson->id) ?></td>
                <td><?= $this->Number->format($accessRolePerson->people_id) ?></td>
                <td><?= $this->Number->format($accessRolePerson->access_role) ?></td>
                <td><?= h($accessRolePerson->created) ?></td>
                <td><?= h($accessRolePerson->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $accessRolePerson->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $accessRolePerson->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $accessRolePerson->id], ['confirm' => __('Are you sure you want to delete # {0}?', $accessRolePerson->id)]) ?>
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
