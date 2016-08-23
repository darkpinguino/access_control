<div class="box">
	<div class="box-header">
		<h3 class="box-title">Nuevo Usuario</h3>
	</div>
	<?= $this->Form->create($user) ?>
	<div class="box-body">
		<fieldset>
		<?php
			echo $this->Form->input('username', ['label' => 'Nombre de Usuario']);
			echo $this->Form->input('password', ['label' => 'Contraseña']);
			echo $this->Form->input('userRole_id', ['label' => 'Rol', 'options' => $userRoles]);
			echo $this->Form->input('doorCharge_id', ['label' => 'Puerta a cargo','options' => $doors]);
			echo $this->Form->input('person_id', ['options' => $people]);
			echo $this->Form->input('company_id', 
		[
			'options' => $companies, 
			'label' => 'Empresa'
	  ]);
		?>
		</fieldset>
	</div>
	<div class="box-footer">
	<?= $this->Form->button(__('Guardar')) ?>
	</div>
	<?= $this->Form->end() ?>
</div>