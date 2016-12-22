<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Perfiles Vehiculos'])?>
	<div class="box-body">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th><?= $this->Paginator->sort('id', 'ID') ?></th>
					<th><?= $this->Paginator->sort('name', 'Nombre') ?></th>
					<th><?= $this->Paginator->sort('created', 'Agregado') ?></th>
					<th><?= $this->Paginator->sort('modified', 'Modificado') ?></th>
					<th><?= __('Acciones') ?></th>
				</tr>
			</thead>
			<tbody>
					<?php foreach ($vehicleProfiles as $vehicleProfile): ?>
					<tr>
							<td><?= $this->Number->format($vehicleProfile->id) ?></td>
							<td><?= h($vehicleProfile->name) ?></td>
							<td><?= h($vehicleProfile->created) ?></td>
							<td><?= h($vehicleProfile->modified) ?></td>
							<?= $this->element('action', ['entityId' => $vehicleProfile->id])?>
					</tr>
					<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="box-footer clearfix">
		<?= $this->element('paginator') ?>
	</div>
</div>
