<?= $this->Html->script('authorization/authorization.js', ['block' => 'scriptView']); ?>

<div class="nav-tabs-custom">
	<ul class="nav nav-tabs" role="tablist">
		<li class="active"><a href="#people-tab" aria-controls="people-tab" role="tab" data-toggle="tab">Personas</a></li>
		<li><a href="#vehicle-tab" aria-controls="vehicle-tab" role="tab" data-toggle="tab">Vehículos</a></li>
	</ul>
	<div class="tab-content">
		<div id="people-tab" class="tab-pane fade in active" role="tabpanel">
			<div class="box">
				<div class="row">
					<div class="col-md-5 col-md-offset-3">
						<div class="box-header">
							<h3>Autorización Personas</h3>
						</div>
						<?= $this->Form->create($person) ?>
						<div class="box-body">
						  <?php 
							  echo $this->Form->input('rut', ['label' => 'Rut']);

								echo $this->Form->hidden('check', ['value' => 1]); 
							?>
						</div>
						  <div class="box-footer">
							  <?= $this->Form->button('Verificar') ?>
							  <?= $this->Form->button('Estado actual', [
								'id' => 'actual-state',
								'class' => 'btn btn-primary pull-right', 
								'type' => 'button',
								'door_id' => $door_id,
							  ]) ?>
						  </div>
						  <?= $this->Form->end() ?>
					</div>
				</div>
			</div>

			<div id="status-people-location" class="box">
			  <?= $this->element('Authorization/people_locations', ['people_locations' => $people_locations, 'people_out' => $people_out, 'door_id' => $door_id])?>
			  <div class="box-footer clearfix">
			  </div>
			</div>
		</div>
		<div id="vehicle-tab" class="tab-pane active fade">
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
									<div class="col-md-6">
										<?= $this->Form->input('number_plate', ['label' => 'Patente']) ?>
									</div>
									<div class="col-md-6">
										<?= $this->Form->input('vehicle_type', [
											'label' => 'Tipo', 
											'options' => $vehicle_types
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
		</div>
	</div>
</div>

<div id="error">
	
</div>

<?= $this->element('Modal/actualState') ?>  
<?= $this->element('Modal/vehicleActualState') ?>  


<?= $this->element('Modal/insideAlert') ?>  

<?php 
	if (isset($active_vehicle_alert)) {
		// echo $this->element('Modal/vehicleAlert', ['person_alert' => $person_alert, 'vehicle_location' => $vehicle_location]);
	}
?>
