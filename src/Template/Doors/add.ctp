<div class="box">
	<div class="box-header">
		<h3 class="box-title">Nueva Puerta</h3>
	</div>
	<?= $this->Form->create($door) ?>
	<div class="box-body">
		<fieldset>
		<?php
			echo $this->Form->input('name', ['label' => 'Nombre']);
			echo $this->Form->input('location', ['label' => 'Ubicación']);
			echo $this->Form->input('description', ['label' => 'Descripción']);
			echo $this->Form->input('type', [
			'options' => [
				1 => 'Entrada', 
				2 => 'Salida', 
				3 => 'Entrada/Salida'
			], 
			'label' => 'Tipo'
			]);
			echo $this->Form->input('enclosure_id', [
            'options' => $enclosures, 
            'label' => 'Reciento'
          ]);
		?>
		</fieldset>
	</div>
	<div class="box-footer">
	<?= $this->Form->button(__('Guardar')) ?>
	</div>
	<?= $this->Form->end() ?>
</div>
