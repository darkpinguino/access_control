<td class="actions text-nowrap">
	<?= $this->Html->link(__('Ver'), 
		['action' => 'view', $entityId], 
		['class' => 'btn btn-primary btn-xs']) 
	?>
	<?= $this->Html->link(__('Editar'), 
		['action' => 'edit', $entityId], 
		['class' => 'btn btn-warning btn-xs']) 
	?>
	<?php 
	echo $this->Html->link(__('Eliminar'),
			[],
	       ['class'=>'btn btn-danger btn-xs btn-confirm',
	       'data-toggle'=> 'modal',
	       'data-target' => '#myModalDelete',
	       'data-action'=> $this->request->here.'/delete/'.$entityId,
	       'escape' => false], 
	false);
	?>
</td>