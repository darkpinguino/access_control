<div class="box">
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="box-header">
				<h3><?= h($vehicle->number_plate) ?></h3>
			</div>
			<div class="box-body">
		    <table class="table">
	        <tr>
            <th><?= __('Patente') ?></th>
            <td><?= h($vehicle->number_plate) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Empresa') ?></th>
            <td><?= $vehicle->has('company') ? $this->Html->link($vehicle->company->name, ['controller' => 'Companies', 'action' => 'view', $vehicle->company->id]) : '' ?></td>
	        </tr>
	        <tr>
            <th><?= __('ID') ?></th>
            <td><?= h($vehicle->id) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Empresa') ?></th>
            <td><?= h($vehicle->created) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Modificado') ?></th>
            <td><?= h($vehicle->modified) ?></td>
	        </tr>
		    </table>
			</div>
		</div>
	</div>
</div>
