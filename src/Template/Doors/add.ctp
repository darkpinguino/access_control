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
			echo $this->Form->input('access_type', [
				'options' => [
					1 => 'Personas', 
					2 => 'Vehículos', 
					3 => 'Personas/Vehículos'
				], 
				'label' => 'Acceso'
			]);
			echo $this->Form->input('enclosure_id', [
            'options' => $enclosures, 
            'label' => 'Recinto'
          ]);

			if ($userRole_id == 1) {
				echo $this->Form->input('company_id', 
				[
					'options' => $companies, 
					'label' => 'Empresa'
			  ]);
			}
		?>
		</fieldset>
	</div>
	<div class="box-footer">
	<?= $this->Form->button(__('Guardar')) ?>
	</div>
	<?= $this->Form->end() ?>
</div>
