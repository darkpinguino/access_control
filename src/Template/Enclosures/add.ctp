<div class="box">
    <div class="box-header">
        <h3 class="box-title">Nuevo Recinto</h3>
    </div>
  <?= $this->Form->create($enclosure) ?>
  <div class="box-body">
      <fieldset>
        <?php
          echo $this->Form->input('name', ['label' => 'Nombre']);
          echo $this->Form->input('location', ['label' => 'Ubicación']);
          echo $this->Form->input('description', ['label' => 'Descripción']);
        ?>
      </fieldset>
  </div>
  <div class="box-footer">
    <?= $this->Form->button(__('Guardar')) ?>
  </div>
  <?= $this->Form->end() ?>
</div>