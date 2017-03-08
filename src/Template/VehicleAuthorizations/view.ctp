<div class="box">
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="box-header">
				<h3>Autorización del vehículo <?= h($vehicleAuthorization->vehicle->number_plate) ?></h3>
			</div>
			<div class="box-body">
			  <table class="table">
				<tr>
					<th><?= __('Patente') ?></th>
					<td><?= h($vehicleAuthorization->vehicle->number_plate) ?></td>
				</tr>
				<tr>
					<th><?= __('Persona autorizada') ?></th>
					<td><?= h($vehicleAuthorization->company_person->person->fullName) ?></td>
				</tr>
				<tr>
				  <th><?= __('Agregado') ?></th>
				  <td><?= h($vehicleAuthorization->created) ?></td>
				</tr>
				<tr>
				  <th><?= __('Modificado') ?></th>
				  <td><?= h($vehicleAuthorization->modified) ?></td>
				</tr>
			  </table>
			</div>
		</div>
	</div>
</div>