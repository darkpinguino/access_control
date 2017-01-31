<?= $this->Html->script('people/edit', ['block' => 'scriptView']); ?>


<?php 
	$status = $this->request->query('status');
	$driver = $this->request->query('driver');
	$access_request_id = $this->request->query('access_request');
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

					echo $this->Form->label('contractor_company_id', 'Empresa contratista', [
						'id' => 'contractor-company-id-label',
						'style' => 'display:none;'
					]);

					echo $this->element('People/contractor_company', ['contractor_companies' => $contractor_companies]); 

					echo $this->Form->label('work_area_id', 'Área de trabajo', [
						'id' => 'work-area-id-label',
						'style' => 'display:none;'
					]);

					echo $this->element('People/work_area', ['work_areas' => $work_areas]); 

					// strcmp($status, 'pending') ? '' : print('<div id="form-container"></div>');

					if (strcmp($status, 'pending') == 0) {
						echo '<div id="form-container"></div>';
						echo $this->Form->hidden('access_request_id', ['id' => 'access_request_id',
							'value' => $access_request_id]);
						echo $this->Form->hidden('status', ['value' => 'pending']);
					} else {
						echo $this->Form->input('is_visited', [
							'type' => 'checkbox',
							'label' => 'Visitada',
							'templates' => [
								'inputContainer' => '<div class="checkbox">{{content}}</div>'
							]
						]);
					}

					echo $this->Form->hidden('person_contractor_company', ['id' => 'person_contractor_company', 'value' => $person->company_people[0]->contractor_company_id]);

					echo $this->Form->hidden('person_work_area', ['id' => 'person_work_area', 'value' => $person->company_people[0]->work_area_id]);
				?>
			</fieldset>
	</div>
	<div class="box-footer">
		<?= $this->Form->button('Guardar') ?>
	</div>
	<?= $this->Form->end() ?>
</div>
