<div class="adresses view">
<h2><?php echo __('Adress'); ?></h2>
	<dl>
		<dt><?php echo __('Adresse Id'); ?></dt>
		<dd>
			<?php echo h($adress['Adress']['adresse_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Numero'); ?></dt>
		<dd>
			<?php echo h($adress['Adress']['numero']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rue'); ?></dt>
		<dd>
			<?php echo h($adress['Adress']['rue']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code Postal'); ?></dt>
		<dd>
			<?php echo h($adress['Adress']['code_postal']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ville'); ?></dt>
		<dd>
			<?php echo h($adress['Adress']['ville']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Numero Appartement'); ?></dt>
		<dd>
			<?php echo h($adress['Adress']['numero_appartement']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Etage'); ?></dt>
		<dd>
			<?php echo h($adress['Adress']['etage']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Adress'), array('action' => 'edit', $adress['Adress']['adresse_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Adress'), array('action' => 'delete', $adress['Adress']['adresse_id']), null, __('Are you sure you want to delete # %s?', $adress['Adress']['adresse_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Adresses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Adress'), array('action' => 'add')); ?> </li>
	</ul>
</div>
