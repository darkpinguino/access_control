<div class="box">
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="box-header">
		  	<h3><?= h($sensor->code) ?></h3>
			</div>
			<div class="box-body">
		    <table class="table">
	        <tr>
            <th><?= __('Codigo') ?></th>
            <td><?= h($sensor->code) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Tipo de Sensor') ?></th>
            <td><?= $sensor->has('sensor_type') ? $this->Html->link($sensor->sensor_type->name, ['controller' => 'SensorTypes', 'action' => 'view', $sensor->sensor_type->id]) : '' ?></td>
	        </tr>
	        <tr>
            <th><?= __('Puerta') ?></th>
            <td><?= $sensor->has('door') ? $this->Html->link($sensor->door->name, ['controller' => 'Doors', 'action' => 'view', $sensor->door->id]) : '' ?></td>
	        </tr>
	        <tr>
            <th><?= __('Empresa') ?></th>
            <td><?= $sensor->has('company') ? $this->Html->link($sensor->company->name, ['controller' => 'Companies', 'action' => 'view', $sensor->company->id]) : '' ?></td>
	        </tr>
	        <tr>
            <th><?= __('ID') ?></th>
            <td><?= h($sensor->id) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Agregado') ?></th>
            <td><?= h($sensor->created) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Modificado') ?></th>
            <td><?= h($sensor->modified) ?></td>
	        </tr>
		    </table>
		  </div>
	  </div>
  </div>
</div>
