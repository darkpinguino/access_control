<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Tipos de Sensores'])?>
	<div class="box-body">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th><?= $this->Paginator->sort('id', 'ID') ?></th>
					<th><?= $this->Paginator->sort('name', 'Nombre') ?></th>
					<th><?= $this->Paginator->sort('model', 'Modelo') ?></th>
					<th><?= $this->Paginator->sort('company_id', 'Empresa') ?></th>
					<th><?= $this->Paginator->sort('created', 'Agregado') ?></th>
					<th><?= $this->Paginator->sort('modified', 'Modificado') ?></th>
					<th class="actions"><?= __('Acciones') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($sensorTypes as $sensorType): ?>
				<tr>
					<td><?= $this->Number->format($sensorType->id) ?></td>
					<td><?= h($sensorType->name) ?></td>
					<td><?= h($sensorType->model) ?></td>
					<td><?= $sensorType->has('company') ? $this->Html->link($sensorType->company->name, ['controller' => 'Companies', 'action' => 'view', $sensorType->company->id]) : '' ?></td>
					<td><?= h($sensorType->created) ?></td>
					<td><?= h($sensorType->modified) ?></td>
					<?= $this->element('action', ['entityId' => $sensorType->id])?>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="box-footer">
		<?= $this->element('paginator') ?>
	</div>
</div>
