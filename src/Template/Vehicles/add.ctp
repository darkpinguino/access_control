<?= $this->Html->script('vehicles/add.js', ['block' => 'scriptView']); ?>

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Nuevo Vehiculo</h3>
	</div>
  <?= $this->Form->create($vehicle) ?>
  <div class="box-body">
    <fieldset>
      <?php
        echo $this->Form->input('number_plate', ['label' => 'Patente']);
        echo $this->Form->input('vehicle_type_id', [
          'label' => 'Tipo',
          'options' => $vehicle_types
        ]);
        echo $this->Form->input('vehicle_profile', [
          'label' => 'Perfil',
          'options' => $vehicle_profiles
        ]);
      ?>
    </fieldset>
  </div>
  <div class="box-footer">
    <?= $this->Form->button(__('Guardar')) ?>
  </div>
    <?= $this->Form->end() ?>
</div>
