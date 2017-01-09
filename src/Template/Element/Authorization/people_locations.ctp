<?php //debug($door_id); die; ?>

<?= $this->element('tableHeader', ['title' => 'Personas Ingresadas'])?>
<div class="box-body">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered table-striped table-hover">
			  <thead>
				<tr>
					<th>RUT</th>
				  <th>Nombre</th>
				  <th>Perfil</th>
				  <th>Recinto</th>
				  <th>Hora Ingreso</th>
				</tr>
			  </thead>
			  <tbody>
				  <?php foreach ($people_locations as $location): ?>
				  <tr>
						<td><?= h($location->person->rut)?></td>
					  <td><?= h($location->person->name)?> &nbsp; <?= h($location->person->lastname)?></td>
					  <td><?= h($location->person->company_people[0]->profile->name)?></td>
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