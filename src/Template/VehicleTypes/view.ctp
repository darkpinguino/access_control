<div class="box">
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="box-header">
				<h3><?= h($vehicleType->type) ?></h3>
			</div>
			<div class="box-body">
				<table class="table">
					<tr>
						<th><?= __('Tipo') ?></th>
						<td><?= h($vehicleType->type) ?></td>
					</tr>
					<tr>
						<th><?= __('ID') ?></th>
						<td><?= $this->Number->format($vehicleType->id) ?></td>
					<tr>
						<th><?= __('Agregado') ?></th>
						<td><?= h($vehicleType->created) ?></td>
					</tr>
					<tr>
						<th><?= __('Modificado') ?></th>
						<td><?= h($vehicleType->modified) ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>