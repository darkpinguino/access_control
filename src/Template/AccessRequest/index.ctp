<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Peticiones de accesos'])?>
	<div class="box-body">
		<table class="table">
			<thead>
				<tr>
					<th><?= $this->Paginator->sort('id', 'ID') ?></th>
					<th><?= $this->Paginator->sort('People.rut', 'Rut') ?></th>
					<th><?= $this->Paginator->sort('people_id', 'Persona') ?></th>
					<th><?= $this->Paginator->sort('door_id', 'Puerta') ?></th>
					<th><?= $this->Paginator->sort('access_status_id', 'Estado de Accesso') ?></th>
					<th><?= $this->Paginator->sort('created', 'Agregado') ?></th>
					<th><?= $this->Paginator->sort('modified', 'Modificado') ?></th>
					<th><?= __('Acciones') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($accessRequest as $access_request): ?>
				<tr>
					<td><?= h($access_request->id) ?></td>
					<td><?= $access_request->has('person') ? $this->Html->link($access_request->person->rut, ['controller' => 'People', 'action' => 'view', $access_request->person->id]) : '' ?>
					</td><td><?= $access_request->has('person') ? $this->Html->link($access_request->person->name, ['controller' => 'People', 'action' => 'view', $access_request->person->id]) : '' ?></td>
					<td><?= $access_request->has('door') ? $this->Html->link($access_request->door->name, ['controller' => 'Doors', 'action' => 'view', $access_request->door->id]) : '' ?></td>
					<td><?= $access_request->has('access_status') ? $this->element('statusLabel', ['statusID' => $access_request->access_status->id]) : '' ?></td>
					<td><?= h($access_request->created) ?></td>
					<td><?= h($access_request->modified) ?></td>
					<?= $this->element('action', ['entityId' => $access_request->id])?>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="box-footer">
		<?= $this->element('paginator') ?>
	</div>
	<div class="box-footer">
		<?= $this->Html->link('Reporte', ['action' => 'report'], ['class' => 'btn btn-primary pull-right'])?>
	</div>
</div>
