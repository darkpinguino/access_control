<?= $this->Html->css('plugins/bootstrapMultiselect/bootstrap-multiselect', ['block' => 'cssView']) ?>
<?= $this->Html->script('plugins/bootstrapMultiselect/bootstrap-multiselect', ['block' => 'scriptView']) ?>
<?= $this->Html->script('accessRolePeople/addNoStaff', ['block' => 'scriptView']); ?>

<div class="box">
		<div class="box-header">
				<h3 class="box-title">Editar Rol de acceso para 
					<?= $person->name?></h3>
		</div>
	<?= $this->Form->create($accessRolePerson) ?>
	<div class="box-body">
			<fieldset>
				<?php

					echo $this->Form->label('Roles de acceso');
					echo $this->Form->input('role_id',[
							'options' => $role,
							'label' => false,
							'multiple'=> 'multiple'
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
	?>
</div>