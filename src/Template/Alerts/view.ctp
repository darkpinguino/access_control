<div class="box">
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="box-header">
				<h3><?= h($alert->notification->notification) ?></h3>
			</div>
			<div class="box-body">
				<table class="table">
					<tr>
						<th><?= __('Alerta') ?></th>
						<td><?= h($alert->notification->notification) ?></td>
					</tr>
					<tr>
						<th><?= __('Comentario') ?></th>
						<td><?= h($alert->notification->comment) ?></td>
					</tr>
					<tr>
						<th><?= __('Tipo') ?></th>
						<td><?= $this->element('alert_type', ['typeID' => $alert->type]) ?></td>
					</tr>
					<tr>
						<th><?= __('Rut') ?></th>
						<td><?= h($alert->access_request->person->rut) ?></td>
					</tr>
					<tr>
						<th><?= __('Nombre') ?></th>
						<td><?= $this->Html->link($alert->access_request->person->fullName, ['controller' => 'People', 'action' => 'view', $alert->access_request->person->id]) ?></td>

					</tr>
					<tr>
						<th><?= __('Puerta') ?></th>
						<td><?= $this->Html->link($alert->access_request->door->name, ['controller' => 'Doors', 'action' => 'view', $alert->access_request->door->id]) ?></td>
					</tr>
					<tr>
						<th><?= __('Recinto') ?></th>
						<td><?= $this->Html->link($alert->access_request->door->enclosure->name, ['controller' => 'Enclosures', 'action' => 'view', $alert->access_request->door->enclosure->id]) ?></td>
					</tr>
					<?php if ($userRole_id == 1): ?>
						<tr>
							<th><?= __('ID') ?></th>
							<td><?= $this->Number->format($alert->id) ?></td>
						</tr>
						<tr>
							<th><?= __('Empresa') ?></th>
							<td><?= h($alert->notification->company_id) ?></td>
						</tr>
						<tr>
					<?php endif ?>
						<th><?= __('Agregada') ?></th>
						<td><?= h($alert->created) ?></td>
					</tr>
					<tr>
						<th><?= __('Modificada') ?></th>
						<td><?= h($alert->modified) ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>