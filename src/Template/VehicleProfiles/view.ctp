<div class="box">
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="box-header">
				<h3><?= h($vehicleProfile->name) ?></h3>
			</div>
			<div class="box-body">
				<table class="table">
					<tr>
						<th><?= __('Nombre') ?></th>
						<td><?= h($vehicleProfile->name) ?></td>
					</tr>
					<tr>
						<th><?= __('Empresa') ?></th>
						<td><?= $vehicleProfile->has('company') ? $this->Html->link($vehicleProfile->company->name, ['controller' => 'Companies', 'action' => 'view', $vehicleProfile->company->id]) : '' ?></td>
					</tr>
					<tr>
						<th><?= __('ID') ?></th>
						<td><?= $this->Number->format($vehicleProfile->id) ?></td>
					<tr>
						<th><?= __('Agregada') ?></th>
						<td><?= h($vehicleProfile->created) ?></td>
					</tr>
					<tr>
						<th><?= __('Modificada') ?></th>
						<td><?= h($vehicleProfile->modified) ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>

