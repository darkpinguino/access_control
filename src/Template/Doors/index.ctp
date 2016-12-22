<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Puertas'])?>
	<div class="box-body">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<?php if ($userRole_id == 1): ?>
						<th><?= $this->Paginator->sort('id', 'ID') ?></th>
					<?php endif ?>
					<th><?= $this->Paginator->sort('name', 'Nombre') ?></th>
					<th><?= $this->Paginator->sort('type', 'Tipo') ?></th>
					<th><?= $this->Paginator->sort('access_type', 'Acceso')?></th>
					<th><?= $this->Paginator->sort('enclosure.name', 'Recinto')?></th>
					<th><?= $this->Paginator->sort('location', 'Ubicación') ?></th>
					<?php if ($userRole_id == 1): ?>
						<th><?= $this->Paginator->sort('company_id', 'Empresa') ?></th>
					<?php endif;?>
					<th><?= $this->Paginator->sort('created', 'Agregada') ?></th>
					<th><?= $this->Paginator->sort('modified', 'Modificada') ?></th>
					<th><?= __('Acciones') ?></th>
				</tr>
			</thead>
			<tbody>
					<?php foreach ($doors as $door): ?>
					<tr>

						<?php if ($userRole_id == 1): ?>
							<td><?= $this->Number->format($door->id) ?></td>
						<?php endif; ?>
						<td><?= h($door->name) ?></td>
						<td><?= $this->element('door_type', ['typeID' => $door->type]) ?></td>
						<td><?= $this->element('door_access', ['accessID' => $door->access_type]) ?></td>
						<td><?= $door->has('enclosure') ? $this->Html->link($door->enclosure->name, ['controller' => 'Enclosures', 'action' => 'view', $door->enclosure->id]) : '' ?></td>
						<td><?= h($door->location) ?></td>
						<?php if ($userRole_id == 1): ?>
							<td><?= $door->has('company') ? $this->Html->link($door->company->name, ['controller' => 'Companies', 'action' => 'view', $door->company->id]) : '' ?></td>
						<?php endif; ?>
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
