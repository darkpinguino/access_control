<div id="vehicle-actual-state-modal" class="modal fade">
  <div class="modal-dialog modal-lg">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">×</span></button>
		<h4 class="modal-title">Estado Actual</h4>
	  </div>
	  <div class="modal-body">
	  </div>
	  <div class="modal-footer">
		<?= $this->Html->link(__('Exportar'), ['action' => 'exportVehicleActualState', '_ext' => 'pdf'], ['class' => 'btn btn-primary']); ?>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	  </div>
	</div>
  </div>
</div>