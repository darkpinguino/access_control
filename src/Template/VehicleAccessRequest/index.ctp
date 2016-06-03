<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Vehicle Access Request'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vehicleAccessRequest index large-9 medium-8 columns content">
    <h3><?= __('Vehicle Access Request') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('vehicle_id') ?></th>
                <th><?= $this->Paginator->sort('access_request_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vehicleAccessRequest as $vehicleAccessRequest): ?>
            <tr>
                <td><?= $this->Number->format($vehicleAccessRequest->id) ?></td>
                <td><?= $this->Number->format($vehicleAccessRequest->vehicle_id) ?></td>
                <td><?= $this->Number->format($vehicleAccessRequest->access_request_id) ?></td>
                <td><?= h($vehicleAccessRequest->created) ?></td>
                <td><?= h($vehicleAccessRequest->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $vehicleAccessRequest->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $vehicleAccessRequest->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $vehicleAccessRequest->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vehicleAccessRequest->id)]) ?>
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
