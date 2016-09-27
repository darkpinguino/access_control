<?= $this->element('tableHeader', ['title' => 'Vehiculos'])?>
<div class="box-body">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered table-striped table-hover">
			  <thead>
				<tr>
					<th>Patente</th>
				  <th>Rut Conductor</th>
				  <th>Nombre Conductor</th>
				  <th>Perfil</th>
				  <th>Reciento</th>
				  <th><?= __('Acciones') ?></th>
				</tr>
			  </thead>
			  <tbody>
				  <?php foreach ($vehicles_locations as $location): 
				  	if ($location->driver == 1): ?>
						  <tr>
								<td><?= h($location->vehicle->number_plate) ?></td>
								<td><?= h($location->person->rut) ?></td>
							  <td><?= h($location->person->name)?> &nbsp; <?= h($location->person->lastname)?></td>
							  <td><?= h($location->person->company_people[0]->profile->name)?></td>
							  <td><?= h($location->enclosure->name)?></td>
							  <td>
								<button type="button" person-rut=<?= h($location->person->rut)?>  door-id=<?= h($door_id)?>
									acction="out" class="btn btn-xs btn-danger authorization">Retirar</button>
							  </td>
						  </tr>
				  <?php endif;
				  	endforeach; ?>
			  </tbody>
			</table>
		</div>
	</div>
</div>