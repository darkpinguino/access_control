<div class="box-header">
	<h3 class="box-title">Perfil de Visita</h3>
</div>

<div class="box-body">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered table-striped table-hover">
			  <thead>
				<tr>
					<th>Persona que Visita</th>
				  <th>Motivo de Visita</th>
				</tr>
			  </thead>
			  <tbody>
				  <tr>
						<td><?= h($visitProfile->person_to_visit->fullName)?></td>
					  <td><?= h($visitProfile->note)?></td>
				  </tr>
			  </tbody>
			</table>
		</div>
	</div>
</div>