<div class="box">
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="box-header">
		  	<h3><?= h($sensorType->name) ?></h3>
			</div>
		    <table class="table">
	        <tr>
            <th><?= __('Nombre') ?></th>
            <td><?= h($sensorType->name) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Modelo') ?></th>
            <td><?= h($sensorType->model) ?></td>
	        </tr><tr>
            <th><?= __('Descripción') ?></th>
            <td><?= h($sensorType->description) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Empresa') ?></th>
            <td><?= $sensorType->has('company') ? $this->Html->link($sensorType->company->name, ['controller' => 'Companies', 'action' => 'view', $sensorType->company->id]) : '' ?></td>
	        </tr>
	        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($sensorType->id) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($sensorType->created) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($sensorType->modified) ?></td>
	        </tr>
		    </table>
		  </div>
	  </div>
  </div>
</div>
