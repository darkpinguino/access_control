<?= $this->Html->css('plugins/bootstrapMultiselect/bootstrap-multiselect', ['block' => 'cssView']) ?>
<?= $this->Html->script('plugins/bootstrapMultiselect/bootstrap-multiselect', ['block' => 'scriptView']) ?>
<?= $this->Html->script('enclosures/updateDoors', ['block' => 'scriptView'])?>

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Agregar puertas al recinto: <?= h($enclosure->name) ?></h3>
	</div>
	<div class="box-body">
		<?php 
			echo $this->Form->create();
			echo $this->Form->label('Puertas');
			echo $this->Form->input('doors_id',[
					'options' => $doors,
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
		echo "<ul hidden id=\"enclosure_doors\" >";
		foreach ($enclosure_doors as $key => $value) {
			echo "<li>".$key."</li>";
		}
		echo "</ul>";
	?>
</div>