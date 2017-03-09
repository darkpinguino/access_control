<div class="box">
    <div class="box-header">
        <h3 class="box-title">Ver Formulario Respondido</h3>
    </div>
  <?= $this->Form->create($answer_set) ?>
  <div class="box-body"  id="div-form">

  </div>

  <div class="box-footer">
    <?= $this->Form->button(__('Guardar')) ?>
  </div>
  <?= $this->Form->end() ?>
</div>