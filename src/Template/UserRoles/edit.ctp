<div class="box">
	<div class="box-header">
		<h3 class="box-title">Editar Rol</h3>
	</div>
  <?= $this->Form->create($userRole) ?>
  <div class="box-body">
	  <fieldset>
		<?php
		  echo $this->Form->input('role');
		  echo $this->Form->input('description', ['label' => 'Descripción']);
		?>
	  </fieldset>
  </div>
  <div class="box-footer">
	  <?= $this->Form->button(__('Guardar')) ?>
  </div>
  <?= $this->Form->end() ?>
</div>