<?= $this->Html->css('plugins/bootstrapMultiselect/bootstrap-multiselect', ['block' => 'cssView']) ?>
<?= $this->Html->script('plugins/bootstrapMultiselect/bootstrap-multiselect', ['block' => 'scriptView']) ?>
<?= $this->Html->script('vehicleAuthorization/addAuthorization', ['block' => 'scriptView'])?>

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Agregar Autorización a <?= h($vehicle->number_plate) ?></h3>
	</div>
	<div class="box-body">
		<?php 
			echo $this->Form->create();
			echo $this->Form->label('Personas');
			echo $this->Form->input('person_id',[
					'options' => $people,
					'label' => false,
					'multiple'=> 'multiple'
			]);
			
		?>
	</div>
	<div class="box-footer">
		<?= $this->Form->button('Guardar');?>
		<?= $this->Form->end() ?>
	</div>

	<?php 
		echo "<ul hidden id=\"vehicle_authorizations\" >";
		foreach ($vehicle_authorizations as $key => $value) {
			echo "<li id=\"asd_".$key."\">".$value."</li>";
		}
		echo "</ul>";
	?>
</div>