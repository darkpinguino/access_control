<div class="box">
		<div class="box-header">
				<h3 class="box-title">Editar Recinto</h3>
		</div>
	<?= $this->Form->create($enclosure) ?>
	<div class="box-body">
			<fieldset>
				<?php
					echo $this->Form->input('name');
					echo $this->Form->input('location');
					echo $this->Form->input('description');
				?>
			</fieldset>
	</div>
	<div class="box-footer">
			<?= $this->Form->button(__('Guardar')) ?>
	</div>
	<?= $this->Form->end() ?>
</div>
