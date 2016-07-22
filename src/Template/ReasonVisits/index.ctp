<div class="box">
  <?= $this->element('tableHeader', ['title' => 'Motivos de visita'])?>
  <div class="box-body">
    <table class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <th><?= $this->Paginator->sort('id', 'ID') ?></th>
          <th><?= $this->Paginator->sort('reason', 'Motivo') ?></th>
          <th><?= $this->Paginator->sort('created') ?></th>
					<th><?= $this->Paginator->sort('modified') ?></th>
          <th><?= __('Acciones') ?></th>
        </tr>
      </thead>
      <tbody>
          <?php foreach ($reasonVisits as $reasonVisit): ?>
          <tr>
              <td><?= $this->Number->format($reasonVisit->id) ?></td>
              <td><?= h($reasonVisit->reason) ?></td>
              <td><?= h($reasonVisit->created) ?></td>
              <td><?= h($reasonVisit->modified) ?></td>
              <?= $this->element('action', ['entityId' => $reasonVisit->id])?>
          </tr>
          <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div class="box-footer clearfix">
  	<?= $this->element('paginator') ?>
  </div>
</div>
