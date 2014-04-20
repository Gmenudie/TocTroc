<div class="appartenances index">
	<h2><?php echo __('Appartenances'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('Appartenance.appartenance_id'); ?></th>
			<th><?php echo $this->Paginator->sort('Appartenance.user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('User.email'); ?></th>
			<th><?php echo $this->Paginator->sort('Appartenance.communaute_id'); ?></th>
			<th><?php echo $this->Paginator->sort('Communaute.nom'); ?></th>
			<th><?php echo $this->Paginator->sort('Appartenance.valide'); ?></th>
			<th><?php echo $this->Paginator->sort('Appartenance.role'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($appartenances as $appartenance): ?>
	<tr>
		<td><?php echo h($appartenance['Appartenance']['appartenance_id']); ?>&nbsp;</td>
		<td><?php echo h($appartenance['Appartenance']['user_id']); ?>&nbsp;</td>
		<td><?php echo h($appartenance['User']['email']); ?>&nbsp;</td>
		<td><?php echo h($appartenance['Appartenance']['communaute_id']); ?>&nbsp;</td>
		<td><?php echo h($appartenance['Communaute']['nom']); ?>&nbsp;</td>
		<td><?php echo h($appartenance['Appartenance']['valide']); ?>&nbsp;</td>
		<td><?php echo h($appartenance['Appartenance']['role']); ?>&nbsp;</td>

		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $appartenance['Appartenance']['appartenance_id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $appartenance['Appartenance']['appartenance_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $appartenance['Appartenance']['appartenance_id']), null, __('Are you sure you want to delete # %s?', $appartenance['Appartenance']['appartenance_id'])); ?>
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
