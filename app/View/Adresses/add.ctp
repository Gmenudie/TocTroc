<div class="adresses form">
<?php echo $this->Form->create('Adress'); ?>
	<fieldset>
		<legend><?php echo __('Add Adress'); ?></legend>
	<?php
		echo $this->Form->input('numero');
		echo $this->Form->input('rue');
		echo $this->Form->input('code_postal');
		echo $this->Form->input('ville');
		echo $this->Form->input('numero_appartement');
		echo $this->Form->input('etage');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Adresses'), array('action' => 'index')); ?></li>
	</ul>
</div>
