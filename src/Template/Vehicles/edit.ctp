<div class="box">
	<div class="box-header">
		<h3 class="box-title">Editar Vehiculo</h3>
	</div>
  <?= $this->Form->create($vehicle) ?>
  <div class="box-body">
    <fieldset>
      <?php
        echo $this->Form->input('number_plate', ['label' => 'Patente']);

        echo $this->Form->label('vehicle_type_id', 'Tipo');
        echo $this->Form->select('vehicle_type_id', $vehicle_types);

        echo $this->Form->label('company_vehicles.profile_id', 'Perfil');
        echo $this->Form->input('company_vehicles.0.id', ['value' => $vehicle->company_vehicles[0]->id]);
        echo $this->Form->select('company_vehicles.0.profile_id', $vehicle_profiles,
          ['default' => [$vehicle->company_vehicles[0]->profile_id]]);
      ?>
    </fieldset>
  </div>
  <div class="box-footer">
    <?= $this->Form->button(__('Guardar')) ?>
  </div>
    <?= $this->Form->end() ?>
</div>
