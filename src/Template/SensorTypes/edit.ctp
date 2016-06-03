<div class="sensorTypes form large-9 medium-8 columns content">
  <?= $this->Form->create($sensorType) ?>
  <fieldset>
    <legend><?= __('Edit Sensor Type') ?></legend>
    <?php
      echo $this->Form->input('name');
      echo $this->Form->input('model');
      echo $this->Form->input('description');
      echo $this->Form->input('company_id', ['options' => $companies]);
    ?>
  </fieldset>
  <?= $this->Form->button(__('Guardar')) ?>
  <?= $this->Form->end() ?>
</div>
