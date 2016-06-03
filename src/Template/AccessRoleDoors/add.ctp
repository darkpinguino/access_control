<div class="box">
	<div class="box-header">
		<h3 class="box-title">Agregar Rol de Acceso</h3>
	</div>
  <?= $this->Form->create($accessRoleDoor) ?>
	<div class="box-body">
    <fieldset>
      <?php
        echo $this->Form->input('door_id', ['options' => $doors]);
        echo $this->Form->input('access_role_id', ['options' => $accessRoles]);
      ?>
    </fieldset>
	</div>
	<div class="box-footer">
    <?= $this->Form->button(__('Guardar')) ?>
	</div>
  <?= $this->Form->end() ?>
</div>
