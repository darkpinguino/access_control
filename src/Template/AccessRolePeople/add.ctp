<?= $this->Html->script('accessRolePeople/accessRolePeople.js', ['block' => 'scriptView']); ?>

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Asignar Rol de Acceso</h3>
	</div>
	<?= $this->Form->create($accessRolePerson) ?>
	<div class="box-body">
		<fieldset>
			<?php
				echo $this->Form->input('people_id', [
					'label' => 'Persona', 
					'option' => 'people', 
					'class' => 'select2-selection select2-selection--single'
				]);
				echo $this->Form->input('access_role_id', ['label' => 'Rol de acceso', 'option' => 'accessRoles']);
				echo $this->Form->label('Expira');
				echo $this->Form->input('expiration', ['label' => false, 'type' => 'date', 'class' => 'form-control', 'name' => 'asdads']);
				echo $this->Form->input('notExpire', [
					'type' => 'checkbox',
					'label' => 'no expira',
					'templates' => [
						'inputContainer' => '<div class="checkbox">{{content}}</div>'
					]
				]);
			?>
		</fieldset>
	</div>
	<div class="box-footer">
		<?= $this->Form->button(__('Guardar')) ?>
	</div>
	<?= $this->Form->end() ?>
</div>