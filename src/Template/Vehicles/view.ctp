<div class="box">
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="box-header">
				<h3><?= h($vehicle->number_plate) ?></h3>
			</div>
			<div class="box-body">
		    <table class="table">
	        <tr>
            <th><?= __('Patente') ?></th>
            <td><?= h($vehicle->number_plate) ?></td>
	        </tr>
	        <tr>
            <th><?= __('ID') ?></th>
            <td><?= h($vehicle->id) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Tipo') ?></th>
            <td><?= h($vehicle->vehicle_type->type) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Creado') ?></th>
            <td><?= h($vehicle->created) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Modificado') ?></th>
            <td><?= h($vehicle->modified) ?></td>
	        </tr>
		    </table>
			</div>
		</div>
	</div>
</div>

<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Autorización'])?>
  <div class="box-body">
    <table class="table">
      <thead>
        <tr>
          <th><?= $this->Paginator->sort('company_person.person.rut', 'Rut') ?></th>
          <th><?= $this->Paginator->sort('company_person.person.fullName', 'Nombre') ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($vehicle_authorizations as $vehicle_authorization): ?>
        <tr>
        	<td><?= h($vehicle_authorization->company_person->person->rut)?></td>
        	<td><?= h($vehicle_authorization->company_person->person->fullName)?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div class="box-footer">
  	<?= $this->element('paginator') ?>
  </div>
</div>
