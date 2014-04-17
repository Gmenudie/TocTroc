<div class="search">


<?php 
	//Le formulaire de recherche
	echo $this->Form->create(false, array('url'=>array('controller'=>'offres','action'=>'search'))); ?>
	<fieldset>
		<legend><?php echo __('Rechercher une offre'); ?></legend>
	<?php
		echo $this->Form->input('Nom');
		echo $this->Form->select('appartenance_id', $appartenances, array('multiple'=>'checkbox','label'=>'Rechercher dans les communautés'));
		echo $this->Form->input('Category',array('label'=>'Catégorie','empty'=>'Toutes'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Rechercher')); ?>
</div>

<div class="results">

	<?php

	//Les résultats

	if (isset($offres)){?>
	<h2><?php echo __('Résultats'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			
			<th><?php echo $this->Paginator->sort('titre'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>			
						
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($offres as $offre): ?>
	<tr>
		
		<td><?php echo h($offre['Offre']['titre']); ?>&nbsp;</td>
		<td><?php echo h($offre['Offre']['description']); ?>&nbsp;</td>		
		<td class="actions">
			<?php echo $this->Html->link(__('Voir'), array('action' => 'view', $offre['Offre']['offre_id'])); ?>
			
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} sur {:pages}')
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
