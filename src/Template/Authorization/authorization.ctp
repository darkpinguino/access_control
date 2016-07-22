<?= $this->Html->script('authorization/authorization.js', ['block' => 'scriptView']); ?>

<div class="box">
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="box-header">
				<h3>Autorizacion</h3>
			</div>
			<?= $this->Form->create($person) ?>
			<div class="box-body">
				<fieldset>
		  <?php
			echo $this->Form->input('rut', ['label' => 'Rut']);
			echo $this->Form->input('door_id', 
			[
				'options' => $doors, 
				'label' => 'Puerta'
		  ]);
		   ?>
			</div>
			  <div class="box-footer">
				  <?= $this->Form->button(__('Verificar')) ?>
			  </div>
			  <?= $this->Form->end() ?>
		</div>
	</div>
</div>

<div id="status-location" class="box">
  <?= $this->element('Authorization/people_location', ['peopleLocations' => $peopleLocations, 'people_out' => $people_out, 'door_id' => $door_id])?>
  <div class="box-footer clearfix">
  </div>
</div>

<div id="error"></div>