<div class="box">
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="box-header">
			<h3><?= h($workArea->name) ?></h3>
			</div>
			<div class="box-body">
			  <table class="table">
			  <tr>
			  	<th><?= __('Nombre') ?></th>
			  	<td><?= h($workArea->name) ?></td>
			  </tr>
			  <?php if ($userRole_id == 1): ?>
				  <tr>
				  	<th><?= __('ID') ?></th>
				  	<td><?= h($workArea->id) ?></td>
				  </tr>
			  <?php endif ?>
			  <tr>
			  	<th><?= __('Agregada') ?></th>
			  	<td><?= h($workArea->created) ?></td>
			  </tr>
			  <tr>
			  	<th><?= __('Modificada') ?></th>
			  	<td><?= h($workArea->modified) ?></td>
			  </tr>
			  </table>
			</div>
		</div>
	</div>
</div>
<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Personas'])?>
	<div class="box-body">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<?php if ($userRole_id == 1): ?>
						<th><?= $this->Paginator->sort('id', 'ID') ?></th>
					<?php endif ?>
					<th><?= $this->Paginator->sort('People.rut', 'Rut') ?></th>
					<th><?= $this->Paginator->sort('People.name', 'Nombre') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($company_people as $company_person): ?>
				<tr>
					<?php if ($userRole_id == 1): ?>
						<td><?= h($company_person->id) ?></td>
					<?php endif ?>
					<td><?= h($company_person->person->rut)?></td>
					<td><?= h($company_person->person->fullName) ?></td>
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
