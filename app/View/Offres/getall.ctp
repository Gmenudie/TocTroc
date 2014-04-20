<div class="offres index">
	<h2><?php echo __('Offres'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>


			<th><?php echo $this->Paginator->sort('offre_id'); ?></th>
			<th><?php echo $this->Paginator->sort('titre'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('image'); ?></th>
			<th><?php echo $this->Paginator->sort('etat'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo 'Category id' ; ?></th>
			<th><?php echo 'Category nom' ;?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($offres as $offre): ?>
	<tr>
		<td><?php echo h($offre['Offre']['offre_id']); ?>&nbsp;</td>
		<td><?php echo h($offre['Offre']['titre']); ?>&nbsp;</td>
		<td><?php echo h($offre['Offre']['description']); ?>&nbsp;</td>
		<td><?php echo h($offre['Offre']['image']); ?>&nbsp;</td>
		<td><?php echo h($offre['Offre']['etat']); ?>&nbsp;</td>
		<td><?php echo h($offre['Offre']['created']); ?>&nbsp;</td>
		<td>
			<?php foreach($offre['Category'] as $category)
			{
				echo h($category['categorie_id']);
				echo (', '); 
			} ?> &nbsp;
		</td>

		<td>
			<?php foreach($offre['Category'] as $category)
			{
				echo h($category['nom']);
				echo (', '); 
			} ?>&nbsp;
		</td>
		
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $offre['Offre']['offre_id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $offre['Offre']['offre_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $offre['Offre']['offre_id']), null, __('Are you sure you want to delete # %s?', $offre['Offre']['offre_id'])); ?>
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
		echo $this->Paginator->prev('< ' . __('previous '), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__(' next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
