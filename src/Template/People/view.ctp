<div class="box">
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="box-header">
				<h3><?= h($person->name).' '.h($person->lastname) ?></h3>
			</div>
			<div class="box-body">
			  <table class="table">
				<tr>
				  <th><?= __('Rut') ?></th>
				  <td><?= h($person->rut) ?></td>
				</tr>
				<tr>
				  <th><?= __('Nombre') ?></th>
				  <td><?= h($person->name) ?></td>
				</tr>
				<tr>
				  <th><?= __('Apellido') ?></th>
				  <td><?= h($person->lastname) ?></td>
				</tr>
				<?php if ($userRole_id == 1): ?>
					<tr>
					  <th><?= __('ID') ?></th>
					  <td><?= h($person->id) ?></td>
					</tr>
				<?php endif ?>
				<tr>
				  <th><?= __('Telefono') ?></th>
				  <td><?= h($person->phone) ?></td>
				</tr>
				<tr>
				  <th><?= __('Agregado') ?></th>
				  <td><?= h($person->created) ?></td>
				</tr>
				<tr>
				  <th><?= __('Modificado') ?></th>
				  <td><?= h($person->modified) ?></td>
				</tr>
			  </table>
			</div>
		</div>
	</div>
</div>
<div class="box">
  <?= $this->element('tableHeader', ['title' => 'Roles de acceso'])?>
  <div class="box-body">
	  <table class="table table-bordered table-striped table-hover">
	  <thead>
		<tr>
		  <th><?= $this->Paginator->sort('id', 'ID') ?></th>
		  <th><?= $this->Paginator->sort('name', 'Nombre') ?></th>
		  <th>Acciones</th>
		</tr>
	  </thead>
	  <tbody>
		<?php foreach ($accessRoles as $accesRole): ?>
		<tr>
		  <td><?= h($accesRole->id) ?></td>
		  <td><?= h($accesRole->name) ?></td>
		  <td>
				<?= $this->Form->postLink(__('Eliminar'), 
          ['action' => 'deleteRole', $person->id, $accesRole->id], 
          [
            'confirm' => __('Are you sure you want to delete ROLE # {0}?', $accesRole->id), 
            'class' => 'btn btn-danger btn-xs'
          ]) 
        ?>
			</td>
		  </tr>
		</tr>
		<?php endforeach; ?>
	  </tbody>
	  </table>
  </div>
  <div class="box-footer clearfix">
	<?= $this->element('paginator') ?>
  </div>
</div>