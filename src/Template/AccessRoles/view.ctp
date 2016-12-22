<div class="box">
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="box-header">
				<h3><?= h($accessRole->name) ?></h3>
			</div>
			<div class="box-body">
		    <table class="table">
	        <tr>
            <th><?= __('Nombre') ?></th>
            <td><?= h($accessRole->name) ?></td>
	        </tr><tr>
            <th><?= __('Descripción') ?></th>
            <td><?= h($accessRole->description) ?></td>
	        </tr>
	        <?php if ($userRole_id == 1): ?>
		        <tr>
	            <th><?= __('Empresa') ?></th>
	            <td><?= $accessRole->has('company') ? $this->Html->link($accessRole->company->name, ['controller' => 'Companies', 'action' => 'view', $accessRole->company->id]) : '' ?></td>
		        </tr>
		        <tr>
	            <th><?= __('ID') ?></th>
	            <td><?= h($accessRole->id) ?></td>
		        </tr>
		        <tr>
	            <th><?= __('Usuario') ?></th>
	            <td><?= $this->Number->format($accessRole->user_id) ?></td>
		        </tr>
	        <?php endif; ?>
	        <tr>
            <th><?= __('Agregado') ?></th>
            <td><?= h($accessRole->created) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Modificado') ?></th>
            <td><?= h($accessRole->modified) ?></td>
	        </tr>
		    </table>
			</div>
		</div>
	</div>
</div>
