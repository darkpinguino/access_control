<?= $this->element('tableHeader', ['title' => 'Vehiculos'])?>
<div class="box-body">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered table-striped table-hover">
			  <thead>
				<tr>
					<th><?= $this->Paginator->sort('Vehicles.number_plate', 'Patente') ?></th>
				  <th>Rut</th>
				  <th>Nombre</th>
				  <th>Conductor</th>
				  <th>Perfil</th>
				  <th><?= $this->Paginator->sort('Enclosures.name', 'Recinto') ?> </th>
				</tr>
			  </thead>
			  <tbody>
				  <?php foreach ($vehicles_locations as $vehicle_location): 
				  	foreach ($vehicle_location->vehicle_people_locations as $vehicle_people_location): ?>
						  <tr>
								<td><?= h($vehicle_location->vehicle->number_plate) ?></td>
								<td><?= h($vehicle_people_location->person->rut) ?></td>
							  <td><?= h($vehicle_people_location->person->name)?> &nbsp; <?= h($vehicle_people_location->person->lastname)?></td>
							  <td><?= $this->element('driver', ['driver' => $vehicle_people_location->driver]) ?></td>
							  <td><?= h($vehicle_people_location->person->company_people[0]->profile->name)?></td>
							  <td><?= h($vehicle_location->enclosure->name)?></td>
						  </tr>
						<?php endforeach;
				  endforeach; ?>
			  </tbody>
			</table>
		</div>
	</div>
</div>
<div class="box-footer clearfix">
  <?= $this->element('paginator') ?>
</div>