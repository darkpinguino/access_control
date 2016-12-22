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
          <?php if ($userRole_id == 1): ?>
            <tr>
              <th><?= 'ID' ?></th>
              <td><?= h($vehicle->id) ?></td>
            </tr>
          <?php endif ?>
	        <tr>
            <th><?= 'Tipo' ?></th>
            <td><?= h($vehicle->vehicle_type->type) ?></td>
	        </tr>
          <?php if ($userRole_id == 2): ?>
            <tr>
              <th><?= 'Perfil' ?></th>
              <td><?= h($vehicle->company_vehicles[0]->vehicle_profile->name)?></td>
            </tr>
          <?php endif ?>
	        <tr>
            <th><?= __('Creado') ?></th>
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
