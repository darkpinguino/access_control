<?= $this->Html->script('form/add', ['block'=>'scriptView'])?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Nuevo Formulario</h3>
    </div>
  <?= $this->Form->create($form) ?>
  <div class="box-body"  id="div-form">
      <fieldset>
        <?php
          echo $this->Form->input('name', ['label' => 'Nombre']);
          echo $this->Form->input('description', ['label' => 'Descripción']);
        ?>
      </fieldset>
    
    <div id=dyn-form>
    </div>

    <?php
        echo $this->Form->button('Agregar Preguntas',
            array('onclick' => "addQuestions()",'class' => 'btn btn-success pull-right', 'type' => "button")
            );   
    ?>

      
  </div>
  <div class="box-footer">
    <?= $this->Form->button(__('Guardar')) ?>
  </div>
  <?= $this->Form->end() ?>
</div>