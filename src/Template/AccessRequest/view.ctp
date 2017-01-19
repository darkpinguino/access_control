<div class="box">
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="box-header">
				<h3><?= h($accessRequest->id) ?></h3>
			</div>
			<div class="box-body">
			  <table class="table">
		      <tr>
	          <th><?= __('Persona') ?></th>
	          <td><?= $accessRequest->has('person') ? $this->Html->link($accessRequest->person->fullName, ['controller' => 'People', 'action' => 'view', $accessRequest->person->id]) : '' ?></td>
		      </tr>
		      <tr>
	          <th><?= __('Puerta') ?></th>
	          <td><?= $accessRequest->has('door') ? $this->Html->link($accessRequest->door->name, ['controller' => 'Doors', 'action' => 'view', $accessRequest->door->id]) : '' ?></td>
		      </tr>
		      <tr>
		      	<th><?= __('Acceso')?></th>
		      	<td><?= empty($accessRequest->vehicle_access_request) ? $this->element('access_label', ['accessID' => false]) : $this->element('access_label', ['accessID' => true]) ?></td>
		      </tr>

		      <?php if (!empty($accessRequest->vehicle_access_request)): ?>
		      	<tr>
		      		<th><?= __('Vehículo') ?></th>
		      		<td><?= $this->Html->link($accessRequest->vehicle_access_request[0]->vehicle->number_plate, ['controller' => 'Vehicles', 'action' => 'view', $accessRequest->vehicle_access_request[0]->vehicle->id])?>
		      		</td>
		      	</tr>
		      <?php endif ?>
		      <tr>
		      	<th><?= __('Acción')?></th>
		      	<td><?= $this->element('actionLabel', ['actionID' => $accessRequest->action]) ?></td>
		      </tr>
		      <tr>
		      	<th><?= __('Estado de acceso')?></th>
		      	<td><?= $accessRequest->has('access_status') ? $this->element('statusLabel', ['statusID' => $accessRequest->access_status->id]) : '' ?></td>
		      </tr>
		      <tr>
	          <th><?= __('ID') ?></th>
	          <td><?= $this->Number->format($accessRequest->id) ?></td>
		      </tr>
		      <tr>
	          <th><?= __('Agregado') ?></th>
	          <td><?= h($accessRequest->created) ?></td>
		      </tr>
		      <tr>
	          <th><?= __('Modificado') ?></th>
	          <td><?= h($accessRequest->modified) ?></td>
		      </tr>
			  </table>
			</div>
		</div>
	</div>
</div>
