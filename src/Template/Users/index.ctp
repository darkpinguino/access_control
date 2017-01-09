<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Usuarios'])?>
	<div class="box-body">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<?php if ($userRole_id == 1): ?>
						<th><?= $this->Paginator->sort('id', 'ID') ?></th>
					<?php endif ?>
					<th><?= $this->Paginator->sort('username', 'Nombre de Usuario') ?></th>
					<th><?= $this->Paginator->sort('UserRoles.role', 'Rol') ?></th>
					<th><?= $this->Paginator->sort('People.name', 'Nombre') ?></th>
					<?php if ($userRole_id == 1): ?>
						<th><?= $this->Paginator->sort('User.company.name', 'Empresa')?></th>
					<?php endif; ?>
					<th><?= $this->Paginator->sort('created', 'Creado') ?></th>
					<th><?= $this->Paginator->sort('modified', 'Modificado') ?></th>
					<th><?= __('Acciones') ?></th>
				</tr>
			</thead>
			<tbody>
					<?php foreach ($users as $user): ?>
					<tr>
							<?php if ($userRole_id == 1): ?>
								<td><?= $this->Number->format($user->id) ?></td>
							<?php endif ?>
							<td><?= h($user->username) ?></td>
							<td><?= h($user->user_role->role) ?></td>
							<td><?= h($user->person->fullName) ?></td>
							<?php if ($userRole_id == 1): ?>
								<td><?= h($user->company->name) ?></td>
							<?php endif; ?>
							<td><?= h($user->created) ?></td>
							<td><?= h($user->modified) ?></td>
							<?= $this->element('action', ['entityId' => $user->id])?>
					</tr>
					<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="box-footer clearfix">
		<?= $this->element('paginator') ?>
	</div>
</div>