<div class="box">
	<div class="box-header">
		<h3 class="box-title">Nueva Empresa</h3>
	</div>
	<?= $this->Form->create($company) ?>
	<div class="box-body">
		<fieldset>
			<?php
				echo $this->Form->input('name', ['label' => 'Nombre']);
				echo $this->Form->input('email', ['label' => 'Email']);
				echo $this->Form->input('phone', ['label' => 'Telefono']);
				echo $this->Form->input('address', ['label' => 'Dirección']);
				echo $this->Form->input('contact', ['label' => 'Contacto']);
				echo $this->Form->input('description', ['label' => 'Descripción']);
			?>
		</fieldset>
	</div>
	<div class="box-footer">
		<?= $this->Form->button(__('Guardar')) ?>
	</div>
	<?= $this->Form->end() ?>
</div>
