<span class="input-group-addon"></span>
<?= $this->form->control('questions.'.$question_count.'.measure_id', [
	'options' => $measures,
	'label' => false,
	'class' => 'form-control'
	]); ?>