


<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Registro de accesos vehículos'])?>
	<div class="box-body">
		<table class="table">
			<thead>
				<tr>
					<?php if ($userRole_id == 1): ?>
						<th class="text-nowrap"><?= $this->Paginator->sort('id') ?></th>
					<?php endif ?>
					<th class="text-nowrap"><?= $this->Paginator->sort('Vehicles.number_plate', ['label' => 'Patente']) ?></th>
					<th class="text-nowrap"><?= $this->Paginator->sort('diver', ['label' => 'Conductor'])?></th>
					<th class="text-nowrap"><?= $this->Paginator->sort('AccessRequest.People.rut', ['label' => 'RUT']) ?></th>
					<th class="text-nowrap"><?= $this->Paginator->sort('AccessRequest.People.name', ['label' => 'Persona']) ?></th>
					<th class="text-nowrap"><?= $this->Paginator->sort('AccessRequest.Doors.name', ['label' => 'Puerta']) ?></th>
					<?php if ($userRole_id == 1): ?>
						<th class="text-nowrap"><?= $this->Paginator->sort('AccessRequest.Doors.Companies.name', ['label' => 'Empresa'])?></th>
					<?php endif; ?>
					<th class="text-nowrap"><?= $this->Paginator->sort('action', ['label' => 'Acción']) ?></th>
					<th class="text-nowrap"><?= $this->Paginator->sort('AccessRequest.AccessStatus.id', ['label' => 'Estado de Acceso']) ?></th>
					<th class="text-nowrap"><?= $this->Paginator->sort('created', ['label' => 'Agregada']) ?></th>
					<th class="text-nowrap actions"><?= __('Acciones') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($vehicleAccessRequest as $vehicle_access_request): ?>
				<tr>
					<?php if ($userRole_id == 1): ?>
						<td><?= h($vehicle_access_request->id) ?></td>
					<?php endif ?>
					<td><?= $vehicle_access_request->has('vehicle') ? $this->Html->link($vehicle_access_request->vehicle->number_plate, ['controller' => 'Vehicles', 'action' => 'view', $vehicle_access_request->vehicle->id]) : '' ?></td>
					<td><?= $vehicle_access_request ? $this->element('driver', ['driver' => $vehicle_access_request->driver]) : ''?></td>
					<td><?= $vehicle_access_request->has('access_request') ? $this->Html->link($vehicle_access_request->access_request->person->rut, ['controller' => 'People', 'action' => 'view', $vehicle_access_request->access_request->person->id]) : '' ?>
					</td>
					<td><?= $vehicle_access_request->has('access_request') ? $this->Html->link($vehicle_access_request->access_request->person->fullName, ['controller' => 'People', 'action' => 'view', $vehicle_access_request->access_request->person->id]) : '' ?></td>
					<td><?= $vehicle_access_request->has('access_request') ? $this->Html->link($vehicle_access_request->access_request->door->name, ['controller' => 'Doors', 'action' => 'view', $vehicle_access_request->access_request->door->id]) : '' ?></td>
					<?php if ($userRole_id == 1): ?>
						<td><?= $vehicle_access_request->has('access_request') ? $this->Html->link($vehicle_access_request->access_request->door->company->name, ['controller' => 'Companies', 'action' => 'view', $vehicle_access_request->access_request->door->company_id]) : '' ?></td>
					<?php endif; ?>
					<td><?= $this->element('actionLabel', ['actionID' => $vehicle_access_request->action]) ?></td>
					<td><?= $vehicle_access_request->has('access_request') ? $this->element('statusLabel', ['statusID' => $vehicle_access_request->access_request->access_status->id]) : '' ?></td>
					<td><?= h($vehicle_access_request->created) ?></td>
					<?= $this->element('action_without_edit', ['entityId' => $vehicle_access_request->id])?>
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