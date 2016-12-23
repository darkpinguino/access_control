<td nowrap class="actions">
	<?= $this->Html->link(__('Ver'), 
		['action' => 'view', $entityId], 
		['class' => 'btn btn-primary btn-xs']) 
	?>
	<?= $this->Html->link(__('Editar'), 
		['action' => 'edit', $entityId], 
		['class' => 'btn btn-warning btn-xs']) 
	?>
	<?= $this->Form->postLink(__('Eliminar'), 
		[
			'controller' => $controller,
			'action' => 'delete', 
			$entityId], 
		[
			'confirm' => __('Are you sure you want to delete # {0}?', $deleteEntityId), 
			'class' => 'btn btn-danger btn-xs'
		]) 
	?>
</td>