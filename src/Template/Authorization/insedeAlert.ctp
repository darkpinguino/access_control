<h4>Personas Ingresadas: <?= count($people_locations)?></h4>
</br>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>RUT</th>
			<th>Nombre</th>
			<th>Perfil</th>
			<th>Ultimo registro de ingreso</th>
			<th>Fecha/Hora</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($people_locations as $people_location): ?>
			<tr>
				<td><?= h($people_location->person->fullRut)?></td>
				<td><?= h($people_location->person->fullName)?></td>
				<td><?= h($people_location->person->company_people[0]->profile->name)?></td>
				<td><?= h($people_location->enclosure->name)?></td>
				<td><?= h($people_location->created)?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>