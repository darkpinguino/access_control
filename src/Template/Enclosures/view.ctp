<div class="box">
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="box-header">
				<h3><?= h($enclosure->name) ?></h3>
			</div>
			<div class="box-body">
		    <table class="table">
	        <tr>
            <th><?= __('Nombre') ?></th>
            <td><?= h($enclosure->name) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Ubicación') ?></th>
            <td><?= h($enclosure->location) ?></td>
	        </tr>
	        </tr><tr>
            <th><?= __('Descripción') ?></th>
            <td><?= h($enclosure->description) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Empresa') ?></th>
            <td><?= $enclosure->has('company') ? $this->Html->link($enclosure->company->name, ['controller' => 'Companies', 'action' => 'view', $enclosure->company->id]) : '' ?></td>
	        </tr>
	        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($enclosure->id) ?></td>
	        <tr>
            <th><?= __('Agregada') ?></th>
            <td><?= h($enclosure->created) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Modificada') ?></th>
            <td><?= h($enclosure->modified) ?></td>
	        </tr>
		    </table>
			</div>
		</div>
	</div>
</div>

<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Puertas'])?>
	<div class="box-body">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th><?= $this->Paginator->sort('id', 'ID') ?></th>
					<th><?= $this->Paginator->sort('name', 'Nombre') ?></th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($doors as $door): ?>
				<tr>
					<td><?= h($door->id) ?></td>
					<td><?= h($door->name) ?></td>
					<td>
						<?= $this->Form->postLink(__('Quitar'), 
		              ['action' => 'deleteDoor', $enclosure->id, $door->id], 
		              [
		                'confirm' => __('Are you sure you want to delete DOOR # {0}?', $door->id), 
		                'class' => 'btn btn-danger btn-xs'
		              ]) 
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