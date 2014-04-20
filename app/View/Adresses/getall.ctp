<div class="adresses index">
	<h2><?php echo __('Adresses'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('adresse_id'); ?></th>
			<th><?php echo $this->Paginator->sort('numero'); ?></th>
			<th><?php echo $this->Paginator->sort('rue'); ?></th>
			<th><?php echo $this->Paginator->sort('code_postal'); ?></th>
			<th><?php echo $this->Paginator->sort('ville'); ?></th>
			<th><?php echo $this->Paginator->sort('numero_appartement'); ?></th>
			<th><?php echo $this->Paginator->sort('etage'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($adresses as $adress): ?>
	<tr>
		<td><?php echo h($adress['Adress']['adresse_id']); ?>&nbsp;</td>
		<td><?php echo h($adress['Adress']['numero']); ?>&nbsp;</td>
		<td><?php echo h($adress['Adress']['rue']); ?>&nbsp;</td>
		<td><?php echo h($adress['Adress']['code_postal']); ?>&nbsp;</td>
		<td><?php echo h($adress['Adress']['ville']); ?>&nbsp;</td>
		<td><?php echo h($adress['Adress']['numero_appartement']); ?>&nbsp;</td>
		<td><?php echo h($adress['Adress']['etage']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $adress['Adress']['adresse_id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $adress['Adress']['adresse_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $adress['Adress']['adresse_id']), null, __('Are you sure you want to delete # %s?', $adress['Adress']['adresse_id'])); ?>
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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Adress'), array('action' => 'add')); ?></li>
	</ul>
</div>
 