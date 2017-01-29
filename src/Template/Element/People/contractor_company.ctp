<div class="form-group contractor-companies-select" style="display:none;">
	<div class="form-group row">
		<div class="col-md-6">
			<?= $this->Form->input('contractor_company_id', 
				[
					'options' => $contractor_companies, 
					'label' => false
				]);
			 ?>
		</div>
		<div class="col-md-6">
			<?= $this->Form->input('new_contractor_company', 
				[
					'placeholder' => 'Nueva empresa contratista',
					'label' => false
				]);
			?>
		</div>
	</div>
</div>