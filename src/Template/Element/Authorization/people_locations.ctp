<?= $this->element('tableHeader', ['title' => 'Personas Ingresadas'])?>
<div class="box-body">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered table-striped table-hover">
			  <thead>
				<tr>
					<th><?= $this->Paginator->sort('People.rut', 'Rut') ?></th>
				  <th><?= $this->Paginator->sort('People.name', 'Nombre')?></th>
				  <th><?= $this->Paginator->sort('People.company_people.Profiles.id', 'Perfil')?></th>
				  <th><?= $this->Paginator->sort('People.company_people.contractor_company.name', 'Empresa contratista') ?></th> 
				  <th><?= $this->Paginator->sort('People.company_people.work_area.name', 'Área de trabajo') ?></th>
				  <th><?= $this->Paginator->sort('Enclosures.name', 'Recinto') ?></th>
				  <th><?= $this->Paginator->sort('created', 'Hora Ingreso') ?></th>
				</tr>
			  </thead>
			  <tbody>
				  <?php foreach ($people_locations as $location): ?>
				  <tr>
						<td><?= h($location->person->rut)?></td>
					  <td><?= h($location->person->fullName)?></td>
					  <td><?= h($location->person->company_people[0]->profile->name)?></td>
					  <td><?= h($location->person->company_people[0]->contractor_company->name)?></td>
					  <td><?= h($location->person->company_people[0]->work_area->name)?></td>
					  <td><?= h($location->enclosure->name)?></td>
					  <td><?= h($location->created)?></td>
					  <td>
					  </td>
				  </tr>
				  <?php endforeach; ?>
			  </tbody>
			</table>
		</div>
	</div>
</div>
<div class="box-footer clearfix">
  <?= $this->element('paginator') ?>
</div>
<?php 
	if (isset($active_vehicle_alert)) {
		if($this->request->is('ajax')) {
			echo '----';
		}
		if (!strcmp($active_vehicle_alert, 'alert')) {
		 	echo $this->element('Modal/vehicleAlert', ['person_alert' => $person_alert, 'vehicle_location' => $vehicle_location]);
		} else {
			echo $this->element('Modal/vehicleRestriction', ['vehicle_location' => $vehicle_location]);
		}
	} 
?>