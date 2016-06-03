<div class="box">
	<div class="box-header">
		<h3 class="box-title">Nueva Peticion de Acceso</h3>
	</div>
  <?= $this->Form->create($accessRequest) ?>
  <div class="box-body">
    <fieldset>
      <?php
        echo $this->Form->input('people_id', ['options' => $people, 'label' => 'Persona']);
        echo $this->Form->input('door_id', ['options' => $doors, 'label' => 'Puerta']);
        echo $this->Form->input('access_status_id',['options' => $accessStatus, 'label' => 'Estado de Acceso']);
      ?>
    </fieldset>
  </div>
  <div class="box-footer">
    <?= $this->Form->button(__('Guardar')) ?>
  </div>
  <?= $this->Form->end() ?>
</div>
