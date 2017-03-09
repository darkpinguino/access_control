<div class="box">
  <?= $this->element('tableHeader', ['title' => 'Empresas'])?>
  <div class="box-body">
    <table id="companiesTable" class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
            <th><?= $this->Paginator->sort('id', 'ID') ?></th>
            <th><?= $this->Paginator->sort('name', 'Nombre') ?></th>
            <th><?= $this->Paginator->sort('email', 'Correo') ?></th>
            <th><?= $this->Paginator->sort('phone', 'Telefono') ?></th>
            <th><?= $this->Paginator->sort('address', 'Direción') ?></th>
            <th><?= $this->Paginator->sort('contact', 'Contacto') ?></th>
            <th><?= $this->Paginator->sort('created', 'Agregada') ?></th>
            <th><?= __('Acciones') ?></th>
        </tr>
      </thead>
      <tbody>
          <?php foreach ($companies as $company): ?>
          <tr>
            <td><?= $this->Number->format($company->id) ?></td>
            <td><?= h($company->name) ?></td>
            <td><?= h($company->email) ?></td>
            <td><?= h($company->phone) ?></td>
            <td><?= h($company->address) ?></td>
            <td><?= h($company->contact) ?></td>
            <td><?= h($company->created) ?></td>
            <?= $this->element('action', ['entityId' => $company->id, 'displayField' => $company->{$displayField}])?>
          </tr>
          <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div class="box-footer clearfix">
  	<?= $this->element('paginator') ?>
  </div>
  <div class="box-footer clearfix">
    <?= $this->Html->link('Crear Nueva Empresa', ['action' => 'add'], ['class' => 'btn btn-info pull-left'])?>
  </div>
</div>
