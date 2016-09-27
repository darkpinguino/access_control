<h4>Vehiculos Ingresados: <?= count($vehicle_locations)?></h4>
</br>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Patente</th>
			<th>RUT Conductor</th>
			<th>Nombre</th>
			<th>Perfil</th>
			<th>Ultimo registro de ingreso</th>
			<th>Fecha/Hora</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($vehicle_locations as $location): 
			if ($location->driver == 1):	?>
				<tr>
					<td><?= h($location->vehicle->number_plate) ?></td>
					<td><?= h($location->person->rut)?></td>
					<td><?= h($location->person->name)?> &nbsp; <?= h($location->person->lastname)?></td>
					<td><?= h($location->person->company_people[0]->profile->name)?></td>
					<td><?= h($location->enclosure->name)?></td>
					<td><?= h($location->created)?></td>
				</tr>
		<?php endif; endforeach; ?>
	</tbody>
</table>