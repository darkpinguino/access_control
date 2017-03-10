<div class="box">
	<?= $this->element('tableHeader', ['title' => 'Datos de Sensores'])?>
	<div class="box-body">
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                <th><?= $this->Paginator->sort('sensor_type_id', 'Tipo de Sensor') ?></th>
                <th><?= $this->Paginator->sort('people_id', 'Persona') ?></th>
                <th><?= $this->Paginator->sort('data', 'Dato') ?></th>
                <th><?= $this->Paginator->sort('company_id', 'Empresa') ?></th>
                <th><?= $this->Paginator->sort('created', 'Agregado') ?></th>
                <th><?= $this->Paginator->sort('modified', 'Modificado') ?></th>
                <th class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sensorData as $sensorData): ?>
            <tr>
                <td><?= $this->Number->format($sensorData->id) ?></td>
                <td><?= $sensorData->has('sensor_type') ? $this->Html->link($sensorData->sensor_type->name, ['controller' => 'SensorTypes', 'action' => 'view', $sensorData->sensor_type->id]) : '' ?></td>
                <td><?= $sensorData->has('person') ? $this->Html->link($sensorData->person->name, ['controller' => 'People', 'action' => 'view', $sensorData->person->id]) : '' ?></td>
                <td><?= h($sensorData->data) ?></td>
                <td><?= $sensorData->has('company') ? $this->Html->link($sensorData->company->name, ['controller' => 'Companies', 'action' => 'view', $sensorData->company->id]) : '' ?></td>
                <td><?= h($sensorData->created) ?></td>
                <td><?= h($sensorData->modified) ?></td>
                <?= $this->element('action', ['entityId' => $sensorData->id, 'displayField' => $sensorData->{$displayField}])?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	</div>
	<div class="box-footer">
		<?= $this->element('paginator') ?>
	</div>
</div>
