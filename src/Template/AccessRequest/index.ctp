<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Registro de accesos'])?>
	<div class="box-body">
		<table class="table">
			<thead>
				<tr>
					<?php if ($userRole_id == 1): ?>
						<th class="text-nowrap"><?= $this->Paginator->sort('id', 'ID') ?></th>
					<?php endif ?>
					<th class="text-nowrap"><?= $this->Paginator->sort('People.rut', 'Rut') ?></th>
					<th class="text-nowrap"><?= $this->Paginator->sort('people_id', 'Persona') ?></th>
					<th><?= $this->Paginator->sort('People.CompanyPeople.Profiles.name', 'Perfil')?></th>
					<th class="text-nowrap"><?= $this->Paginator->sort('door_id', 'Puerta') ?></th>
					<th class="text-nowrap">Acceso</th>
					<?php if ($userRole_id == 1): ?>
						<th class="text-nowrap"><?= $this->Paginator->sort('Door.company.name', 'Empresa')?></th>
					<?php endif; ?>
					<th class="text-nowrap"><?= $this->Paginator->sort('actión', 'Accion') ?></th>
					<th><?= $this->Paginator->sort('access_status_id', 'Estado de Acceso') ?></th>
					<th class="text-nowrap"><?= $this->Paginator->sort('created', 'Agregada') ?></th>
					<th class="text-nowrap"><?= __('Acciones') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($accessRequest as $access_request): ?>
				<tr>
					<?php if ($userRole_id == 1): ?>
						<td class="text-nowrap"><?= h($access_request->id) ?></td>
					<?php endif ?>
					<td class="text-nowrap"><?= $access_request->has('person') ? $this->Html->link($access_request->person->fullRut, ['controller' => 'People', 'action' => 'view', $access_request->person->id]) : '' ?>
					</td>
					<td><?= $access_request->has('person') ? $this->Html->link($access_request->person->fullName, ['controller' => 'People', 'action' => 'view', $access_request->person->id]) : '' ?></td>
					<td><?= $this->element('action_profile', ['profileID' => $access_request->person->company_people[0]->profile->id])?></td>
					<td><?= $access_request->has('door') ? $this->Html->link($access_request->door->name, ['controller' => 'Doors', 'action' => 'view', $access_request->door->id]) : '' ?></td>
					<td><?= empty($access_request->vehicle_access_request) ? $this->element('access_label', ['accessID' => false]) : $this->element('access_label', ['accessID' => true]) ?></td>
					<?php if ($userRole_id == 1): ?>
						<td class="text-nowrap"><?= $access_request->has('door') ? $this->Html->link($access_request->door->company->name, ['controller' => 'Companies', 'action' => 'view', $access_request->door->company_id] ) : ''?></td>
					<?php endif; ?>
					<td class="text-nowrap"><?= $this->element('actionLabel', ['actionID' => $access_request->action]) ?></td>
					<td class="text-nowrap"><?= $access_request->has('access_status') ? $this->element('statusLabel', ['statusID' => $access_request->access_status->id]) : '' ?></td>
					<td class="text-nowrap"><?= h($access_request->created) ?></td>
					<?= $this->element('action_without_edit', ['entityId' => $access_request->id])?>
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
