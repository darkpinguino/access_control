<div class="box">       
    <div class="box-header">
        <h3 class="box-title">Editar Formulario</h3>
    </div>
    <?= $this->Form->create($form) ?>
  <div class="box-body">
    <fieldset>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('description');
            echo $this->Form->input('company_id', ['options' => $companies]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Guardar')) ?>
    <?= $this->Form->end() ?>
</div>
  </div>
</div>


