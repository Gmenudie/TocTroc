<?php if ($statut==0)
{
	echo("Vous n'avez pas l'autorisation");
}

else{ 
?>

	<div class="offres view">
	<h2><?echo h($offre[0]['Offre']['titre']); ?></h2>
		<dl>		
			<dt>Description</dt>
			<dd>
				<?php echo h($offre[0]['Offre']['description']); ?>
				&nbsp;
			</dd>
			
			
			<dt><?php echo __('Date'); ?></dt>
			<dd>
				<?php echo h($offre[0]['Offre']['created']); ?>
				&nbsp;
			</dd>
			
		</dl>
	</div>

	<?php if($statut==2){ ?>
	<div class="communautes">
		<h3>Communautés</h3>
		<?php if (!empty($communautes)): ?>
		
		<?php foreach ($communautes as $communaute): ?>
			
				<p><?php echo $communaute; ?></p>

				
		<?php endforeach; ?>
		
	<?php endif; ?>
	<div class='offre_signaler_abus'><?php echo $this->html->link('Signaler un abus', array('controller'=>'offres','action'=>'addAbus',$offre[0]['Offre']['offre_id'])); ?></div>



	<div class="actions">
		
			<p><?php echo $this->Html->link(__("Modifier l'offre"), array('action' => 'edit', $offre[0]['Offre']['offre_id'])); ?> </p>
			<p><?php echo $this->Form->postLink(__("Supprimer"), array('action' => 'delete', $offre[0]['Offre']['offre_id']), null, __("Etes-vous sûr de vouloir supprimer cette offre ?")); ?> </p>
		
	</div>
	<?php }
	elseif($statut==1){ ?>

	<div class="auteur">
		<h3><?php echo ("Auteur: ".$auteur["prenom"]." ".$auteur["nom"]); ?></h3>
	</div>

	<div class='offre_signaler_abus'><?php echo $this->html->link('Signaler un abus', array('controller'=>'offres','action'=>'addAbus',$offre[0]['Offre']['offre_id'])); ?></div>

	<?php } ?>


	<div class="catégorie">
		<h3><?php echo __('Categories'); ?></h3>
		<?php if (!empty($offre[0]['Category'])): ?>
		
		<?php foreach ($offre[0]['Category'] as $category): ?>
			
				<p><?php echo $category['nom']; ?></p>

				
		<?php endforeach; ?>

	<?php endif; ?>

		
	</div>


<?php } ?>