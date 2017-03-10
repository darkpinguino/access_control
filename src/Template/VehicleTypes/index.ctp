<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Tipos de Vehículos'])?>
	<div class="box-body">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th><?= $this->Paginator->sort('id', 'ID') ?></th>
					<th><?= $this->Paginator->sort('type', 'Tipo') ?></th>
					<th><?= $this->Paginator->sort('created', 'Agregada') ?></th>
					<th><?= $this->Paginator->sort('modified', 'Modificada') ?></th>
					<th><?= __('Acciones') ?></th>
				</tr>
			</thead>
			<tbody>
					<?php foreach ($vehicleTypes as $vehicleType): ?>
					<tr>
							<td><?= $this->Number->format($vehicleType->id) ?></td>
							<td><?= h($vehicleType->type) ?></td>
							<td><?= h($vehicleType->created) ?></td>
							<td><?= h($vehicleType->modified) ?></td>
							<?= $this->element('action', ['entityId' => $vehicleType->id, 'displayField' => $vehicleType->{$displayField}])?>
					</tr>
					<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="box-footer clearfix">
		<?= $this->element('paginator') ?>
	</div>
</div>