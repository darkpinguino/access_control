<?php 
	if ($tab)
			echo '<div id="vehicle-tab" class="tab-pane fade">';
 ?>

<!-- <div id="vehicle-tab" class="tab-pane active fade"> -->
	<div class="box">
		<div class="row">
			<div class="col-md-5 col-md-offset-3">
				<div class="box-header">
					<h3>Autorización Vehículos</h3>
				</div>
				<?= $this->Form->create()?>
				<div class="box-body">
					<?php
						echo $this->Form->input('rut', [
							'id' => 'vehicle-rut',
							'label' => 'Rut',
							// 'autocomplete' => 'off'
						]);
					?>
						<div class="row">
							<div class="col-md-4">
								<?= $this->Form->input('number_plate', ['label' => 'Patente']) ?>
								<?=  $this->Form->hidden('check', ['value' => 1]) ?>
							</div>
							<div class="col-md-4">
								<?= $this->Form->input('vehicle_type', [
									'label' => 'Tipo', 
									'options' => $vehicle_types
								])?>
							</div>
							<div class="col-md-4">
								<?= $this->Form->input('vehicle_profile', [
									'label' => 'Perfil',
									'options' => $vehicle_profiles
								])?>
							</div>
						</div>
					<?php
						echo $this->Form->input('passenger', [
							'type' => 'checkbox',
							'label' => '¿Pasajeros?',
							'templates' => [
								'inputContainer' => '<div class="checkbox">{{content}}</div>'
							]
						]);


						echo $this->Form->hidden('vehicle', ['value' => 1]); 
						echo $this->Form->hidden('driver', ['value' => 1]); 
					?>
					<div id="passenger-form">
						
					</div>
				</div>
				<div class="box-footer">
					<?= $this->Form->button('Verificar')?>
					<?= $this->Form->button('Estado actual', [
						'id' => 'vehicle-actual-state',
						'class' => 'btn btn-primary pull-right', 
						'type' => 'button',
						'door_id' => $door_id,
					  ]) ?>
				</div>
				<?= $this->Form->end()?>
			</div>
		</div>

	</div>
	<div id="status-vehicle-location" class="box">
	  <?= $this->element('Authorization/vehicle_locations', ['vehicles_locations' => $vehicles_locations, 'people_out' => $people_out, 'door_id' => $door_id])?>
	  <div class="box-footer clearfix">
	  </div>
	</div>
<?php 
	if ($tab)
		echo '</div>';
?>
