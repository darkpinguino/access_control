


<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Peticiones de accesos vehículos'])?>
	<div class="box-body">
		<table class="table">
			<thead>
				<tr>
					<th class="text-nowrap"><?= $this->Paginator->sort('id') ?></th>
					<th class="text-nowrap"><?= $this->Paginator->sort('Vehicles.number_plate', ['label' => 'Patente']) ?></th>
					<th class="text-nowrap"><?= $this->Paginator->sort('diver', ['label' => 'Conductor'])?></th>
					<th class="text-nowrap"><?= $this->Paginator->sort('AccessRequest.People.rut', ['label' => 'RUT']) ?></th>
					<th class="text-nowrap"><?= $this->Paginator->sort('AccessRequest.People.name', ['label' => 'Persona']) ?></th>
					<th class="text-nowrap"><?= $this->Paginator->sort('AccessRequest.Doors.name', ['label' => 'Puerta']) ?></th>
					<th class="text-nowrap"><?= $this->Paginator->sort('action', ['label' => 'Accion']) ?></th>
					<th class="text-nowrap"><?= $this->Paginator->sort('AccessRequest.AccessStatus.id', ['label' => 'Estado de Acceso']) ?></th>
					<th class="text-nowrap"><?= $this->Paginator->sort('created', ['label' => 'Creado']) ?></th>
					<th class="text-nowrap"><?= $this->Paginator->sort('modified', ['label' => 'Modificado']) ?></th>
					<th class="actions text-nowrap"><?= __('Acciones') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($vehicleAccessRequest as $vehicle_access_request): ?>
				<tr>
					<td class="text-nowrap"><?= h($vehicle_access_request->id) ?></td>
					<td class="text-nowrap"><?= $vehicle_access_request->has('vehicle') ? $this->Html->link($vehicle_access_request->vehicle->number_plate, ['controller' => 'Vehicles', 'action' => 'view']) : '' ?></td>
					<td class="text-nowrap"><?= $vehicle_access_request ? $this->element('driver', ['driver' => $vehicle_access_request->driver]) : ''?></td>
					<td class="text-nowrap"><?= $vehicle_access_request->has('access_request') ? $this->Html->link($vehicle_access_request->access_request->person->rut, ['controller' => 'People', 'action' => 'view', $vehicle_access_request->access_request->person->id]) : '' ?>
					</td>
					<td class="text-nowrap"><?= $vehicle_access_request->has('access_request') ? $this->Html->link($vehicle_access_request->access_request->person->name, ['controller' => 'People', 'action' => 'view', $vehicle_access_request->access_request->person->id]) : '' ?></td>
					<td class="text-nowrap"><?= $vehicle_access_request->has('access_request') ? $this->Html->link($vehicle_access_request->access_request->door->name, ['controller' => 'Doors', 'action' => 'view', $vehicle_access_request->access_request->door->id]) : '' ?></td>
					<td class="text-nowrap"><?= $this->element('actionLabel', ['actionID' => $vehicle_access_request->action]) ?></td>
					<td class="text-nowrap"><?= $vehicle_access_request->has('access_request') ? $this->element('statusLabel', ['statusID' => $vehicle_access_request->access_request->access_status->id]) : '' ?></td>
					<td class="text-nowrap"><?= h($vehicle_access_request->created) ?></td>
					<td class="text-nowrap"><?= h($vehicle_access_request->modified) ?></td>
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