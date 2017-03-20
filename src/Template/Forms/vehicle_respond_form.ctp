<?= $this->Html->script('form/vehicleRespondForm', ['block' => 'scriptView']); ?>

<div class="box">
  <div class="box-header">
      <h3 class="box-title">Seleccione Formulario</h3>
  </div>
  <div class="box-body">
		<?= $this->Form->input('forms', 
				[
					'options' => $forms, 
					'label' => 'Formularios'
			  ]);?>

		<div id="form-container"></div>
  	
  </div>
  <div class="box-footer"></div>


