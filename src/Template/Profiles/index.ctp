<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Perfiles'])?>
	<div class="box-body">
			<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th><?= $this->Paginator->sort('id', 'ID') ?></th>
					<th><?= $this->Paginator->sort('name', 'Nombre') ?></th>
					<th><?= $this->Paginator->sort('maxTime', 'Horas máximas de ingreso') ?></th>
					<th><?= __('Acciones') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($profiles as $profile): ?>
				<tr>
					<td><?= h($profile->id) ?></td>
					<td><?= h($profile->name) ?></td>
					<td><?= h($profile->maxTime)?></td>
					<?= $this->element('action', ['entityId' => $profile->id])?>
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