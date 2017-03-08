<div class="box">
		<div class="box-header">
				<h3 class="box-title">Editar Autorización del vehiculo <?= h($vehicleAuthorization->vehicle->number_plate) ?></h3>
		</div>
	<?= $this->Form->create($vehicleAuthorization) ?>
	<div class="box-body">
			<fieldset>
				<?php
					
            echo $this->Form->input('company_id', 
            [
              'options' => $people, 
              'label' => 'Persona'
            ]);
				?>
			</fieldset>
	</div>
	<div class="box-footer">
			<?= $this->Form->button(__('Guardar')) ?>
	</div>
	<?= $this->Form->end() ?>
</div>
