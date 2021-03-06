<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $vehicleAccessRequest->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $vehicleAccessRequest->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Vehicle Access Request'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="vehicleAccessRequest form large-9 medium-8 columns content">
    <?= $this->Form->create($vehicleAccessRequest) ?>
    <fieldset>
        <legend><?= __('Edit Vehicle Access Request') ?></legend>
        <?php
            echo $this->Form->input('vehicle_id');
            echo $this->Form->input('access_request_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
