<div class="box">
  <div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="box-header">
		  	<h3><?= h($accessStatus->status) ?></h3>
			</div>
			<div class="box-body">
		    <table class="table">
	        <tr>
            <th><?= __('Estado') ?></th>
            <td><?= h($accessStatus->status) ?></td>
	        </tr>
	        <tr>
            <th><?= __('ID') ?></th>
            <td><?= h($accessStatus->id) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Agregado') ?></th>
            <td><?= h($accessStatus->created) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Modificado') ?></th>
            <td><?= h($accessStatus->modified) ?></td>
	        </tr>
		    </table>
		  </div>
		</div>
	</div>	  
</div>
