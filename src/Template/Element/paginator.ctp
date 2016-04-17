<ul class="pagination pagination-sm no-margin pull-right">
  <?= $this->Paginator->prev('<') ?>
  <?= $this->Paginator->numbers([
    'first' => '<<', 
    'last' => '>>'
  ]) ?>
  <?= $this->Paginator->next('>') ?>
</ul>
<span class="label label-default">
  <?= $this->Paginator->counter(['format' => '{{page}} de {{pages}}']) ?>
</span>