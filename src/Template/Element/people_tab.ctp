<?php 
	if ($tab)
		echo '<div id="people-tab" class="tab-pane fade in active" role="tabpanel">';
	?>
	<div class="box">
		<div class="row">
			<div class="col-md-5 col-md-offset-3">
				<div class="box-header">
					<h3>Autorización Personas: <?= $door->name ?></h3>
				</div>
				<?= $this->Form->create($person) ?>
				<div class="box-body">
				  <?php 
					  echo $this->Form->input('rut', ['label' => 'Rut', 'autofocus' => 'autofocus']);

						echo $this->Form->hidden('check', ['value' => 1]); 
					?>
				</div>
				  <div class="box-footer">
					  <?= $this->Form->button('Verificar') ?>
					  <?= $this->Form->button('Estado actual', [
						'id' => 'actual-state',
						'class' => 'btn btn-primary pull-right', 
						'type' => 'button',
						'door_id' => $door_id,
					  ]) ?>
				  </div>
				  <?= $this->Form->end() ?>
			</div>
		</div>

	</div>
	<div id="status-people-location" class="box">
	  <?= $this->element('Authorization/people_locations', ['people_locations' => $people_locations, 'people_out' => $people_out, 'door_id' => $door_id])?>
	  <div class="box-footer clearfix">
	  </div>
	</div>
	<div id="check_out" class="box">
	  <?= $this->element('Authorization/check_out', ['check_out' => $check_out])?>
	  <div class="box-footer clearfix">
	  </div>
	</div>
<?php 
	if ($tab)
		echo '</div>';
?>
