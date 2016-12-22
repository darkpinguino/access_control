<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Roles de Acceso'])?>
  <div class="box-body">
    <table class="table">
      <thead>
        <tr>
          <?php if ($userRole_id == 1): ?>
            <th><?= $this->Paginator->sort('id', 'ID') ?></th>
          <?php endif ?>
          <th><?= $this->Paginator->sort('name', 'Nombre') ?></th>
          
          <?php if ($userRole_id == 1): ?>
            <th><?= $this->Paginator->sort('company_id', 'Empresa') ?></th>
          <?php endif; ?>
          <th><?= $this->Paginator->sort('created', 'Agregado') ?></th>
          <th><?= $this->Paginator->sort('modified', 'Modificado') ?></th>
          <th class="actions"><?= __('Acciones') ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($accessRoles as $accessRole): ?>
        <tr>
          <?php if ($userRole_id == 1): ?>
            <td><?= $this->Number->format($accessRole->id) ?></td>
          <?php endif ?>
          <td><?= h($accessRole->name) ?></td>
          <?php if ($userRole_id == 1): ?>
            <td><?= $accessRole->has('company') ? $this->Html->link($accessRole->company->name, ['controller' => 'Companies', 'action' => 'view', $accessRole->company->id]) : '' ?></td>
          <?php endif; ?>
          <td><?= h($accessRole->created) ?></td>
          <td><?= h($accessRole->modified) ?></td>
          <?= $this->element('action', ['entityId' => $accessRole->id])?>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div class="box-footer">
  	<?= $this->element('paginator') ?>
  </div>
</div>
