<div class="box">
	<div class="box-header">
		<h3 class="box-title">Agregar Puerta <?= h($enclosure->name) ?></h3>
	</div>
	<div class="box-body">
		<table class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <th><?= $this->Paginator->sort('id', 'ID') ?></th>
          <th><?= $this->Paginator->sort('name', 'Nombre') ?></th>
          <th><?= $this->Paginator->sort('location', 'Ubicación') ?></th>
          <th><?= __('Acciones') ?></th>
        </tr>
      </thead>
      <tbody>
      	<?php foreach ($doors as $door): ?>
      		<tr>
	          <td><?= h($door->id) ?></td>
	          <td><?= h($door->name) ?></td>
	          <td><?= h($door->location) ?></td>
	          <td><?php
	          	if ($door->enclosure_id == $enclosure->id) { 
			          echo $this->Html->link(__('Quitar'), [
			          	'action' => 'deleteEnclosure', 
			          	'controller' => 'doors',
			            $door->id, 
			            '?' => ['enclosure' => $enclosure->id]
			          ],
			          ['class' => 'btn btn-danger btn-xs']);
	          	} else {
	          		echo $this->Html->link(__('Agregar'), [
	          			'action' => 'addEnclosure', 
	          			'controller' => 'doors',
	          			$door->id,
	          			'?' => ['enclosure' => $enclosure->id]
	          		], 
                ['class' => 'btn btn-success btn-xs']);
	          	}
	          ?></td>
          </tr>
        </tr>
      	<?php endforeach; ?>	
      </tbody>
    </table>
	</div>
</div>