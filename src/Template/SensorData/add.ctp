<div class="box">
	<div class="box-header">
		<h3 class="box-title">Nuevo Dato</h3>
	</div>
    <?= $this->Form->create($sensorData) ?>
  <div class="box-body">
    <fieldset>
      <?php
        echo $this->Form->input('sensor_type_id', [
            'options' => $sensorTypes, 
            'label' => 'Tipo de Sensor'
          ]);
        echo $this->Form->input('people_id', [
          'options' => $people, 
          'label' => 'Persona']
        );
        echo $this->Form->input('data', ['label' => 'Dato']);
        echo $this->Form->input('company_id', [
          'options' => $companies, 
          'label' => 'Empresa']
        );
      ?>
    </fieldset>
  </div>
  <div class="box-footer">
    <?= $this->Form->button(__('Guardar')) ?>
  </div>
    <?= $this->Form->end() ?>
</div>
