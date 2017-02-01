<?= $this->Html->script('authorization/authorization.js', ['block' => 'scriptView']); ?>




<?php if (!is_null($door)): ?>
	<?php switch ($door->access_type):
		case 1: ?>
			<div class="panel panel-defautl">
					<div class="panel-body"> 
						<?= $this->element('people_tab', ['people_locations' => $people_locations, 'people_out' => $people_out, 'door_id' => $door->id, 'check_out' => $check_out, 'tab' => false]) ?>
				</div>
			</div>
		<?php break; ?>
		<?php case 2: ?>
			<div class="panel panel-defautl">
				<div class="panel-body">
					<?= $this->element('vehicles_tab', ['vehicle_types' => $vehicle_types, 'vehicle_profile' => $vehicle_profiles, 'door_id' => $door->id, 'people_out' => $people_out,  'tab' => false]) ?>
				</div>
			</div>
		<?php break; ?>
		<?php case 3: ?>
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs" role="tablist">
					<li class="active"><a href="#people-tab" aria-controls="people-tab" role="tab" data-toggle="tab">Personas</a></li>
						<li><a href="#vehicle-tab" aria-controls="vehicle-tab" role="tab" data-toggle="tab">Vehículos</a></li>
				</ul>
				<div class="tab-content">

			<?= $this->element('people_tab', ['people_locations' => $people_locations, 'people_out' => $people_out, 'door_id' => $door->id, 'check_out' => $check_out, 'tab' => true]) ?>
			<?= $this->element('vehicles_tab', ['vehicle_types' => $vehicle_types, 'vehicle_profile' => $vehicle_profiles, 'door_id' => $door->id, 'people_out' => $people_out, 'tab' => true]) ?>

				</div>
			</div>

		<?php break; ?>
	<?php endswitch ?>
		
<?php else: ?>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="box box-default">
        <div class="box-header with-border">
          <i class="fa fa-warning"></i>
          <h3 class="box-title">Alerta</h3>
        </div>
        <div class="box-body">
          <div class="alert alert-danger">
          No tiene una puerta a cargo asignada!
            
          </div>
        </div>
      </div>
		</div>
	</div>
<?php endif; ?>

		
	

<div id="error">
	
</div>

<?= $this->Form->hidden('asd', ['id' => 'user-id', 'value' => $user_id])?>

<?= $this->element('Modal/actualState') ?>  
<?= $this->element('Modal/vehicleActualState') ?>  


<?= $this->element('Modal/insideAlert') ?>  

<?php 
	if (isset($active_vehicle_alert)) {
		// echo $this->element('Modal/vehicleAlert', ['person_alert' => $person_alert, 'vehicle_location' => $vehicle_location]);
	}
?>
