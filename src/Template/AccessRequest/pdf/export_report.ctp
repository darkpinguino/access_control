<div class="box">
	<div class="box-header">
		<h3 class="box-title">Peticiones de accesos</h3> </br>
		<h3 class="box-title">Reporte creado: <?= $time ?></h3>
	</div>
</div>
	<div class="box-body">
		<table class="table">
			<thead>
				<tr>
					<th>Rut</th>
					<th>Nombre</th>
					<th>Perfil</th>
					<th>Puerta</th>
					<th>Estado de acceso</th>
					<th>Fecha/Hora</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($accessRequest as $access_request): ?>
				<tr>
					<td><?= h($access_request->person->rut) ?></td>
					<td><?= h($access_request->person->name) ?> &nbsp; <?= h($access_request->person->lastname) ?></td>
					<td><?= h($access_request->person->company_people[0]->profile->name)?></td>
					<td><?= h($access_request->door->name) ?></td>
					<td><?= $access_request->has('access_status') ? $this->element('statusLabel', ['statusID' => $access_request->access_status->id]) : '' ?></td>
					<td><?= h($access_request->created) ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>