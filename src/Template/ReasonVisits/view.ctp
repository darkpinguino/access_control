<div class="box">
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="box-header">
		  	<h3><?= h($reasonVisit->reason) ?></h3>
			</div>
			<div class="box-body">
			  <table class="table">
		      <tr>
	          <th><?= __('Motivo') ?></th>
	          <td><?= h($reasonVisit->reason) ?></td>
		      </tr>
	          <th><?= __('ID') ?></th>
	          <td><?= h($reasonVisit->id) ?></td>
		      </tr>
		      <tr>
	          <th><?= __('Agregada') ?></th>
	          <td><?= h($reasonVisit->created) ?></td>
		      </tr>
		      <tr>
	          <th><?= __('Modificada') ?></th>
	          <td><?= h($reasonVisit->modified) ?></td>
		      </tr>
			  </table>
			</div>
		</div>
	</div>
</div>
