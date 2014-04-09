<div class="offres form">
<?php echo $this->Form->create('Offre'); ?>
	<fieldset>
		<legend><?php echo __('Edit Offre'); ?></legend>
	<?php
		echo $this->Form->input('offre_id');
		echo $this->Form->input('titre');
		echo $this->Form->input('description');
		echo $this->Form->input('image');
		echo $this->Form->input('etat');
		echo $this->Form->input('date');
		echo $this->Form->input('appartenance_id');
		echo $this->Form->input('Category');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Offre.offre_id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Offre.offre_id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Offres'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Appartenances'), array('controller' => 'appartenances', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Appartenance'), array('controller' => 'appartenances', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
