<div class="form-group">
		<div class="form-group row">
			<div class="col-md-6">
				<?= $this->Form->input('contractor_company_id', 
					[
						'options' => $contractor_companies, 
						'style' => 'display:none;',
						'label' => false
					]);
				 ?>
			</div>
			<div class="col-md-6">
				<?= $this->Form->input('new_contractor_company', 
					[
						'placeholder' => 'Nueva empresa contratista',
						'style' => 'display:none',
						'label' => false
					]);
				?>
			</div>
		</div>
</div>