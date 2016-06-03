<div class="box">
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="box-header">
				<h3><?= h($enclosure->name) ?></h3>
			</div>
			<div class="box-body">
		    <table class="table">
	        <tr>
            <th><?= __('Nombre') ?></th>
            <td><?= h($enclosure->name) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Ubicación') ?></th>
            <td><?= h($enclosure->location) ?></td>
	        </tr>
	        </tr><tr>
            <th><?= __('Descripción') ?></th>
            <td><?= h($enclosure->description) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Empresa') ?></th>
            <td><?= $enclosure->has('company') ? $this->Html->link($enclosure->company->name, ['controller' => 'Companies', 'action' => 'view', $enclosure->company->id]) : '' ?></td>
	        </tr>
	        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($enclosure->id) ?></td>
	        <tr>
            <th><?= __('Agregada') ?></th>
            <td><?= h($enclosure->created) ?></td>
	        </tr>
	        <tr>
            <th><?= __('Modificada') ?></th>
            <td><?= h($enclosure->modified) ?></td>
	        </tr>
		    </table>
			</div>
		</div>
	</div>
</div>
<div class="related">
        <h4><?= __('Related Doors') ?></h4>
        <?php if (!empty($enclosure->doors)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Location') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Company Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('Type') ?></th>
                <th><?= __('Enclosure Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($enclosure->doors as $doors): ?>
            <tr>
                <td><?= h($doors->id) ?></td>
                <td><?= h($doors->name) ?></td>
                <td><?= h($doors->location) ?></td>
                <td><?= h($doors->description) ?></td>
                <td><?= h($doors->company_id) ?></td>
                <td><?= h($doors->created) ?></td>
                <td><?= h($doors->modified) ?></td>
                <td><?= h($doors->type) ?></td>
                <td><?= h($doors->enclosure_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Doors', 'action' => 'view', $doors->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Doors', 'action' => 'edit', $doors->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Doors', 'action' => 'delete', $doors->id], ['confirm' => __('Are you sure you want to delete # {0}?', $doors->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>