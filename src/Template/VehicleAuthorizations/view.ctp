<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Vehicle Authorization'), ['action' => 'edit', $vehicleAuthorization->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vehicle Authorization'), ['action' => 'delete', $vehicleAuthorization->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vehicleAuthorization->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Vehicle Authorizations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vehicle Authorization'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vehicles'), ['controller' => 'Vehicles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vehicle'), ['controller' => 'Vehicles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="vehicleAuthorizations view large-9 medium-8 columns content">
    <h3><?= h($vehicleAuthorization->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Vehicle') ?></th>
            <td><?= $vehicleAuthorization->has('vehicle') ? $this->Html->link($vehicleAuthorization->vehicle->number_plate, ['controller' => 'Vehicles', 'action' => 'view', $vehicleAuthorization->vehicle->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($vehicleAuthorization->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Company People Id') ?></th>
            <td><?= $this->Number->format($vehicleAuthorization->company_people_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($vehicleAuthorization->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($vehicleAuthorization->modified) ?></td>
        </tr>
    </table>
</div>
