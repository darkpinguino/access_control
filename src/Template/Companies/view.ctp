<div class="box">
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="box-header">
		  	<h3><?= h($company->name) ?></h3>
			</div>
			<div class="box-body">
			  <table class="table">
		      <tr>
	          <th><?= __('Nombre') ?></th>
	          <td><?= h($company->name) ?></td>
		      </tr>
		      <tr>
	          <th><?= __('Correo') ?></th>
	          <td><?= h($company->email) ?></td>
		      </tr>
		      <tr>
	          <th><?= __('Dirección') ?></th>
	          <td><?= h($company->address) ?></td>
		      </tr>
		      <tr>
	          <th><?= __('Contacto') ?></th>
	          <td><?= h($company->contact) ?></td>
		      </tr>
		      <tr>
	          <th><?= __('Telefono') ?></th>
	          <td><?= h($company->phone) ?></td>
		      </tr>
		      <tr>
	          <th><?= __('Description') ?></th>
	          <td><?= h($company->description) ?></td>
		      </tr>
		      <tr>
	          <th><?= __('ID') ?></th>
	          <td><?= h($company->id) ?></td>
		      </tr>
		      <tr>
	          <th><?= __('Agregada') ?></th>
	          <td><?= h($company->created) ?></td>
		      </tr>
		      <tr>
	          <th><?= __('Modificada') ?></th>
	          <td><?= h($company->modified) ?></td>
		      </tr>
			  </table>
			</div>
		</div>
	</div>
</div>
