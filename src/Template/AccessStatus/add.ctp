<div class="box">
	<div class="box-header">
		<h3 class="box-title">Nuevo Estado de Acceso</h3>
	</div>
  <?= $this->Form->create($accessStatus) ?>
  <div class="box-body">
    <fieldset>
      <?php
         echo $this->Form->input('status', ['label' => 'Estado']);
      ?>
    </fieldset>
  </div>
  <div class="box-footer">
    <?= $this->Form->button(__('Guardar')) ?>
  </div>
    <?= $this->Form->end() ?>
</div>
