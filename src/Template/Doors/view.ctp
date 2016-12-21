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
						<td><?php 
							$type = h($door->type); 
							switch ($type) {
									case 1:
											echo "Entrada";
											break;
									case 2:
											echo "Salida";
											break;
									case 3:
											echo "Entrada/Salida";
											break;
									default:
											echo "";
							}
							?></td>
					</tr>
					<tr>
						<th><?= __('Empresa') ?></th>
						<td><?= $door->has('company') ? $this->Html->link($door->company->name, ['controller' => 'Companies', 'action' => 'view', $door->company->id]) : '' ?></td>
					</tr>
					<tr>
						<th><?= __('ID') ?></th>
						<td><?= $this->Number->format($door->id) ?></td>
					<tr>
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
					<th><?= $this->Paginator->sort('id', 'ID') ?></th>
					<th><?= $this->Paginator->sort('name', 'Nombre') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($accessRoles as $accesRole): ?>
				<tr>
					<td><?= h($accesRole->id) ?></td>
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