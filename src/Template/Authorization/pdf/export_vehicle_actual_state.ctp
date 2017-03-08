<p>Fecha creación: &nbsp; <span><?= $time?></span></p> 
<h4>Vehiculos Ingresados: <?= count($vehicles_locations)?></h4>
</br>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Patente</th>
			<th>RUT</th>
			<th>Nombre</th>
			<th>Conductor</th>
			<th>Perfil</th>
			<th>Ultimo registro de ingreso</th>
			<th>Fecha/Hora</th>
		</tr>
	</thead>
	<tbody>
	  <?php foreach ($vehicles_locations as $vehicle_location): 
	  	foreach ($vehicle_location->vehicle_people_locations as $vehicle_people_location): ?>
			  <tr>
					<td><?= h($vehicle_location->vehicle->number_plate) ?></td>
					<td><?= h($vehicle_people_location->person->rut) ?></td>
				  <td><?= h($vehicle_people_location->person->name)?> &nbsp; <?= h($vehicle_people_location->person->lastname)?></td>
				  <td><?= $this->element('driver', ['driver' => $vehicle_people_location->driver]) ?></td>
				  <td><?= h($vehicle_people_location->person->company_people[0]->profile->name)?></td>
				  <td><?= h($vehicle_location->enclosure->name)?></td>
				  <td><?= h($vehicle_location->created)?></td>
			  </tr>
			<?php endforeach;
	  endforeach; ?>
	</tbody>
</table>