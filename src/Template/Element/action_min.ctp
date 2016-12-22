<td nowrap class="actions">
	<?= $this->Html->link(__('Ver'), 
		['action' => 'view', $entityId], 
		['class' => 'btn btn-primary btn-xs']) 
	?>
	<?= $this->Html->link(__('Editar'), 
		['action' => 'edit', $entityId], 
		['class' => 'btn btn-warning btn-xs']) 
	?>
</td>