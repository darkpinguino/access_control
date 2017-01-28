<div class="box">
	<div class="box-header">
		<h3 class="box-title">Nueva Empresa Contratista</h3>
	</div>
	<?= $this->Form->create($contractorCompany) ?>
	<div class="box-body">
		<fieldset>
			<?php
				echo $this->Form->input('name', ['label' => 'Nombre']);
				
				if ($userRole_id == 1) {
					echo $this->Form->input('company_id', 
					[
						'options' => $companies, 
						'label' => 'Empresa'
				  ]);
				}
			?>
		</fieldset>
	</div>
	<div class="box-footer">
		<?= $this->Form->button(__('Guardar')) ?>
	</div>
	<?= $this->Form->end() ?>
</div>