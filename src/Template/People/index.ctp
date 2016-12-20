<div class="box">
  <?= $this->element('tableHeader', ['title' => 'Personas'])?>
  <div class="box-body">
	  <table class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <?php if ($userRole_id == 1): ?>
            <th><?= $this->Paginator->sort('id', 'ID') ?></th>
          <?php endif ?>
          <th><?= $this->Paginator->sort('rut', 'Rut') ?></th>
          <th><?= $this->Paginator->sort('name', 'Nombre') ?></th>
          <th><?= $this->Paginator->sort('lastname', 'Apellido') ?></th>
          <th><?= $this->Paginator->sort('phone', 'Telefono') ?></th>
          <th><?= $this->Paginator->sort('created', 'Agregada') ?></th>
          <th><?= __('Acciones') ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($people as $person): ?>
        <tr>
          <?php if ($userRole_id == 1): ?>
            <td><?= h($person->id) ?></td>
          <?php endif ?>
          <td><?= h($person->rut) ?></td>
          <td><?= h($person->name) ?></td>
          <td><?= h($person->lastname) ?></td>
          <td><?= h($person->phone) ?></td>
          <td><?= h($person->created) ?></td>
          <?= $this->element('action', ['entityId' => $person->id])?>
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
