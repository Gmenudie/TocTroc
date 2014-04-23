<div class="commentaires index">
	<h2><?php echo __('Utilisateurs'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('Commentaire.commentaire_id'); ?></th>
			<th><?php echo $this->Paginator->sort('Commentaire.contenu'); ?></th>
			<th><?php echo $this->Paginator->sort('Commentaire.created'); ?></th>
			<th><?php echo $this->Paginator->sort('Commentaire.post_id'); ?></th>
			<th><?php echo $this->Paginator->sort('Commentaire.Post.contenu'); ?></th>
			<th><?php echo $this->Paginator->sort('Commentaire.appartenance_id'); ?></th>
			
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($commentaires as $commentaire): ?>
	<tr>
		<td><?php echo h($commentaire['Commentaire']['commentaire_id']); ?>&nbsp;</td>
		<td><?php echo h($commentaire['Commentaire']['contenu']); ?>&nbsp;</td>
		<td><?php echo h($commentaire['Commentaire']['created']); ?>&nbsp;</td>
		<td><?php echo h($commentaire['Commentaire']['post_id']); ?>&nbsp;</td>
		<td><?php echo h($commentaire['Post']['contenu']); ?>&nbsp;</td>
		<td><?php echo h($commentaire['Commentaire']['appartenance_id']); ?>&nbsp;</td>

		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $commentaire['Commentaire']['commentaire_id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $commentaire['Commentaire']['commentaire_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $commentaire['Commentaire']['commentaire_id']), null, __('Are you sure you want to delete # %s?', $commentaire['Commentaire']['appartenance_id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
