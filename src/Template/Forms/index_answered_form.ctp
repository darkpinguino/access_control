<div class="box">
  <?= $this->element('tableHeader', ['title' => 'Formularios Respondidos'])?>
  <div class="box-body">
      <table class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <th><?= $this->Paginator->sort('id', 'ID') ?></th>
          <th><?= $this->Paginator->sort('created', 'Creado') ?></th>
          <th><?= __('Acciones') ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($answers_sets as $answer_set): ?>
          <tr>
              <td><?= $this->Number->format($answer_set->id) ?></td>
              <td><?= h($answer_set->created) ?></td>
              <td>  
              <?= $this->Html->link(__('Ver'), 
                    ['action' => 'viewAnsweredForm', $answer_set->id], 
                    ['class' => 'btn btn-primary btn-xs']) 
              ?>
              </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
      </table>
  </div>
  <div class="box-footer clearfix">
    <?= $this->element('paginator') ?>
  </div>

</div>