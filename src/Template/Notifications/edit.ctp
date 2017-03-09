<div class="box">
	<div class="box-header">
		<h3 class="box-title">Editar Alerta <?= $notification->notification?></h3>
	</div>
  <?= $this->Form->create($notification) ?>
  <div class="box-body">
	  <fieldset>
		<?php
		  echo $this->Form->input('comment', ['type' => 'text', 'label' => 'Comentario']);
		?>

	  </fieldset>
  </div>
  <div class="box-footer">
	  <?= $this->Form->button(__('Guardar')) ?>
  </div>
  <?= $this->Form->end() ?>
</div>
