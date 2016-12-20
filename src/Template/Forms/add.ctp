<div class="box">
    <div class="box-header">
        <h3 class="box-title">Nuevo Formulario</h3>
    </div>
  <?= $this->Form->create($form) ?>
  <div class="box-body">
      <fieldset>
        <?php
          echo $this->Form->input('name', ['label' => 'Nombre']);
          echo $this->Form->input('description', ['label' => 'Descripción']);
        ?>
      </fieldset>
  </div>
  <div class="box-footer">
    <?= $this->Form->button(__('Guardar')) ?>
  </div>
  <?= $this->Form->end() ?>
</div>