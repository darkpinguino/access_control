<div class="box">
  <?= $this->element('tableHeader', ['title' => 'Measures'])?>
  <div class="box-body">
    <table id="measuresTable" class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
            <th><?= $this->Paginator->sort('id', 'ID') ?></th>
            <th><?= $this->Paginator->sort('measure', 'Medida') ?></th>
            <th><?= __('Acciones') ?></th>
        </tr>
      </thead>
      <tbody>
          <?php foreach ($measures as $measure): ?>
          <tr>
            <td><?= $this->Number->format($measure->id) ?></td>
            <td><?= h($measure->measure) ?></td>
            <?= $this->element('action', ['entityId' => $measure->id, 'displayField' => $measure->{$displayField}])?>
          </tr>
          <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div class="box-footer clearfix">
    <?= $this->element('paginator') ?>
  </div>
  <div class="box-footer clearfix">
    <?= $this->Html->link('Crear Nueva Medida', ['action' => 'add'], ['class' => 'btn btn-info pull-left'])?>
  </div>
</div>
