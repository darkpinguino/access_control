<div class="box">
	<div class="box-header">
		<h3 class="box-title">Editar Sensor</h3>
	</div>
  <?= $this->Form->create($sensor) ?>
  <div class="box-body">
	  <fieldset>
	    <?php
	      echo $this->Form->input('code');
	      echo $this->Form->input('sensor_type_id', ['options' => $sensorTypes]);
	      echo $this->Form->input('door_id', ['options' => $doors]);
	      echo $this->Form->input('company_id', ['options' => $companies]);
	    ?>
	  </fieldset>
  </div>
  <div class="box-footer">
  	<?= $this->Form->button(__('Guardar')) ?>
  </div>
  <?= $this->Form->end() ?>
</div>
