<div class="box">
	<div class="box-header">
		<h3 class="box-title">Editar Alerta <?= $notification->notification?></h3>
	</div>
  <?= $this->Form->create($notification) ?>
  <div class="box-body">
	  <fieldset>
		<?php
		  echo $this->Form->input('comment', ['type' => 'text', 'label' => 'Comentario']);
		  echo $this->Form->input('active', [
				'type' => 'checkbox',
				'label' => 'activa',
				'templates' => [
					'inputContainer' => '<div class="checkbox">{{content}}</div>'
				]
			]);
		?>

	  </fieldset>
  </div>
  <div class="box-footer">
	  <?= $this->Form->button(__('Guardar')) ?>
  </div>
  <?= $this->Form->end() ?>
</div>
