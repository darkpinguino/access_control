<div class="box">
	<div class="box-header">
		<h3 class="box-title">Editar Datos del sensor</h3>
	</div>
    <?= $this->Form->create($sensorData) ?>
    <div class="box-body">
	    <fieldset>
        <?php
          echo $this->Form->input('sensor_type_id', ['options' => $sensorTypes]);
          echo $this->Form->input('people_id', ['options' => $people]);
          echo $this->Form->input('data');
          echo $this->Form->input('company_id', ['options' => $companies]);
        ?>
	    </fieldset>
    </div>
    <div class="box-footer">
	    <?= $this->Form->button(__('Guardar')) ?>
    </div>
    <?= $this->Form->end() ?>
</div>
