<?= $this->Html->script('people/edit.js', ['block' => 'scriptView']); ?>
<?php $status = $this->request->query('status');?>

<div class="box">
		<div class="box-header">
				<h3 class="box-title">
				<?=
					strcmp($status, 'pending') ? 'Editar Persona' : 'Completar datos Persona';
					
				?></h3>
		</div>
	<?= $this->Form->create($person) ?>
	<div class="box-body">
			<fieldset>
				<?php
					echo strcmp($status, 'pending') ? $this->Form->input('rut') : '';
					echo $this->Form->input('name', ['label' => 'Nombre']);
					echo $this->Form->input('lastname', ['label' => 'Apellido']);
					echo $this->Form->input('phone', ['label' => 'Telefono']);
					echo $this->Form->input('profile_id', ['label' => 'Perfil', 'options' => $profiles]);
					// strcmp($status, 'pending') ? '' : print('<div id="form-container"></div>');

					if (strcmp($status, 'pending') == 0) {
						echo '<div id="form-container"></div>';
					} else {
						echo $this->Form->input('is_visited', [
							'type' => 'checkbox',
							'label' => 'es visitada',
							'templates' => [
								'inputContainer' => '<div class="checkbox">{{content}}</div>'
							]
						]);
					}


					echo $this->Form->input('company_id', ['label' => 'Empresa', 'options' => $companies]);
				?>
			</fieldset>
	</div>
	<div class="box-footer">
			<?= $this->Form->button(__('Guardar')) ?>
	</div>
	<?= $this->Form->end() ?>
</div>
