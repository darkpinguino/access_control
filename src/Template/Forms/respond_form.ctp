<div class="box">
    <div class="box-header">
        <h3 class="box-title">Responder Formulario</h3>
    </div>
  <?= $this->Form->create($question_answer) ?>
  <div class="box-body"  id="div-form">
      <fieldset>
        <?php foreach ($form->questions as $question): ?>
          <?php switch($question->type): 
          case 1: ?>
              <?= $this->Form->control('Pregunta', ['label' => $question->question_text])?>
          <?php break; ?>
          <?php endswitch; ?>
        <?php endforeach; ?>
        
      </fieldset>
  
      
  </div>

  <div class="box-footer">
    <?= $this->Form->button(__('Guardar')) ?>
  </div>
  <?= $this->Form->end() ?>
</div>