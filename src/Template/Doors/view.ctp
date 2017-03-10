<div class="box">
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="box-header">
				<h3><?= h($door->name) ?></h3>
			</div>
			<div class="box-body">
				<table class="table">
					<tr>
						<th><?= __('Nombre') ?></th>
						<td><?= h($door->name) ?></td>
					</tr>
					<tr>
						<th><?= __('Ubicación') ?></th>
						<td><?= h($door->location) ?></td>
					</tr>
					</tr>
					<tr>
						<th><?= __('Descripción') ?></th>
						<td><?= h($door->description) ?></td>
					</tr>
					<tr>
						<th><?= __('Tipo') ?></th>
						<td><?= $this->element('door_type', ['typeID' => $door->type])?></td>
					</tr>
					<tr>
						<th><?= __('Acceso') ?></th>
						<td><?= $this->element('door_access', ['accessID' => $door->access_type])?></td>
					</tr>

					<?php if ($door->main): ?>
						<tr>
							<th>Principal</th>
							<td><span class="label label-success">Principal</span></td>
						</tr>
					<?php endif ?>

					<?php if ($userRole_id == 1): ?>
						<tr>
							<th><?= __('Empresa') ?></th>
							<td><?= $door->has('company') ? $this->Html->link($door->company->name, ['controller' => 'Companies', 'action' => 'view', $door->company->id]) : '' ?></td>
						</tr>
						<tr>
							<th><?= __('ID') ?></th>
							<td><?= $this->Number->format($door->id) ?></td>
						<tr>
					<?php endif ?>
						<th><?= __('Agregada') ?></th>
						<td><?= h($door->created) ?></td>
					</tr>
					<tr>
						<th><?= __('Modificada') ?></th>
						<td><?= h($door->modified) ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Roles de acceso'])?>
	<div class="box-body">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<?php if ($userRole_id == 1): ?>
						<th><?= $this->Paginator->sort('id', 'ID') ?></th>
					<?php endif ?>
					<th><?= $this->Paginator->sort('name', 'Nombre') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($accessRoles as $accesRole): ?>
				<tr>
					<?php if ($userRole_id == 1): ?>
						<td><?= h($accesRole->id) ?></td>
					<?php endif ?>
					<td><?= h($accesRole->name) ?></td>
					</tr>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="box-footer clearfix">
		<?= $this->element('paginator') ?>
	</div>
</div>