<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Peticiones de accesos'])?>
	<div class="box-body">
		<table class="table">
			<thead>
				<tr>
					<th class="text-nowrap">Rut</th>
					<th class="text-nowrap">Nombre</th>
					<th class="text-nowrap">Perfil</th>
					<th class="text-nowrap">Puerta</th>
					<th class="text-nowrap">Accion</th>
					<th class="text-nowrap">Estado de acceso</th>
					<th class="text-nowrap">Fecha/Hora</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($accessRequest as $access_request): ?>
				<tr>
					<td class="text-nowrap"><?= h($access_request->person->rut) ?></td>
					<td class="text-nowrap"><?= h($access_request->person->name) ?> &nbsp; <?= h($access_request->person->lastname) ?></td>
					<td class="text-nowrap"><?= h($access_request->person->company_people[0]->profile->name)?></td>
					<td class="text-nowrap"><?= h($access_request->door->name) ?></td>
					<td class="text-nowrap"><?= $this->element('actionLabel', ['actionID' => $access_request->action]) ?></td>
					<td class="text-nowrap"><?= $access_request->has('access_status') ? $this->element('statusLabel', ['statusID' => $access_request->access_status->id]) : '' ?></td>
					<td class="text-nowrap"><?= h($access_request->created) ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="box-footer">
		<?= $this->element('paginator') ?>
	</div>
	<div class="box-footer">
		<?= $this->Html->link('Exportar Reporte', ['action' => 'exportReport', '_ext' => 'pdf'], ['class' => 'btn btn-primary']) ?>
	</div>
</div>