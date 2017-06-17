<?= $this->Html->css('plugins/datatables/dataTables.bootstrap', ['block' => 'cssView'])?>
<?= $this->Html->css('plugins/datatables/buttons.bootstrap.min', ['block' => 'cssView'])?>

<?= $this->Html->script('plugins/datatables/jquery.dataTables.min', ['block' => 'scriptView'])?>
<?= $this->Html->script('plugins/JSZip/jszip.min', ['block' => 'scriptView'])?>
<?= $this->Html->script('plugins/pdfmake/pdfmake.min', ['block' => 'scriptView'])?>
<?= $this->Html->script('plugins/pdfmake/vfs_fonts', ['block' => 'scriptView'])?>
<?= $this->Html->script('plugins/datatables/dataTables.bootstrap.min', ['block' => 'scriptView'])?>
<?= $this->Html->script('plugins/datatables/dataTables.buttons.min', ['block' => 'scriptView'])?>
<?= $this->Html->script('plugins/datatables/buttons.bootstrap.min', ['block' => 'scriptView'])?>
<?= $this->Html->script('plugins/datatables/buttons.html5.min', ['block' => 'scriptView'])?>

<?= $this->Html->script('vehicleAccessRequest/view_report', ['block' => 'scriptView']) ?>

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Registro de accesos vehiculos</h3>
	</div>
	<div class="box-body">
		<table id="report" class="table">
			<thead>
				<tr>
					<th class="text-nowrap">Patente</th>
					<th class="text-nowrap">Conductor</th>
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
				<?php foreach ($vehicles_access_request as $access_request): ?>
				<tr>
					<td class="text-nowrap"><?= h($access_request->vehicle->number_plate) ?></td>
					<td class="text-nowrap"><?= $access_request ? $this->element('driver', ['driver' => $access_request->driver]) : ''?></td>
					<td class="text-nowrap"><?= h($access_request->access_request->person->rut) ?></td>
					<td class="text-nowrap"><?= h($access_request->access_request->person->name) ?> &nbsp; <?= h($access_request->access_request->person->lastname) ?></td>
					<td class="text-nowrap"><?= h($access_request->access_request->person->company_people[0]->profile->name)?></td>
					<td class="text-nowrap"><?= h($access_request->access_request->door->name) ?></td>
					<td class="text-nowrap"><?= $this->element('actionLabel', ['actionID' => $access_request->access_request->action]) ?></td>
					<td class="text-nowrap"><?= $access_request->access_request->has('access_status') ? $this->element('statusLabel', ['statusID' => $access_request->access_request->access_status->id]) : '' ?></td>
					<td class="text-nowrap"><?= h($access_request->created) ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>