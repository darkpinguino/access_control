
<?php 
	$status = $this->request->query('status');
	$driver = $this->request->query('driver');
?>

<div class="box">
		<div class="box-header">
				<h3 class="box-title">
				<?php 
					if (strcmp($status, 'pending') == 0) {
						if (strcmp($driver, 'driver') == 0) {
							$title = 'Completar datos Conductor';
						} elseif (strcmp($driver, 'passanger') == 0) {
							$title = 'Completar datos Pasajero';
						} else {
							$title = 'Completar datos Persona';
						}
					} else {
						$title = 'Editar Persona';
					}

					echo $title;
				?>
				</h3>
		</div>
	<?= $this->Form->create($person) ?>
	<div class="box-body">
			<fieldset>
				<?php
					if (strcmp($status, 'pending') or strcmp($driver, 'driver')) {
						echo $this->Form->input('rut', ['disabled']);
					}
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
				?>
			</fieldset>
	</div>
	<div class="box-footer">
		<?= $this->Form->button('Guardar') ?>
	</div>
	<?= $this->Form->end() ?>
</div>
