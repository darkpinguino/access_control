<td nowrap class="actions">
	<?= $this->Html->link(__('Ver'), 
		['action' => 'view', $entityId], 
		['class' => 'btn btn-primary btn-xs']) 
	?>
	<?= $this->Form->postLink(__('Eliminar'), 
		['action' => 'delete', $entityId], 
		[
			'confirm' => __('Are you sure you want to delete # {0}?', $entityId), 
			'class' => 'btn btn-danger btn-xs'
		]) 
	?>
</td>