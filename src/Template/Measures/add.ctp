<?php
/**
  * @var \App\View\AppView $this
  */
?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Nuevo Formulario</h3>
    </div>

    <?= $this->Form->create($measure) ?>
    <div class="box-body">
      <fieldset>
        <?php
            echo $this->Form->control('measure', ['label'=> 'Medida']);
        ?>
      </fieldset>
    </div>
    <div class="box-footer">
    <?= $this->Form->button(__('Guardar')) ?>
    </div>
  <?= $this->Form->end() ?>
</div>


  