<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Usuarios'])?>
	<div class="box-body">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th><?= $this->Paginator->sort('id', 'ID') ?></th>
					<th><?= $this->Paginator->sort('username', 'Nombre de Usuario') ?></th>
					<th><?= $this->Paginator->sort('UserRoles.role', 'Rol') ?></th>
					<th><?= $this->Paginator->sort('People.name', 'Nombre') ?></th>
					<th><?= $this->Paginator->sort('created') ?></th>
					<th><?= $this->Paginator->sort('modified') ?></th>
					<th><?= __('Acciones') ?></th>
				</tr>
			</thead>
			<tbody>
					<?php foreach ($users as $user): ?>
					<tr>
							<td><?= $this->Number->format($user->id) ?></td>
							<td><?= h($user->username) ?></td>
							<td><?= h($user->user_role->role) ?></td>
							<td><?= h($user->person->name) ?></td>
							<td><?= h($user->created) ?></td>
							<td><?= h($user->modified) ?></td>
							<?= $this->element('action', ['entityId' => $user->id, 'displayField' => $user->{$displayField}])?>
					</tr>
					<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="box-footer clearfix">
		<?= $this->element('paginator') ?>
	</div>
</div>