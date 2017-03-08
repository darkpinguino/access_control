<div id="vehicle-alert-modal" class="modal fade" >
  <div class="modal-dialog modal-lg">
	<div class="modal-content">
	  <div class="modal-header modal-header-danger">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">×</span></button>
		<h4 class="modal-title">Persona ingresó con vehículo</h4>
	  </div>
	  <div class="modal-body">
	  	<table class="table table-bordered table-striped">
	  		<thead>
	  			<tr>
	  				<th>Rut</th>
	  				<th>Nombre</th>
	  				<th>Conductor</th>
	  				<th>Patente</th>
	  				<th>Fecha/Hora ingreso</th>
	  			</tr>
	  		</thead>
	  		<tbody>
	  			<?php foreach ($vehicle_location->vehicle_people_locations as $location): ?>
	  			<tr>
	  				<td><?= h($location->person->rut)?></td>
	  				<td><?= h($location->person->name) ?> &nbsp; <?= h($location->person->lastname)?></td>
	  				<td><?= $this->element('driver', ['driver' => $location->driver]) ?></td>
	  				<td><?= h($vehicle_location->vehicle->number_plate) ?></td>
	  				<td><?= h($location->created) ?></td>
	  			</tr>
	  		<?php endforeach; ?>
	  		</tbody>
	  	</table>
	  	<?php 
	  		echo $this->Form->create($person, ['id' => 'vehicle_alert_form']);
	  		echo $this->Form->hidden('rut', ['value' => $person_alert->rut]);
	  	?>
	  </div>
	  <div class="modal-footer">
	  	<?= $this->Form->button('Permitir salida', ['id' => 'vehicle_alert_submit']) ?>
			<!-- <button type="button" class="btn btn-success pull-left">Permitir salida</button> -->
			<button type="button" class="btn btn-danger " data-dismiss="modal">Denegar salida</button>
			<?= $this->Form->end() ?>
	  </div>
	</div>
  </div>
</div>