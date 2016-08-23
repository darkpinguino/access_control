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
						  <?= $this->Form->input('rut', ['label' => 'Rut']) ?>
						</div>
						  <div class="box-footer">
							  <?= $this->Form->button(__('Verificar')) ?>
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

			<div id="status-location" class="box">
			  <?= $this->element('Authorization/people_location', ['peopleLocations' => $peopleLocations, 'people_out' => $people_out, 'door_id' => $door_id])?>
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
									'label' => 'Rut',
									'autocomplete' => 'off'
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


								echo $this->Form->hidden('vehicle'); 
							?>
							<div id="passenger-form">
								
							</div>
						</div>
						<div class="box-footer">
							<?= $this->Form->button('Verificar')?>
						</div>
						<?= $this->Form->end()?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div id="actual-state-modal" class="modal fade">
  <div class="modal-dialog modal-lg">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">×</span></button>
		<h4 class="modal-title">Estado Actual</h4>
	  </div>
	  <div class="modal-body">
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
		<?= $this->Html->link(__('Export to excel'), ['action' => 'view', '_ext' => 'xlsx'], ['class' => 'btn btn-primary']); ?>
	  </div>
	</div>
  </div>
</div>