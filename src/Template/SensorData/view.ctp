<div class="box">
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="box-hedaer">
				<h3><?= h($sensorData->sensor_type->name) ?></h3>
			</div>
			<div class="box-body">
		    <table class="table">
	        <tr>
            <th><?= __('Tipo de Sensor') ?></th>
            <td><?= $sensorData->has('sensor_type') ? $this->Html->link($sensorData->sensor_type->name, ['controller' => 'SensorTypes', 'action' => 'view', $sensorData->sensor_type->id]) : '' ?></td>
	        </tr>
	        <tr>
            <th><?= __('Persona') ?></th>
            <td><?= $sensorData->has('person') ? $this->Html->link($sensorData->person->name, ['controller' => 'People', 'action' => 'view', $sensorData->person->id]) : '' ?></td>
	        </tr>
	        <tr>
            <th><?= __('Dato') ?></th>
            <td><?= h($sensorData->data) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Empresa') ?></th>
            <td><?= $sensorData->has('company') ? $this->Html->link($sensorData->company->name, ['controller' => 'Companies', 'action' => 'view', $sensorData->company->id]) : '' ?></td>
	        </tr>
	        <tr>
            <th><?= __('ID') ?></th>
            <td><?= h($sensorData->id) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Agregado') ?></th>
            <td><?= h($sensorData->created) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Modificado') ?></th>
            <td><?= h($sensorData->modified) ?></td>
	        </tr>
		    </table>
			</div>
		</div>
	</div>
</div>
