<div class="box">
	<div class="box-header">
		<h3 class="box-title">Editar Tipo de Vehículo</h3>
	</div>
  <?= $this->Form->create($vehicleType) ?>
  <div class="box-body">
	  <fieldset>
		<?php
		  echo $this->Form->input('type', ['label' => 'Tipo']);
		?>
	  </fieldset>
  </div>
  <div class="box-footer">
	  <?= $this->Form->button(__('Guardar')) ?>
  </div>
  <?= $this->Form->end() ?>
</div>
