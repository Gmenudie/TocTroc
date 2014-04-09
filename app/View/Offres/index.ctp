<div class="offres index">


	<?php if ($offres!=null){?>
	<h2><?php echo __('Vos offres publiées'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			
			<th><?php echo $this->Paginator->sort('titre'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>			
			<th><?php echo $this->Paginator->sort('created'); ?></th>			
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($offres as $offre): ?>
	<tr>
		
		<td><?php echo h($offre['Offre']['titre']); ?>&nbsp;</td>
		<td><?php echo h($offre['Offre']['description']); ?>&nbsp;</td>		
		<td><?php echo h($offre['Offre']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Voir'), array('action' => 'view', $offre['Offre']['offre_id'])); ?>
			<?php echo $this->Html->link(__('Modifer'), array('action' => 'edit', $offre['Offre']['offre_id'])); ?>
			<?php echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $offre['Offre']['offre_id']), null, __("Voulez-vous vraiment supprimer l'offre '%c?", $offre['Offre']['titre'])); ?>
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
	<?php } 
	else{echo("Vous n'avez pas encore publié d'offre");}?>
</div>
<div class="add">

<?php echo $this->Form->create('Offre',array('url'=>array('controller'=>'offres','action'=>'add'))); ?>
	<fieldset>
		<legend><?php echo __('Publier une nouvelle offre'); ?></legend>
	<?php
		echo $this->Form->input('titre');
		echo $this->Form->input('description');
		echo ("Publier l'annonce dans les communautés:");
		echo $this->Form->select('appartenance_id', $communautes, array('multiple'=>'checkbox'));
		echo ("Choisir les categories");
		echo $this->Form->select('categorie_id',$categories,array('multiple'=>true));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Publier offre')); ?>
</div>
