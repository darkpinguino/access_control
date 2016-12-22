<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Vehículos'])?>
  <div class="box-body">
    <table class="table">
      <thead>
        <tr>
          <?php if ($userRole_id == 1): ?>
            <th><?= $this->Paginator->sort('id', 'ID') ?></th>
          <?php endif ?>
          <th><?= $this->Paginator->sort('number_plate', 'Patente') ?></th>
          <th><?= $this->Paginator->sort('type', 'Tipo') ?></th>
          <?php if ($userRole_id == 2): ?>
            <th><?= $this->Paginator->sort('vehicle_profile.name', 'Prerfil')?></th>
          <?php endif; ?>
          <th><?= $this->Paginator->sort('created', 'Agregado') ?></th>
          <th><?= $this->Paginator->sort('modified', 'Modificado') ?></th>
          <th class="actions"><?= __('Acciones') ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($vehicles as $vehicle): ?>
        <tr>
          <?php if ($userRole_id == 1): ?>
            <td><?= $this->Number->format($vehicle->id) ?></td>
          <?php endif ?>
          <td><?= h($vehicle->number_plate) ?></td>
          <td><?= h($vehicle->vehicle_type->type) ?></td>
          <?php if ($userRole_id == 2): ?>
            <td><?= h($vehicle->company_vehicles[0]->vehicle_profile->name)?></td>
          <?php endif; ?>
          <td><?= h($vehicle->created) ?></td>
          <td><?= h($vehicle->modified) ?></td>

          <td>
            <?php if ($userRole_id == 1): ?>
              <?= $this->Html->link(__('Ver'), 
                ['action' => 'view', $vehicle->id], 
                ['class' => 'btn btn-primary btn-xs']) 
              ?>
              <?= $this->Html->link(__('Editar'), 
                ['action' => 'edit', $vehicle->id], 
                ['class' => 'btn btn-success btn-xs']) 
              ?>
              <?= $this->Form->postLink(__('Eliminar'), 
                ['action' => 'delete', $vehicle->id], 
                [
                  'confirm' => __('Are you sure you want to delete # {0}?', $vehicle->id), 
                  'class' => 'btn btn-danger btn-xs'
                ]) 
              ?>
              <?= $this->Html->link(__('Editar autorización'), 
                ['action' => 'addAuthorization', 'controller' => 'vehicleAuthorizations', $vehicle->id], 
                ['class' => 'btn btn-success btn-xs']) 
              ?>
            <?php else: ?>
              <?= $this->Html->link(__('Ver'), 
                ['action' => 'view', $vehicle->id], 
                ['class' => 'btn btn-primary btn-xs']) 
              ?>
              <?= $this->Html->link(__('Editar'), 
                ['action' => 'edit', $vehicle->id], 
                ['class' => 'btn btn-success btn-xs']) 
              ?>
              <?= $this->Form->postLink(__('Eliminar'), 
                [
                  'controller' => 'CompanyVehicles',
                  'action' => 'delete', 
                  $vehicle->company_vehicles[0]->id], 
                [
                  'confirm' => __('Are you sure you want to delete # {0}?', $vehicle->id), 
                  'class' => 'btn btn-danger btn-xs'
                ]) 
              ?>
              <?= $this->Html->link(__('Editar autorización'), 
                ['action' => 'addAuthorization', 'controller' => 'vehicleAuthorizations', $vehicle->id], 
                ['class' => 'btn btn-success btn-xs']) 
              ?>
            <?php endif ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div class="box-footer">
  	<?= $this->element('paginator') ?>
  </div>
</div>
