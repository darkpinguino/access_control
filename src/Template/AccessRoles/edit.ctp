<div class="box">
	<div class="box-header">
		<h3 class="box-title">Editar Rol de Acceso</h3>
	</div>
  <?= $this->Form->create($accessRole) ?>
  <div class="box-body">
    <fieldset>
      <?php
        echo $this->Form->input('name');
        echo $this->Form->input('description');
        echo $this->Form->input('user_id');
        echo $this->Form->input('company_id', ['options' => $companies]);
      ?>
    </fieldset>
  </div>
  <div class="box-footer">
	  <?= $this->Form->button(__('Guardar')) ?>
  </div>
  <?= $this->Form->end() ?>
</div>
