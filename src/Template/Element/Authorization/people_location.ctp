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
		              		acction="in" class="btn btn-xs btn-success authorization">Ingresar</button>
		              </td>
		          </tr>
		          <?php endforeach; ?>
		      </tbody>
		    </table>
  		</div>
  		<div class="col-md-6">
  			<table class="table table-bordered table-striped table-hover">
		      <thead>
		        <tr>
		        	<th>RUT</th>
		          <th>Nombre</th>
		          <th>Reciento</th>
		          <th><?= __('Acciones') ?></th>
		        </tr>
		      </thead>
		      <tbody>
		          <?php foreach ($peopleLocations as $location): ?>
		          <tr>
		          		<td><?= h($location->person->rut)?></td>
		              <td><?= h($location->person->name)?> &nbsp; <?= h($location->person->lastname)?></td>
		              <td><?= h($location->enclosure->name)?></td>
		              <td>
		              	<button type="button" person-rut=<?= h($location->person->rut)?>  door-id=<?= h($door_id)?>
		              		acction="out" class="btn btn-xs btn-danger authorization">Retirar</button>
		              </td>
		          </tr>
		          <?php endforeach; ?>
		      </tbody>
		    </table>
  		</div>
  	</div>
  </div>