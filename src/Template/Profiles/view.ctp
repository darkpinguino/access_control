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
				  <td><?= h($profile->maxTime) ?></td>
				</tr>
				<tr>
				  <th><?= __('Empresa') ?></th>
				  <td><?= $profile->has('company') ? $this->Html->link($profile->company->name, ['controller' => 'Companies', 'action' => 'view', $profile->company->id]) : '' ?></td>
				</tr>
				<tr>
				  <th><?= __('ID') ?></th>
				  <td><?= h($profile->id) ?></td>
				</tr>
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