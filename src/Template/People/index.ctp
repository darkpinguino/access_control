<?= $this->Html->script('people/index.js', ['block' => 'scriptView']); ?>


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
          <?php if ($userRole_id == 2): ?>
            <th><?= $this->Paginator->sort('CompanyPeople[0].Profiles.id', 'Perfil')?></th>
          <?php endif ?>
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
          <?php if ($userRole_id == 2): ?>
            <td><?= $this->element('action_profile', ['profileID' => $person->company_people[0]->profile->id])?></td>
          <?php endif ?>
          <td><?= h($person->created) ?></td>
          


          <td nowrap class="actions">
            <?= $this->Html->link(__('Ver'), 
              ['action' => 'view', $person->id], 
              ['class' => 'btn btn-primary btn-xs']) 
            ?>
            <?= $this->Html->link(__('Editar'), 
              ['action' => 'edit', $person->id], 
              ['class' => 'btn btn-warning btn-xs']) 
            ?>
            <?php if ($userRole_id == 1): ?>
              <?= $this->Form->postLink(__('Eliminar'), 
                ['action' => 'delete', $person->id], 
                [
                  'confirm' => __('Are you sure you want to delete # {0}?', $person->id), 
                  'class' => 'btn btn-danger btn-xs'
                ]) 
              ?>
            <?php else: ?>
              <?= $this->Form->postLink(__('Eliminar'), 
                [
                  'controller' => 'CompanyPeople',
                  'action' => 'delete', 
                  $person->company_people[0]->id], 
                [
                  'confirm' => __('Are you sure you want to delete # {0}?', $person->id), 
                  'class' => 'btn btn-danger btn-xs'
                ]) 
              ?>
            <?php endif; ?>
            <?= $this->Html->link(__('Editar roles'), 
              ['action' => 'updateRole', $person->id], 
              ['class' => 'btn btn-success btn-xs']) 
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
