<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Empresas Contratistas'])?>
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
					<?php foreach ($contractorCompanies as $contractorCompany): ?>
					<tr>
						<?php if ($userRole_id == 1): ?>
							<td><?= $this->Number->format($contractorCompany->id) ?></td>
						<?php endif; ?>
						<td><?= h($contractorCompany->name) ?></td>
						<?php if ($userRole_id == 1): ?>
							<td><?= h($contractorCompany->company->name) ?></td>
						<?php endif; ?>
						<?= $this->element('action', ['entityId' => $contractorCompany->id])?>
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