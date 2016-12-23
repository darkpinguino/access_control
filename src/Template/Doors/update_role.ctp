<?= $this->Html->css('plugins/bootstrapMultiselect/bootstrap-multiselect', ['block' => 'cssView']) ?>
<?= $this->Html->script('plugins/bootstrapMultiselect/bootstrap-multiselect', ['block' => 'scriptView']) ?>
<?= $this->Html->script('accessRoleDoors/updateRole', ['block' => 'scriptView'])?>

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Agregar rol a la puerta: <?= h($door->name) ?></h3>
	</div>
	<div class="box-body">
		<?php 
			echo $this->Form->create();
			echo $this->Form->label('Roles');
			echo $this->Form->input('role_id',[
					'options' => $role,
					'label' => false,
					'multiple'=> 'multiple'
			]);
			
		?>
	</div>
	<div class="box-footer">
		<?= $this->Form->button('Guardar');?>
		<?= $this->Form->end() ?>
	</div>

	<?php 
		echo "<ul hidden id=\"access_role_doors\" >";
		foreach ($access_role_doors as $key => $value) {
			echo "<li>".$key."</li>";
		}
		echo "</ul>";
	?>
</div>