<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Alertas'])?>
	<div class="box-body">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<?php if ($userRole_id == 1): ?>
						<th><?= $this->Paginator->sort('id', 'ID') ?></th>
					<?php endif ?>
					<th><?= $this->Paginator->sort('Notification.notification', 'Alerta') ?></th>
					<th><?= $this->Paginator->sort('Alert.type', 'Tipo') ?></th>
					<th><?= $this->Paginator->sort('People.rut', 'Rut')?></th>
					<th><?= $this->Paginator->sort('People.name', 'Nombre')?></th>
					<th><?= $this->Paginator->sort('created', 'Fecha/Hora') ?></th>
					<th><?= __('Acciones') ?></th>
				</tr>
			</thead>
			<tbody>
					<?php foreach ($alerts as $alert): ?>
					<tr>
						<?php if ($userRole_id == 1): ?>
							<td><?= $this->Number->format($alert->id) ?></td>
						<?php endif; ?>
						<td><?= h($alert->notification->notification) ?></td>
						<td><?= $this->element('alert_type', ['typeID' => $alert->type]) ?></td>
						<td><?= h($alert->access_request->person->rut) ?></td>
						<td><?= h($alert->access_request->person->fullName) ?></td>
						<td><?= h($alert->created) ?></td>
						<td>
							<?= $this->Html->link(__('Ver'), 
							  ['action' => 'view', $alert->id], 
							  ['class' => 'btn btn-primary btn-xs']) 
							?>
							<?= $this->Html->link(__('Editar'), 
							  ['action' => 'edit', 'controller' => 'Notifications', $alert->notification->id], 
							  ['class' => 'btn btn-warning btn-xs']) 
							?>
							<?= $this->Form->postLink(__('Eliminar'), 
							  ['action' => 'delete', $alert->id], 
							  [
								'confirm' => __('Are you sure you want to delete # {0}?', $alert->id), 
								'class' => 'btn btn-danger btn-xs'
							  ]) 
							?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="box-footer clearfix">
		<?= $this->element('paginator') ?>
	</div>
</div>
