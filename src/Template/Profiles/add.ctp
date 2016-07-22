<div class="box">
    <div class="box-header">
        <h3 class="box-title">Nuevo Perfil</h3>
    </div>
  <?= $this->Form->create($profile) ?>
  <div class="box-body">
      <fieldset>
        <?php
          echo $this->Form->input('name', ['label' => 'Nombre']);
          echo $this->Form->input('company_id', [
            'options' => $companies, 
            'label' => 'Empresa'
          ]);
        ?>
      </fieldset>
  </div>
  <div class="box-footer">
    <?= $this->Form->button(__('Guardar')) ?>
  </div>
  <?= $this->Form->end() ?>
</div>
