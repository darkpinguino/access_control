<?= $this->element('tableHeader', ['title' => 'Perosonas'])?>
<div class="box-body">
	<div class="row">
		<div class="col-md-6">
	    <table class="table table-bordered table-striped table-hover">
	      <thead>
	        <tr>
	        	<th>RUT</th>
	          <th>Nombre</th>
	          <th><?= __('Acciones') ?></th>
	        </tr>
	      </thead>
	      <tbody>
	          <?php foreach ($people_out as $person): ?>
	          <tr>

	              <td><?= h($person->rut)?></td>
		            <td><?= h($person->name)?> &nbsp; <?= h($person->lastname)?></td>
	              <td>
	              	<button type="button" person-rut=<?= h($person->rut)?>  door-id=<?= h($door_id)?>
	              		class="btn btn-xs btn-success in-button">Ingresar</button></td>
	          </tr>
	          <?php endforeach; ?>
	      </tbody>
	    </table>
		</div>
		<div class="col-md-6">
			<table class="table table-bordered table-striped table-hover">
	      <thead>
	        <tr>
	          <th>Nombre</th>
	          <th><?= __('Acciones') ?></th>
	        </tr>
	      </thead>
	      <tbody>
	          <?php foreach ($people_in as $person): ?>
	          <tr>
	              <td><?= h($person->name) ?></td>
	              <td>
	              	<button type="button" person-rut=<?= h($person->rut)?>  door-id=<?= h($door_id)?>
		              		class="btn btn-xs btn-danger in-button">Retirar</button>
	              </td>
	          </tr>
	          <?php endforeach; ?>
	      </tbody>
	    </table>
		</div>
	</div>
</div>
<div class="box-footer clearfix">
</div>
