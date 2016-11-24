<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Puertas'])?>
	<div class="box-body">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th><?= $this->Paginator->sort('id', 'ID') ?></th>
					<th><?= $this->Paginator->sort('name', 'Nombre') ?></th>
					<th><?= $this->Paginator->sort('location', 'Ubicación') ?></th>
					<th><?= $this->Paginator->sort('company_id', 'Empresa') ?></th>
					<th><?= $this->Paginator->sort('created', 'Agregada') ?></th>
					<th><?= $this->Paginator->sort('modified', 'Modificada') ?></th>
					<th><?= __('Acciones') ?></th>
				</tr>
			</thead>
			<tbody>
					<?php foreach ($doors as $door): ?>
					<tr>
							<td><?= $this->Number->format($door->id) ?></td>
							<td><?= h($door->name) ?></td>
							<td><?= h($door->location) ?></td>
							<td><?= $door->has('company') ? $this->Html->link($door->company->name, ['controller' => 'Companies', 'action' => 'view', $door->company->id]) : '' ?></td>
							<td><?= h($door->created) ?></td>
							<td><?= h($door->modified) ?></td>
							<td>
	            <?= $this->Html->link(__('Ver'), 
	              ['action' => 'view', $door->id], 
	              ['class' => 'btn btn-primary btn-xs']) 
	            ?>
	            <?= $this->Html->link(__('Editar'), 
	              ['action' => 'edit', $door->id], 
	              ['class' => 'btn btn-warning btn-xs']) 
	            ?>
	            <?= $this->Form->postLink(__('Eliminar'), 
	              ['action' => 'delete', $door->id], 
	              [
	                'confirm' => __('Are you sure you want to delete # {0}?', $door->id), 
	                'class' => 'btn btn-danger btn-xs'
	              ]) 
	            ?>
	            <?= $this->Html->link(__('Editar roles'), 
	              ['action' => 'updateRole', $door->id], 
	              ['class' => 'btn btn-success btn-xs']) 
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
