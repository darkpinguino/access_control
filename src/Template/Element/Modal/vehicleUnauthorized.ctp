<?php 
	$vehicle_people_location = $vehicle_location->vehicle_people_locations[0];
 ?>

<div id="vehicle-alert-modal" class="modal fade" >
  <div class="modal-dialog modal-lg">
	<div class="modal-content">
	  <div class="modal-header modal-header-danger">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">×</span></button>
		<h4 class="modal-title">Persona sin autorizacion para retirar el vehículo</h4>
	  </div>
	  <div class="modal-body">
	  	<h4>Información</h4>
	  	<table class="table table-bordered table-striped">
	  		<thead>
	  			<tr>
	  				<th>Rut</th>
	  				<th>Nombre</th>
	  				<th>Patente</th>
	  				<th>Tipo</th>
	  			</tr>
	  		</thead>
	  		<tbody>
	  			<tr>
	  				<td><?= h($person_alert->rut)?></td>
	  				<td><?= h($person_alert->fullName) ?></td>
	  				<td><?= h($vehicle->number_plate) ?></td>
	  				<td><?= h($vehicle->vehicle_type->type)?></td>
	  			</tr>
	  		</tbody>
	  	</table>
	  </div>
	  <div class="modal-footer">
			<button type="button" class="btn btn-default " data-dismiss="modal">Cerrar</button>
	  </div>
	</div>
  </div>
</div>