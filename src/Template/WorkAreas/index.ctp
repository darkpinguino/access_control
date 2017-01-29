<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Áreas de Trabajo'])?>
	<div class="box-body">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<?php if ($userRole_id == 1): ?>
						<th><?= $this->Paginator->sort('id', 'ID') ?></th>
					<?php endif ?>
					<th><?= $this->Paginator->sort('name', 'Nombre') ?></th>
					<?php if ($userRole_id == 1): ?>
						<th><?= $this->Paginator->sort('Company.name', 'Empresa') ?></th>
					<?php endif ?>
					
					<th><?= __('Acciones') ?></th>
				</tr>
			</thead>
			<tbody>
					<?php foreach ($workAreas as $workArea): ?>
					<tr>
						<?php if ($userRole_id == 1): ?>
							<td><?= $this->Number->format($workArea->id) ?></td>
						<?php endif; ?>
						<td><?= h($workArea->name) ?></td>
						<?php if ($userRole_id == 1): ?>
							<td><?= h($workArea->company->name) ?></td>
						<?php endif; ?>
						<?= $this->element('action', ['entityId' => $workArea->id])?>
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