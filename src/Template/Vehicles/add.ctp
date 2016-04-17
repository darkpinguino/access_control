<div class="box">
	<div class="box-header">
		<h3 class="box-title">Nueva Vehiculo</h3>
	</div>
  <?= $this->Form->create($vehicle) ?>
  <div class="box-body">
    <fieldset>
      <?php
        echo $this->Form->input('number_plate', ['label' => 'Patente']);
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
