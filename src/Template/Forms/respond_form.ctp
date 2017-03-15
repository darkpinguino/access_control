<?= $this->Html->script('form/respondForm.js', ['block' => 'scriptView']); ?>

<?= $this->element('/Forms/respond_form', ['answer_set' => $answer_set, 'form' => $form])?>
