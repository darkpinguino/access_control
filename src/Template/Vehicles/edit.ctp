<div class="box">
	<div class="box-header">
		<h3 class="box-title">Editar Vehiculo</h3>
	</div>
  <?= $this->Form->create($vehicle) ?>
  <div class="box-body">
    <fieldset>
        <?php
          echo $this->Form->input('number_plate', ['label' => 'Patente']);
          echo $this->Form->input('vehicle_type', [
            'label' => 'tipo',
            'options' => $vehicle_types 
          ]);
        ?>
    </fieldset>
  </div>
  <div class="box-footer">
    <?= $this->Form->button(__('Guardar')) ?>
  </div>
    <?= $this->Form->end() ?>
</div>
