<?= $this->Html->script('people/add.js', ['block' => 'scriptView']); ?>

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Agregar Persona</h3>
	</div>
	<?= $this->Form->create($person) ?>
	<div class="box-body">
		<fieldset>
			<?php
				echo $this->Form->input('rut', ['label' => 'Rut']);
				echo $this->Form->input('name', ['label' => 'Nombre']);
				echo $this->Form->input('lastname', ['label' => 'Apellido']);
				echo $this->Form->input('phone', ['label' => 'Telefono']);
				echo $this->Form->input('profile_id', 
					[
						'options' => $profiles, 
						'label' => 'Perfil'
				]);
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
				
				echo $this->Form->input('is_visited', [
					'type' => 'checkbox',
					'label' => '¿Es visitada?',
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
