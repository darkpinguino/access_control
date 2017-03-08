<div class="box">
	<div class="box-header">
		<h3 class="box-title">Nuevo Motivo de visita</h3>
	</div>
  <?= $this->Form->create($reasonVisit) ?>
  <div class="box-body">
	  <fieldset>
	    <?php
	      echo $this->Form->input('reason', ['label' => 'Motivo']);
	    ?>
	  </fieldset>
  </div>
  <div class="box-footer">
  	<?= $this->Form->button(__('Guardar')) ?>
  </div>
  <?= $this->Form->end() ?>
</div>