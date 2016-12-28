<div class="box">
	<div class="box-header">
		<h3 class="box-title">Editar Rol de Acceso</h3>
	</div>
  <?= $this->Form->create($accessRole) ?>
  <div class="box-body">
    <fieldset>
      <?php
        echo $this->Form->input('name', ['label' => 'Nombre']);
        echo $this->Form->input('description', ['label' => 'Descripción']);
        // echo $this->Form->input('user_id');
        if ($userRole_id == 1) {
          echo $this->Form->input('company_id', ['label' => 'Empresa', 'options' => $companies]);
        }
      ?>
    </fieldset>
  </div>
  <div class="box-footer">
	  <?= $this->Form->button(__('Guardar')) ?>
  </div>
  <?= $this->Form->end() ?>
</div>
