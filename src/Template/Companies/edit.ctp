<div class="box">
	<div class="box-header">
		<h3 class="box-title">Editar Empresa</h3>
	</div>
  <?= $this->Form->create($company) ?>
  <div class="box-body">    
    <fieldset>
      <?php
        echo $this->Form->input('name');
        echo $this->Form->input('email');
        echo $this->Form->input('phone');
        echo $this->Form->input('address');
        echo $this->Form->input('contact');
        echo $this->Form->input('description');
      ?>
    </fieldset>
   </div>
   <div class="box-footer"> 
  	<?= $this->Form->button(__('Guardar')) ?>
  </div>
  <?= $this->Form->end() ?>
</div>
