<div class="box">       
    <div class="box-header">
        <h3 class="box-title">Editar Medida</h3>
    </div>
    <?= $this->Form->create($measure) ?>
  <div class="box-body">
    <fieldset>
        <?php
            echo $this->Form->control('measure');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Guardar')) ?>
    <?= $this->Form->end() ?>
</div>
  </div>
</div>
