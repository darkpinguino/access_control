<div class="box">
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="box-header">
				<h3><?= h($user->person->name) ?></h3>
			</div>
			<div class="box-body">
				<table class="table">
					<tr>
						<th><?= __('Nombre de Usuario') ?></th>
						<td><?= h($user->username) ?></td>
					</tr>
					<tr>
						<th><?= __('Rol') ?></th>
						<td><?= h($user->user_role->role) ?></td>
					</tr>
					<tr>
						<th><?= __('Nombre') ?></th>
						<td><?= h($user->person->fullName) ?></td>
					</tr>
					<tr>
						<th><?= __('Puerta a cargo')?></th>
						<td><?= h($user->door->name) ?></td>
					</tr>
					<?php if ($userRole_id == 1): ?>
						<tr>
							<th><?= __('ID') ?></th>
							<td><?= $this->Number->format($user->id) ?></td>
						</tr>
						<tr>
							<th><?= __('Empresa') ?></th>
							<td><?= h($user->company->name) ?></td>
						</tr>
						<tr>
					<?php endif ?>
						<th><?= __('Agregado') ?></th>
						<td><?= h($user->created) ?></td>
					</tr>
					<tr>
						<th><?= __('Modificado') ?></th>
						<td><?= h($user->modified) ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>