<?= $this->Html->css('plugins/bootstrapMultiselect/bootstrap-multiselect', ['block' => 'cssView']) ?>
<?= $this->Html->script('plugins/bootstrapMultiselect/bootstrap-multiselect', ['block' => 'scriptView']) ?>
<?= $this->Html->script('accessRolePeople/accessRolePeople.js', ['block' => 'scriptView']); ?>

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Asignar Rol de Acceso</h3>
	</div>
	<?= $this->Form->create($accessRolePerson) ?>
	<div class="box-body">
		<fieldset>
			<?php

				echo $this->Form->label('Persona');
				echo $this->Form->input('people_id',[
						'options' => $people,
						'label' => false,
						'size' => 2
				]);

				echo $this->Form->label('Rol de acceso');
				echo $this->Form->input('access_role_id',[
						'options' => $accessRoles,
						'label' => false,
						'size' => 2
				]);

				echo $this->Form->label('Expira');
				echo $this->Form->input('expiration', ['label' => false, 'type' => 'date']);
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