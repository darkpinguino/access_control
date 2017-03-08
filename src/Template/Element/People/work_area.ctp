<div class="form-group work-areas-select" style="display:none;">
	<div class="form-group row">
		<div class="col-md-6">
			<?= $this->Form->input('work_area_id', 
				[
					'options' => $work_areas, 
					'label' => false
				]);
			 ?>
		</div>
		<div class="col-md-6">
			<?= $this->Form->input('new_work_area', 
				[
					'placeholder' => 'Nueva area de trabajo',
					'label' => false
				]);
			?>
		</div>
	</div>
</div>