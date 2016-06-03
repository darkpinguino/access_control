<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Vehiculos'])?>
  <div class="box-body">
    <table class="table">
      <thead>
        <tr>
          <th><?= $this->Paginator->sort('id', 'ID') ?></th>
          <th><?= $this->Paginator->sort('number_plate', 'Patente') ?></th>
          <th><?= $this->Paginator->sort('company_id', 'Empresa') ?></th>
          <th><?= $this->Paginator->sort('created', 'Agregado') ?></th>
          <th><?= $this->Paginator->sort('modified', 'Modificado') ?></th>
          <th class="actions"><?= __('Acciones') ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($vehicles as $vehicle): ?>
        <tr>
          <td><?= $this->Number->format($vehicle->id) ?></td>
          <td><?= h($vehicle->number_plate) ?></td>
          <td><?= $vehicle->has('company') ? $this->Html->link($vehicle->company->name, ['controller' => 'Companies', 'action' => 'view', $vehicle->company->id]) : '' ?></td>
          <td><?= h($vehicle->created) ?></td>
          <td><?= h($vehicle->modified) ?></td>
          <?= $this->element('action', ['entityId' => $vehicle->id])?>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div class="box-footer">
  	<?= $this->element('paginator') ?>
  </div>
</div>
