<div class="box">
	<div class="box-header">
		<h3 class="box-title">Editar Puerta</h3>
	</div>
  <?= $this->Form->create($door) ?>
  <div class="box-body">
	  <fieldset>
		<?php
		  echo $this->Form->input('name');
		  echo $this->Form->input('location');
		  echo $this->Form->input('description');
		  echo $this->Form->input('type', [
			'options' => [
				1 => 'Entrada', 
				2 => 'Salida', 
				3 => 'Entrada/Salida'
			], 
			'label' => 'Tipo'
		  ]);
		  echo $this->Form->input('company_id', ['options' => $companies]);
		?>
	  </fieldset>
  </div>
  <div class="box-footer">
	  <?= $this->Form->button(__('Guardar')) ?>
  </div>
  <?= $this->Form->end() ?>
</div>
