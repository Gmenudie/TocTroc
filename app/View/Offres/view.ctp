<div class="offres view">
<h2><?php echo h($offre['Offre']['titre']); ?></h2>
	<dl>
		
		
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($offre['Offre']['description']); ?>
			&nbsp;
		</dd>
		
		
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($offre['Offre']['date']); ?>
			&nbsp;
		</dd>
		
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__("Modifier l'offre"), array('action' => 'edit', $offre['Offre']['offre_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__("Supprimer"), array('action' => 'delete', $offre['Offre']['offre_id']), null, __("Etes-vous sûr de vouloir supprimer cette offre ?")); ?> </li>
	</ul>
</div>
<div class="catégorie">
	<h3><?php echo __('Categories'); ?></h3>
	<?php if (!empty($offre['Category'])): ?>
	
	<?php foreach ($offre['Category'] as $category): ?>
		
			<p><?php echo $category['nom']; ?></p>

			
	<?php endforeach; ?>

<?php endif; ?>

	
</div>
