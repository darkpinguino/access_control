
<div class="box">
  <?= $this->element('tableHeader', ['title' => 'Formularios'])?>
  <div class="box-body">
      <table class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <th><?= $this->Paginator->sort('id', 'ID') ?></th>
          <th><?= $this->Paginator->sort('name', 'Nombre') ?></th>
          <th><?= $this->Paginator->sort('company_id', 'Compañia') ?></th>
          <th><?= $this->Paginator->sort('created', 'Creado') ?></th>
          <th><?= __('Acciones') ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($forms as $form): ?>
        <tr>
          <td><?= h($form->id) ?></td>
          <td><?= h($form->name) ?></td>
          <td><?= $form->has('company') ? $this->Html->link($form->company->name, ['controller' => 'Companies', 'action' => 'view', $form->company->id]) : '' ?></td>
          <td><?= h($form->created) ?></td>
          <?= $this->element('action', ['entityId' => $form->id])?>       
        </tr>
        <?php endforeach; ?>
      </tbody>
      </table>
  </div>
  <div class="box-footer clearfix">
    <?= $this->element('paginator') ?>
  </div>
</div>




<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Form'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
    </ul>
</nav>
