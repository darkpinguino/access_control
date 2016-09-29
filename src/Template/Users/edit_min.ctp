<div class="box">
	<div class="box-header">
		<h3 class="box-title">Editar Usuario</h3>
	</div>
  <?= $this->Form->create($user) ?>
  <div class="box-body">
	  <fieldset>
		<?php
		  echo $this->Form->input('username', ['label' => 'Nombre de Usuario', 'disabled']);
		  echo $this->Form->input('person.name', ['label' => 'Nombre', 'disabled']);
		  echo $this->Form->input('person.lastname', ['label' => 'Apellido', 'disabled']);
			echo $this->Form->input('new_password', [
				'type' => 'password', 
				'label' => 'Contraseña',
				'placeholder' => 'Contraseña sin cambios'
			]);
			echo $this->Form->input('confirm_password', [
				'type' => 'password', 
				'label' => 'Confirme Contraseña'
			]);
		?>
	  </fieldset>
  </div>
  <div class="box-footer">
	  <?= $this->Form->button(__('Guardar')) ?>
  </div>
  <?= $this->Form->end() ?>
</div>
