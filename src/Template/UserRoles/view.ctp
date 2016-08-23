<div class="box">
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="box-header">
				<h3><?= h($userRole->role) ?></h3>
			</div>
			<div class="box-body">
				<table class="table">
					<tr>
						<th><?= __('Rol') ?></th>
						<td><?= h($userRole->role) ?></td>
					</tr>
					</tr>
					<tr>
						<th><?= __('Descripción') ?></th>
						<td><?= h($userRole->description) ?></td>
					</tr>
					<tr>
						<th><?= __('ID') ?></th>
						<td><?= $this->Number->format($userRole->id) ?></td>
					<tr>
						<th><?= __('Agregada') ?></th>
						<td><?= h($userRole->created) ?></td>
					</tr>
					<tr>
						<th><?= __('Modificada') ?></th>
						<td><?= h($userRole->modified) ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
