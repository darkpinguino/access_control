<div class="box">
    <div class="box-header">
        <h3 class="box-title">Editar perfil <?= h($company_profile->profile->name)?></h3>
    </div>
  <?= $this->Form->create($company_profile) ?>
  <div class="box-body">
      <fieldset>
        <?php
          echo $this->Form->input('maxTime', ['label' => 'Tiempo maximo en horas']);
          // echo $this->Form->input('company_id', ['options' => $companies]);
        ?>
      </fieldset>
  </div>
  <div class="box-footer">
      <?= $this->Form->button(__('Guardar')) ?>
  </div>
  <?= $this->Form->end() ?>
</div>