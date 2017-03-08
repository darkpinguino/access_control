<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Vehicle Authorizations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Vehicles'), ['controller' => 'Vehicles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vehicle'), ['controller' => 'Vehicles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vehicleAuthorizations form large-9 medium-8 columns content">
    <?= $this->Form->create($vehicleAuthorization) ?>
    <fieldset>
        <legend><?= __('Add Vehicle Authorization') ?></legend>
        <?php
            echo $this->Form->input('vehicle_id', ['options' => $vehicles]);
            echo $this->Form->input('company_people_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
