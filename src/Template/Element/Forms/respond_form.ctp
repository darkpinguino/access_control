<div class="box">
    <div class="box-header">
        <h3 class="box-title">Responder Formulario</h3>
    </div>
  <div class="box-body"  id="div-form">
      <?= $this->Form->create($answer_set, ['url' => $url, 'id' => 'form']) ?>
      <fieldset>
        <?php $i = 0; ?>
        <?php foreach ($form->questions as $question): ?>
            <?= $this->Form->control('answers.'.$i.'.question_id', [
              'value' => $question->id , 
              'type'=> 'hidden'
            ]) ?>
          <?php switch($question->type): 
          case 1: ?>
            <?= $this->Form->control('answers.'.$i.'.answer_text', ['label'=>$question->question_text, 'placeholder' =>$question->placeholder]) ?>
            <br>
            <?php break; ?>
          <?php case 2: ?>
            <?= $this->Form->control('answers.'.$i.'.answer_text', [
              'type'=>'textarea', 'label'=>$question->question_text, 'placeholder' =>$question->placeholder]) ?>
            <br>
            <?php break; ?>
          <?php case 3: ?>
            <?= $this->Form->control('answers.'.$i.'.answer_text', [
            'type'=>'text', 
            'label'=> $question->question_text, 
            'placeholder' =>$question->placeholder]) ?>
            <br>
            <?php break; ?>
          <?php case 4: ?>
            <?= $this->Form->label($question->question_text) ?>
            <?= $this->Form->control('answers.'.$i.'.answer_text', [
              'label' => false,
              'type'=>'date', 
              'placeholder' =>$question->placeholder,
              'class'=>['answer-date','form-control'],
              'answer-index'=>$i
            ]) ?>
            <br>
            <?php break; ?>
          <?php case 5: ?>
            <?= $this->Form->label($question->question_text) ?>
            <?= $this->Form->control('answers.'.$i.'.answer_text', [
                'options' => [
                ['value' => 'Sí', 'text' => 'Sí'],
                ['value' => 'No', 'text' => 'No']
                ],
                'type' => 'radio',
                'label' => false,
                'class' =>'iradio_minimal-blue'
            ]) ?>
            <br>
            <?php break; ?>
          <?php endswitch; ?>
          <?php $i++; ?>
        <?php endforeach; ?>
        <?= $this->Form->hidden('form_id', ['value' => $form->id])?>
      </fieldset>
  </div>

  <div class="box-footer">
    <?= $this->Form->button(__('Responder'), ['id' => 'submit-form']) ?>
  </div>
  <?= $this->Form->end() ?>
</div>