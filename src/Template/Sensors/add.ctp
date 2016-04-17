<div class="box">
	<div class="box-header">
		<h3 class="box-title">Nueva Sensor</h3>
	</div>
  <?= $this->Form->create($sensor) ?>
	<div class="box-body">
	  <fieldset>
      <?php
        echo $this->Form->input('code', ['label' => 'Código']);
        echo $this->Form->input('sensor_type_id', [
        	'options' => $sensorTypes, 
        	'label' => 'Tipo de Sensor'
        ]);
        echo $this->Form->input('door_id', [
        	'options' => $doors, 
        	'label' => 'Puerta
        ']);
        echo $this->Form->input('company_id', [
        	'options' => $companies, 
        	'label' => 'Empresa'
        ]);
      ?>
	  </fieldset>
	</div>
	<div class="box-footer">
	  <?= $this->Form->button(__('Guardar')) ?>
	</div>
	<?= $this->Form->end() ?>
</div>
