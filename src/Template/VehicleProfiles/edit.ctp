<div class="box">
	<div class="box-header">
		<h3 class="box-title">Editar Perfil Vehiculo</h3>
	</div>
  <?= $this->Form->create($vehicleProfile) ?>
  <div class="box-body">
	  <fieldset>
		<?php
		  echo $this->Form->input('name');
		?>
	  </fieldset>
  </div>
  <div class="box-footer">
	  <?= $this->Form->button(__('Guardar')) ?>
  </div>
  <?= $this->Form->end() ?>
</div>
