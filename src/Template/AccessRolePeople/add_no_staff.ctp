<div class="box">
		<div class="box-header">
				<h3 class="box-title">Editar Rol de acceso para 
					<?= $person->name?></h3>
		</div>
	<?= $this->Form->create($accessRolePerson) ?>
	<div class="box-body">
			<fieldset>
				<?php
					echo $this->Form->input('access_role_id', [
						'option' => 'accessRoles',
						'label' => 'Rol de acceso'
					]);
				?>
			</fieldset>
	</div>
	<div class="box-footer">
			<?= $this->Form->button(__('Guardar')) ?>
	</div>
	<?= $this->Form->end() ?>
</div>