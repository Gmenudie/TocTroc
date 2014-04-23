<div class="posts index">
	<h2><?php echo __('Posts'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>


			<th><?php echo $this->Paginator->sort('post_id'); ?></th>
			<th><?php echo $this->Paginator->sort('contenu'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('document_joint'); ?></th>
			<th><?php echo $this->Paginator->sort('canal_id'); ?></th>
			<th><?php echo $this->Paginator->sort('Appartenance.user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('Appartenance.communaute_id'); ?></th>
			
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($posts as $post): ?>
	<tr>
		<td><?php echo h($post['Post']['post_id']); ?>&nbsp;</td>
		<td><?php echo h($post['Post']['contenu']); ?>&nbsp;</td>
		<td><?php echo h($post['Post']['created']); ?>&nbsp;</td>

		<td><?php if(array_key_exists('document_joint', $post['Post']) && $post['Post']['document_joint']!=null)
		{
			echo h($post['Post']['document_joint']);
		} ?>&nbsp;
		</td>

		<td><?php echo h($post['Post']['canal_id']); ?>&nbsp;</td>
		<td><?php echo h($post['Appartenance']['user_id']); ?>&nbsp;</td>
		<td><?php echo h($post['Appartenance']['communaute_id']); ?>&nbsp;</td>
		
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $post['Post']['post_id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Post']['post_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $post['Post']['post_id']), null, __('Are you sure you want to delete # %s?', $post['Post']['post_id'])); ?>
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
