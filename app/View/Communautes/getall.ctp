<div class="communautes index">
	<h2><?php echo __('Communautes'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('communaute_id'); ?></th>
			<th><?php echo $this->Paginator->sort('nom'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('parametres'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('adresse_id'); ?></th>
			
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($communautes as $communaute): ?>
	<tr>
		<td><?php echo h($communaute['Communaute']['communaute_id']); ?>&nbsp;</td>
		<td><?php echo h($communaute['Communaute']['nom']); ?>&nbsp;</td>
		<td><?php echo h($communaute['Communaute']['description']); ?>&nbsp;</td>
		<td><?php echo h($communaute['Communaute']['parametres']); ?>&nbsp;</td>
		<td><?php echo h($communaute['Communaute']['created']); ?>&nbsp;</td>
		<td><?php echo h($communaute['Communaute']['adresse_id']); ?>&nbsp;</td>
		
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $communaute['Communaute']['communaute_id'])); ?>
			<?php echo $this->Html->link('Voir le mur', array('controller'=>'Posts','action'=>'index', $communaute['Communaute']['communaute_id'])); ?>
			<?php echo $this->Html->link('Voir les offres', array('controller'=>'Offres','action'=>'getall', $communaute['Communaute']['communaute_id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $communaute['Communaute']['communaute_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $communaute['Communaute']['communaute_id']), null, __('Are you sure you want to delete # %s?', $communaute['Communaute']['communaute_id'])); ?>
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
