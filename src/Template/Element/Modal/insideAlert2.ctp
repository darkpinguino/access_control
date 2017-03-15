<div id="alert-modal" class="modal fade">
  <div class="modal-dialog modal-lg">
	<div class="modal-content">
	  <div class="modal-header modal-header-danger">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">×</span></button>
		<h4 class="modal-title">Personas que han excedido el tiempo de permanencia</h4>
	  </div>
	  <div class="modal-body">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>RUT</th>
					<th>Nombre</th>
					<th>Perfil</th>
					<th>Ultimo registro de ingreso</th>
					<th>Fecha/Hora</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					

					<td><?= h($access_request->person->rut)?></td>
					<td><?= h($access_request->person->fullName)?></td>
					<td><?= h($access_request->person->company_people[0]->profile->name)?></td>
					<td><?= h($access_request->door->enclosure->name)?></td>
					<td><?= h($access_request->created)?></td>
				</tr>
			</tbody>
		</table>
	  </div>
	  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	  </div>
	</div>
  </div>
</div>