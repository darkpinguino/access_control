<?= $this->Html->css('plugins/daterangepicker/daterangepicker', ['block' => 'cssView']) ?>
<?= $this->Html->css('plugins/bootstrapMultiselect/bootstrap-multiselect', ['block' => 'cssView']) ?>
<?= $this->Html->script('plugins/moment/moment.min.js', ['block' => 'scriptView']) ?>
<?= $this->Html->script('plugins/daterangepicker/daterangepicker', ['block' => 'scriptView']) ?>
<?= $this->Html->script('plugins/bootstrapMultiselect/bootstrap-multiselect', ['block' => 'scriptView']) ?>
<?= $this->Html->script('accessRequest/report', ['block' => 'scriptView'])?>

<div class="box">
	<?= $this->element('boxHeader', ['title' => 'Reporte'])?>
	<div class="box-body">
		<?php 
			echo $this->Form->create();
			echo $this->Form->label('Rango reporte');
			echo $this->Form->input('range-report', ['label' => false, 'type' => 'date']);
			echo $this->Form->input('fullRange', [
				'type' => 'checkbox',
				'label' => 'Todo el rango',
				'templates' => [
					'inputContainer' => '<div class="checkbox">{{content}}</div>'
				]
			]);
			echo $this->Form->label('Recientos');
			echo $this->Form->input('enclosures_id', 
				[
					'options' => $enclosures, 
					'label' => false,
					'multiple'=> 'multiple'
			]);
			echo $this->Form->label('Perfiles');
			echo $this->Form->input('profile_id', 
				[
					'options' => $profiles, 
					'label' => false,
					'multiple'=> 'multiple'
			]);
			echo $this->Form->label('Personas');
			echo $this->Form->input('person_id',[
					'options' => $people,
					'label' => false,
					'multiple'=> 'multiple'
			]);
		?>
	</div>
	<div class="box-footer">
		<?= $this->Form->button("Generar Reporte", ['type' => 'submit', 'class' => 'btn btn-primary']) ?>
		<?= $this->Form->end() ?>
	</div>
</div>