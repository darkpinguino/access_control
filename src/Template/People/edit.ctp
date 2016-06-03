<?php $status = $this->request->query('status');?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title">
        <?=
        	strcmp($status, 'pending') ? 'Editar Persona' : 'Completar datos Persona';
          
        ?></h3>
    </div>
  <?= $this->Form->create($person) ?>
  <div class="box-body">
      <fieldset>
        <?php
        	echo strcmp($status, 'pending') ? $this->Form->input('rut') : '';
          echo $this->Form->input('name');
          echo $this->Form->input('lastname');
          echo $this->Form->input('phone');
          echo $this->Form->input('company_id', ['options' => $companies]);
        ?>
      </fieldset>
  </div>
  <div class="box-footer">
      <?= $this->Form->button(__('Guardar')) ?>
  </div>
  <?= $this->Form->end() ?>
</div>
