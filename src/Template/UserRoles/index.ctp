<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Roles'])?>
	<div class="box-body">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th><?= $this->Paginator->sort('id', 'ID') ?></th>
					<th><?= $this->Paginator->sort('role', 'Rol') ?></th>
					<th><?= $this->Paginator->sort('description', 'Descripción') ?></th>
					<th><?= $this->Paginator->sort('created', 'Creado') ?></th>
					<th><?= $this->Paginator->sort('modified', 'Modificado') ?></th>
					<th><?= __('Acciones') ?></th>
				</tr>
			</thead>
			<tbody>
					<?php foreach ($userRoles as $userRole): ?>
					<tr>
							<td><?= $this->Number->format($userRole->id) ?></td>
							<td><?= h($userRole->role) ?></td>
							<td><?= h($userRole->description) ?></td>
							<td><?= h($userRole->created) ?></td>
							<td><?= h($userRole->modified) ?></td>
							<?= $this->element('action', ['entityId' => $userRole->id])?>
					</tr>
					<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="box-footer clearfix">
		<?= $this->element('paginator') ?>
	</div>
</div>