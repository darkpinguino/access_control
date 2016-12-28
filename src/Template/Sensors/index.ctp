<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Sensores'])?>
	<div class="box-body">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th><?= $this->Paginator->sort('id', 'ID') ?></th>
					<th><?= $this->Paginator->sort('code', 'Codigo') ?></th>
					<th><?= $this->Paginator->sort('sensor_type_id', 'Tipo de Sensor') ?></th>
					<th><?= $this->Paginator->sort('door_id', 'Puerta') ?></th>
					<th><?= $this->Paginator->sort('company_id', 'Empresa') ?></th>
					<th><?= $this->Paginator->sort('created', 'Agregado') ?></th>
					<th><?= $this->Paginator->sort('modified', 'Modoficado') ?></th>
					<th class="actions"><?= __('Acciones') ?></th>
				</tr>
			</thead>
			<tbody>
					<?php foreach ($sensors as $sensor): ?>
					<tr>
						<td><?= $this->Number->format($sensor->id) ?></td>
						<td><?= h($sensor->code) ?></td>
						<td><?= $sensor->has('sensor_type') ? $this->Html->link($sensor->sensor_type->name, ['controller' => 'SensorTypes', 'action' => 'view', $sensor->sensor_type->id]) : '' ?></td>
						<td><?= $sensor->has('door') ? $this->Html->link($sensor->door->name, ['controller' => 'Doors', 'action' => 'view', $sensor->door->id]) : '' ?></td>
						<td><?= $sensor->has('company') ? $this->Html->link($sensor->company->name, ['controller' => 'Companies', 'action' => 'view', $sensor->company->id]) : '' ?></td>
						<td><?= h($sensor->created) ?></td>
						<td><?= h($sensor->modified) ?></td>
						<?= $this->element('action', ['entityId' => $sensor->id,  'displayField' => $sensor->{$displayField}])?>
					</tr>
					<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="box-footer">
		<?= $this->element('paginator') ?>
	</div>
</div>
