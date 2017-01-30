<div class="box-header">
	<h3 class="box-title">Registro de salida</h3>
</div>

<div class="box-body">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered table-striped table-hover">
			  <thead>
				<tr>
					<th>Rut</th>
				  <th>Nombre</th>
				  <th>Hora Salida</th>
				</tr>
			  </thead>
			  <tbody>
				  <?php foreach ($check_out as $out): ?>
				  <tr>
						<td><?= h($out->person->rut)?></td>
					  <td><?= h($out->person->fullName)?></td>
					  <td><?= h($out->created)?></td>
					  <td>
					  </td>
				  </tr>
				  <?php endforeach; ?>
			  </tbody>
			</table>
		</div>
	</div>
</div>