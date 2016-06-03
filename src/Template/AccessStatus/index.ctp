<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Esatdos de Accesos'])?>
  <div class="box-body">
    <table class="table">
      <thead>
        <tr>
          <th><?= $this->Paginator->sort('id', 'ID') ?></th>
          <th><?= $this->Paginator->sort('status', 'Estado') ?></th>
          <th><?= $this->Paginator->sort('created', 'Creado') ?></th>
          <th><?= $this->Paginator->sort('modified', 'Modificado') ?></th>
          <th class="actions"><?= __('Acciones') ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($accessStatus as $accessStatus): ?>
        <tr>
          <td><?= $this->Number->format($accessStatus->id) ?></td>
          <td><?= h($accessStatus->status) ?></td>
          <td><?= h($accessStatus->created) ?></td>
          <td><?= h($accessStatus->modified) ?></td>
          <?= $this->element('action', ['entityId' => $accessStatus->id])?>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div class="box-footer">
  	<?= $this->element('paginator') ?>
  </div>
</div>
