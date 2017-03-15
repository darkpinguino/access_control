<?= $this->Html->css('plugins/bootstrapMultiselect/bootstrap-multiselect', ['block' => 'cssView']) ?>
<?= $this->Html->script('plugins/bootstrapMultiselect/bootstrap-multiselect', ['block' => 'scriptView']) ?>
<?= $this->Html->script('accessRolePeople/updateRole', ['block' => 'scriptView'])?>
<?= $this->Html->script('accessRolePeople/accessRolePeople.js', ['block' => 'scriptView']); ?>

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Asignar Roles de Acceso a <?= $person->fullName ?></h3>
	</div>
	<?= $this->Form->create() ?>
	<div class="box-body">
		<fieldset>
			<?php
				echo $this->Form->label('Roles de acceso');
				echo $this->Form->input('role_id',[
						'options' => $access_roles,
						'label' => false,
						'multiple'=> 'multiple'
				]);

				echo $this->Form->label('Expira');
				echo $this->Form->input('expiration', ['label' => false, 'type' => 'date', 'class' => 'form-control']);
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


	<?php 
		echo "<ul hidden id=\"access_role_people\" >";
		foreach ($access_role_people as $key => $value) {
			echo "<li>".$key."</li>";
		}
		echo "</ul>";

		echo $this->Form->hidden('expiration_date', ['id' => 'expiration_date', 'value' => $expiration]);
	?>
</div>