<div class="box">
	<div class="box-header">
	  <h3 class="box-title">Datos Visita</h3>
	</div>
	<div class="box-body">
		<?php
			$this->Form->create($visitProfile);
			echo $this->Form->input('reason_visit_id', [
				'options' => $reasonVisits,
				'label' => 'Motivo visita'
			]);
			echo $this->Form->input('person_to_visit_id', [
				'options' => $personToVisit,
				'label' => 'Persona que visita'
			]);
			echo $this->Form->input('maxTime', ['label' => 'Horas máximas de ingreso']);
			echo $this->Form->input('note', [
				'label' => 'Nota'
			]);

			$this->Form->end();
		?>
	</div>	
</div>