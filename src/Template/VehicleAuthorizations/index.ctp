<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Autorización Vehículos'])?>
	<div class="box-body">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th><?= $this->Paginator->sort('id', 'ID') ?></th>
					<th><?= $this->Paginator->sort('Vehicle.number_plate', 'Patente') ?></th>
					<th><?= $this->Paginator->sort('CompanyPeople.People', 'Nombre') ?></th>
					<th><?= $this->Paginator->sort('created', 'Agregado') ?></th>
					<th><?= $this->Paginator->sort('modified', 'Modificado') ?></th>
					<th><?= __('Acciones') ?></th>
				</tr>
			</thead>
			<tbody>
					<?php foreach ($vehicleAuthorizations as $vehicleAuthorization): ?>
					<tr>
							<td><?= $this->Number->format($vehicleAuthorization->id) ?></td>
							<td><?= h($vehicleAuthorization->vehicle->number_plate) ?></td>
							<td><?= h($vehicleAuthorization->company_person->person->name) ?> &nbsp; <?= h($vehicleAuthorization->company_person->person->lastname) ?></td>

							<td><?= h($vehicleAuthorization->created) ?></td>
							<td><?= h($vehicleAuthorization->modified) ?></td>
							<?= $this->element('action', ['entityId' => $vehicleAuthorization->id])?>
					</tr>
					<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="box-footer clearfix">
		<?= $this->element('paginator') ?>
	</div>
</div>