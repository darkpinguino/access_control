<?= $this->Html->css('plugins/bootstrapMultiselect/bootstrap-multiselect', ['block' => 'cssView']) ?>
<?= $this->Html->script('plugins/bootstrapMultiselect/bootstrap-multiselect', ['block' => 'scriptView']) ?>
<?= $this->Html->script('accessRolePeople/addNoStaff', ['block' => 'scriptView']); ?>

<div class="box">
		<div class="box-header">
				<h3 class="box-title">Editar Rol de acceso para 
					<?= $person->fullName?></h3>
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

					if ($recurring_person) {
						echo '</br><h4 class="box-title">Visita recurrente, ¿Ampliar vigencia del rol de acceso?</h4>';
						echo $this->Form->label('Expira');
						echo $this->Form->input('expiration', ['label' => false, 'type' => 'date', 'class' => 'form-control']);

						echo $this->Form->input('notExpire', [
							'type' => 'checkbox',
							'label' => 'no expira',
							'templates' => [
								'inputContainer' => '<div class="checkbox">{{content}}</div>'
							]
						]);

						echo $this->Form->hidden('expiration_date', ['id' => 'expiration_date', 'value' => $accessRolePerson->expiration->format('Y-m-d')]);
						echo $this->Form->hidden('recurring_person', ['value' => $recurring_person]);
					} else {
						echo $this->Form->hidden('expiration', ['value' => $accessRolePerson->expiration->format('d/m/Y')]);
						echo $this->Form->hidden('notExpire', ['value' => 0]);
					}
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