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
	          <td><?= $accessRequest->has('person') ? $this->Html->link($accessRequest->person->name, ['controller' => 'People', 'action' => 'view', $accessRequest->person->id]) : '' ?></td>
		      </tr>
		      <tr>
	          <th><?= __('Puerta') ?></th>
	          <td><?= $accessRequest->has('door') ? $this->Html->link($accessRequest->door->name, ['controller' => 'Doors', 'action' => 'view', $accessRequest->door->id]) : '' ?></td>
		      </tr>
		      <tr>
	          <th><?= __('Estado de Accesso') ?></th>
	          <td><?= h($accessRequest->access_status->status) ?></td>
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
