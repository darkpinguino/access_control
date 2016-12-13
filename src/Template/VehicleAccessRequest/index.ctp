


<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Peticiones de accesos vehículos'])?>
	<div class="box-body">
		<table class="table">
			<thead>
				<tr>
					<th><?= $this->Paginator->sort('id') ?></th>
					<th><?= $this->Paginator->sort('Vehicles.number_plate', ['label' => 'Patente']) ?></th>
					<th><?= $this->Paginator->sort('diver', ['label' => 'Conductor'])?></th>
					<th><?= $this->Paginator->sort('AccessRequest.People.rut', ['label' => 'RUT']) ?></th>
					<th><?= $this->Paginator->sort('AccessRequest.People.name', ['label' => 'Persona']) ?></th>
					<th><?= $this->Paginator->sort('AccessRequest.Doors.name', ['label' => 'Puerta']) ?></th>
					<th><?= $this->Paginator->sort('action', ['label' => 'Acción']) ?></th>
					<th><?= $this->Paginator->sort('AccessRequest.AccessStatus.id', ['label' => 'Estado de Acceso']) ?></th>
					<th><?= $this->Paginator->sort('created', ['label' => 'Creado']) ?></th>
					<th><?= $this->Paginator->sort('modified', ['label' => 'Modificado']) ?></th>
					<th class="actions"><?= __('Acciones') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($vehicleAccessRequest as $vehicle_access_request): ?>
				<tr>
					<td><?= h($vehicle_access_request->id) ?></td>
					<td><?= $vehicle_access_request->has('vehicle') ? $this->Html->link($vehicle_access_request->vehicle->number_plate, ['controller' => 'Vehicles', 'action' => 'view']) : '' ?></td>
					<td><?= $vehicle_access_request ? $this->element('driver', ['driver' => $vehicle_access_request->driver]) : ''?></td>
					<td><?= $vehicle_access_request->has('access_request') ? $this->Html->link($vehicle_access_request->access_request->person->rut, ['controller' => 'People', 'action' => 'view', $vehicle_access_request->access_request->person->id]) : '' ?>
					</td>
					<td><?= $vehicle_access_request->has('access_request') ? $this->Html->link($vehicle_access_request->access_request->person->name, ['controller' => 'People', 'action' => 'view', $vehicle_access_request->access_request->person->id]) : '' ?></td>
					<td><?= $vehicle_access_request->has('access_request') ? $this->Html->link($vehicle_access_request->access_request->door->name, ['controller' => 'Doors', 'action' => 'view', $vehicle_access_request->access_request->door->id]) : '' ?></td>
					<td><?= $this->element('actionLabel', ['actionID' => $vehicle_access_request->action]) ?></td>
					<td><?= $vehicle_access_request->has('access_request') ? $this->element('statusLabel', ['statusID' => $vehicle_access_request->access_request->access_status->id]) : '' ?></td>
					<td><?= h($vehicle_access_request->created) ?></td>
					<td><?= h($vehicle_access_request->modified) ?></td>
					<?= $this->element('action', ['entityId' => $vehicle_access_request->id])?>
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