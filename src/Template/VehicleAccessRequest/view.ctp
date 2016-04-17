<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Vehicle Access Request'), ['action' => 'edit', $vehicleAccessRequest->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vehicle Access Request'), ['action' => 'delete', $vehicleAccessRequest->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vehicleAccessRequest->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Vehicle Access Request'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vehicle Access Request'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="vehicleAccessRequest view large-9 medium-8 columns content">
    <h3><?= h($vehicleAccessRequest->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($vehicleAccessRequest->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Vehicle Id') ?></th>
            <td><?= $this->Number->format($vehicleAccessRequest->vehicle_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Access Request Id') ?></th>
            <td><?= $this->Number->format($vehicleAccessRequest->access_request_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($vehicleAccessRequest->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($vehicleAccessRequest->modified) ?></td>
        </tr>
    </table>
</div>
