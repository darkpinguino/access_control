
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
              <td><?= $this->Number->format($form->id) ?></td>
              <td><?= h($form->name) ?></td>
              <td><?= $form->has('company') ? $this->Html->link($form->company->name, ['controller' => 'Companies', 'action' => 'view', $form->company->id]) : '' ?></td>
              <td><?= h($form->created) ?></td>
              
              <td>
                  <?= $this->Html->link(__('Ver'), 
                    ['action' => 'view', $form->id], 
                    ['class' => 'btn btn-primary btn-xs']) 
                  ?>
                  <?= $this->Html->link(__('Editar'), 
                    ['action' => 'edit', $form->id], 
                    ['class' => 'btn btn-warning btn-xs']) 
                  ?>
                  <?php 
                  echo $this->Html->link(__('Eliminar'), 
                      '#', 
                    [
                         'class'=>'btn btn-danger btn-xs btn-confirm',
                         'data-toggle'=> 'modal',
                         'data-target' => '#myModalDelete2',
                         'data-action'=> $form->id,
                         'data-displayField' => $form->name,
                         'escape' => false], 
                  false);
                  ?>
                  <?= $this->Html->link(__('Responder'), 
                    ['action' => 'respondForm', $form->id], 
                    ['class' => 'btn btn-success btn-xs']) 
                  ?>
              </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
      </table>
  </div>
  <div class="box-footer clearfix">
    <?= $this->element('paginator') ?>
  </div>
  <div class="box-footer clearfix">
    <?= $this->Html->link('Crear Formulario', ['action' => 'add'], ['class' => 'btn btn-info pull-left'])?>
  </div>
</div>

        

