<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Peticiones de accesos pendientes'])?>
	<div class="box-body">
    <table class="table">
      <thead>
        <tr>
          <th><?= $this->Paginator->sort('id', 'ID') ?></th>
          <th><?= $this->Paginator->sort('People.rut', 'Rut') ?></th>
          <th><?= $this->Paginator->sort('People.name', 'Nombre') ?></th>
          <th><?= $this->Paginator->sort('People.lastname', 'Apellido') ?></th>
          <th><?= $this->Paginator->sort('door_id', 'Puerta') ?></th>
          <th><?= $this->Paginator->sort('created', 'Agregado') ?></th>
          <th><?= $this->Paginator->sort('modified', 'Modificado') ?></th>
          <th><?= __('Acciones') ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($accessRequest as $access_request): ?>
        <tr>
          <td><?= h($access_request->id) ?></td>
          <td><?= $access_request->has('person') ? $this->Html->link($access_request->person->rut, ['controller' => 'People', 'action' => 'view', $access_request->person->id]) : '' ?>
          </td>
          <td><?= $access_request->has('person') ? h($access_request->person->name) : '' ?></td>
          <td><?= $access_request->has('person') ? h($access_request->person->lastname) : '' ?></td>
          <td><?= $access_request->has('door') ? $this->Html->link($access_request->door->name, ['controller' => 'Doors', 'action' => 'view', $access_request->door->id]) : '' ?></td>
          <td><?= h($access_request->created) ?></td>
          <td><?= h($access_request->modified) ?></td>
          <td>
            <?= $this->Html->link(__('Autorizar'), [
              'action' => 'edit', 
              'controller' => 'AccessRolePeople',
              $access_request->person->access_role_people[0]->id], 
              ['class' => 'btn btn-primary btn-xs']) 
            ?>
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
