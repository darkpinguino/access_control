<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Perfiles'])?>
	<div class="box-body">
			<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<?php if ($userRole_id == 1): ?>
						<th><?= $this->Paginator->sort('id', 'ID') ?></th>
					<?php endif ?>
					<th><?= $this->Paginator->sort('name', 'Nombre') ?></th>
					<th><?= $this->Paginator->sort('maxTime', 'Horas máximas de ingreso') ?></th>
					<th><?= __('Acciones') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($profiles as $profile): ?>
				<tr>
					<?php if ($userRole_id == 1): ?>
						<td><?= h($profile->id) ?></td>
					<?php endif ?>
					<td><?= h($profile->name) ?></td>
					<td><?= h($profile->company_profiles[0]->maxTime)?></td>
					<?php if ($userRole_id == 1): ?>
						<?= $this->element('action', ['entityId' => $profile->id]) ?>
					<?php else: ?>
						<?= $this->element('action_min', ['entityId' => $profile->id]) ?>
					<?php endif; ?>
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