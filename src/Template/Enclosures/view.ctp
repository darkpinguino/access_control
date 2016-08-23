<div class="box">
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="box-header">
				<h3><?= h($enclosure->name) ?></h3>
			</div>
			<div class="box-body">
		    <table class="table">
	        <tr>
            <th><?= __('Nombre') ?></th>
            <td><?= h($enclosure->name) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Ubicación') ?></th>
            <td><?= h($enclosure->location) ?></td>
	        </tr>
	        </tr><tr>
            <th><?= __('Descripción') ?></th>
            <td><?= h($enclosure->description) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Empresa') ?></th>
            <td><?= $enclosure->has('company') ? $this->Html->link($enclosure->company->name, ['controller' => 'Companies', 'action' => 'view', $enclosure->company->id]) : '' ?></td>
	        </tr>
	        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($enclosure->id) ?></td>
	        <tr>
            <th><?= __('Agregada') ?></th>
            <td><?= h($enclosure->created) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Modificada') ?></th>
            <td><?= h($enclosure->modified) ?></td>
	        </tr>
		    </table>
			</div>
		</div>
	</div>
</div>