<div class="box">
  <div class="box-header">
    <h3 class="box-title">Nuevo tipo de vehículo</h3>
  </div>
  <?= $this->Form->create($vehicleType) ?>
  <div class="box-body">
    <fieldset>
    <?php
      echo $this->Form->input('type', ['label' => 'tipo']);
    ?>
    </fieldset>
  </div>
  <div class="box-footer">
  <?= $this->Form->button(__('Guardar')) ?>
  </div>
  <?= $this->Form->end() ?>
</div>
