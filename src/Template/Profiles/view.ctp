<div class="box">
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="box-header">
				<h3><?= h($profile->name) ?></h3>
			</div>
			<div class="box-body">
			  <table class="table">
				<tr>
				  <th><?= __('Nombre') ?></th>
				  <td><?= h($profile->name) ?></td>
				</tr>
				<tr>
				  <th><?= __('Horas máximas de ingreso') ?></th>
				  <td><?= h($profile->company_profiles[0]->maxTime) ?></td>
				</tr>
				<?php if ($userRole_id == 1): ?>
					<tr>
					  <th><?= __('ID') ?></th>
					  <td><?= h($profile->id) ?></td>
					</tr>
				<?php endif ?>
				<tr>
				  <th><?= __('Agregado') ?></th>
				  <td><?= h($profile->created) ?></td>
				</tr>
				<tr>
				  <th><?= __('Modificado') ?></th>
				  <td><?= h($profile->modified) ?></td>
				</tr>
			  </table>
			</div>
		</div>
	</div>
</div>