<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Recintos'])?>
	<div class="box-body">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<?php if ($userRole_id == 1): ?>
						<th><?= $this->Paginator->sort('id', 'ID') ?></th>
					<?php endif; ?>
					<th><?= $this->Paginator->sort('name', 'Nombre') ?></th>
					<th><?= $this->Paginator->sort('location', 'Ubicación') ?></th>
					<?php if ($userRole_id == 1): ?>
						<th><?= $this->Paginator->sort('company_id', 'Empresa') ?></th>
					<?php endif; ?>
					<th><?= $this->Paginator->sort('created', 'Agregado') ?></th>
					<th><?= $this->Paginator->sort('modified', 'Modificado') ?></th>
					<th><?= __('Acciones') ?></th>
				</tr>
			</thead>
			<tbody>
					<?php foreach ($enclosures as $enclosure): ?>
					<tr>
							<?php if ($userRole_id == 1):?>
								<td><?= $this->Number->format($enclosure->id) ?></td>
							<?php endif; ?>
							<td><?= h($enclosure->name) ?></td>
							<td><?= h($enclosure->location) ?></td>
							<?php if ($userRole_id == 1):?>
								<td><?= $enclosure->has('company') ? $this->Html->link($enclosure->company->name, ['controller' => 'Companies', 'action' => 'view', $enclosure->company->id]) : '' ?></td>
							<?php endif; ?>
							<td><?= h($enclosure->created) ?></td>
							<td><?= h($enclosure->modified) ?></td>
							
							<td>
									<?= $this->Html->link(__('Ver'), 
										['action' => 'view', $enclosure->id], 
										['class' => 'btn btn-primary btn-xs']) 
									?>
									<?= $this->Html->link(__('Editar'), 
										['action' => 'edit', $enclosure->id], 
										['class' => 'btn btn-warning btn-xs']) 
									?>
									<?= $this->Form->postLink(__('Eliminar'), 
										['action' => 'delete', $enclosure->id], 
										[
											'confirm' => __('Are you sure you want to delete # {0}?', $enclosure->id), 
											'class' => 'btn btn-danger btn-xs'
										]) 
									?>
									<?= $this->Html->link(__('Editar puertas'), 
										['action' => 'updateDoors', $enclosure->id], 
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