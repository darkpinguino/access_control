<div class="box">
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="box-header">
				<h3><?= h($vehicleAccessRequest->id) ?></h3>
			</div>
			<div class="box-body">
			  <table class="table">
			  	<tr>
			  		<th><?= __('Patente') ?></th>
			  		<td><?= $vehicleAccessRequest->has('vehicle') ? $this->Html->link($vehicleAccessRequest->vehicle->number_plate, ['controller' => 'vehicles', 'action' => 'view', $vehicleAccessRequest->vehicle->id]) : '' ?></td>
			  	</tr>
			  	<tr>
			  		<th><?= __('Conductor') ?></th>
			  		<td><?= $vehicleAccessRequest ? $this->element('driver', ['driver' => $vehicleAccessRequest->driver]) : ''?></td>
			  	</tr>
			  	<tr>
			  		<th><?= __('Rut')?></th>
			  		<td><?= $vehicleAccessRequest->access_request->has('person') ? $this->Html->link($vehicleAccessRequest->access_request->person->rut, ['controller' => 'People', 'action' => 'view', $vehicleAccessRequest->access_request->person->id]) : '' ?></td>
			  	</tr>
		      <tr>
	          <th><?= __('Nombre') ?></th>
	          <td><?= $vehicleAccessRequest->access_request->has('person') ? $this->Html->link($vehicleAccessRequest->access_request->person->fullName, ['controller' => 'People', 'action' => 'view', $vehicleAccessRequest->access_request->person->id]) : '' ?></td>
		      </tr>
		      <tr>
	          <th><?= __('Puerta') ?></th>
	          <td><?= $vehicleAccessRequest->access_request->has('door') ? $this->Html->link($vehicleAccessRequest->access_request->door->name, ['controller' => 'Doors', 'action' => 'view', $vehicleAccessRequest->access_request->door->id]) : '' ?></td>
		      </tr>
		      <tr>
		      	<th><?= __('Acción')?></th>
		      	<td><?= $this->element('actionLabel', ['actionID' => $vehicleAccessRequest->action]) ?></td>
		      </tr>
		      <tr>
		      	<th><?= __('Estado de acceso')?></th>
		      	<td><?= $vehicleAccessRequest->access_request->has('access_status') ? $this->element('statusLabel', ['statusID' => $vehicleAccessRequest->access_request->access_status->id]) : '' ?></td>
		      </tr>
		      <tr>
	          <th><?= __('ID') ?></th>
	          <td><?= $this->Number->format($vehicleAccessRequest->id) ?></td>
		      </tr>
		      <tr>
	          <th><?= __('Agregado') ?></th>
	          <td><?= h($vehicleAccessRequest->created) ?></td>
		      </tr>
			  </table>
			</div>
		</div>
	</div>
</div>

<?php if (!empty($vehicleAccessRequest->answers_set) && $vehicleAccessRequest->answers_set->id != -1): ?>
	<div class="row">
		<div class="col-md-12">
			<div class="box">
					<?= $this->element('../Forms/view_answered_form', ['answers_sets' => $vehicleAccessRequest->answers_set])?>
			</div>
		</div>
	</div>
<?php endif ?>	
