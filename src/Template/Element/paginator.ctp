<span class="label label-default">
  <?= $this->Paginator->counter(['format' => '{{page}} de {{pages}}']) ?>
</span>
<ul class="pagination pagination-sm no-margin pull-right">
	<?= $this->Paginator->first('<< Primero')?>
  <?= $this->Paginator->prev('< Anterior') ?>
  <?= $this->Paginator->numbers() ?>
  <?= $this->Paginator->next('Siguiente >') ?>
  <?= $this->Paginator->last('Último >>')?>
</ul>