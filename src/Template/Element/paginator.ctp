<span class="label label-default">
  <?= $this->Paginator->counter(['format' => '{{page}} de {{pages}}']) ?>
</span>
<ul class="pagination pagination-sm no-margin pull-right">
	<?= $this->Paginator->first('<<')?>
  <?= $this->Paginator->prev('<') ?>
  <?= $this->Paginator->numbers() ?>
  <?= $this->Paginator->next('>') ?>
  <?= $this->Paginator->last('>>')?>
</ul>