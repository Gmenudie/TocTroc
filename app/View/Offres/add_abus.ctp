<div>
	<h2>Signaler un abus</h2>

	<p>Vous souhaitez signaler l'offre suivante comme abusive:</p>


<div class="offres view">
	<h2><?echo h($offre['Offre']['titre']); ?></h2>
		<dl>		
			<dt>Description</dt>
			<dd>
				<?php echo h($offre['Offre']['description']); ?>
				&nbsp;
			</dd>
			
			
			<dt><?php echo __('Date'); ?></dt>
			<dd>
				<?php echo h($offre['Offre']['created']); ?>
				&nbsp;
			</dd>
			
		</dl>
	</div>

	<div class="auteur">
		<h3><?php echo ("Auteur: ".$offre['PublieOffre'][0]['Appartenance']['User']["prenom"]." ".$offre['PublieOffre'][0]['Appartenance']['User']["nom"]); ?></h3>
	</div>

	
	
	<div class="catégorie">
		<h3><?php echo __('Categories'); ?></h3>
		<?php if (!empty($offre['Category'])): ?>
		
		<?php foreach ($offre['Category'] as $category): ?>
			
				<p><?php echo $category['nom']; ?></p>

				
		<?php endforeach; ?>

	<?php endif; ?>

		
	</div>



<div id="signaler_abus">

	<p>Vous pouvez préciser en quoi vous trouvez cette offre abusive afin d'aider les modérateurs à agir:</p>
	
        <?php 
        echo $this->Form->create("AbusOffre",array('url'=>array('controller'=>'offres','action'=>'addAbus',$offre['Offre']['offre_id'])));
        echo $this->Form->input('explication', array('label' => '', 'placeholder'=>"Explication de l'abus", 'rows'=>'10'));
        echo $this->Form->hidden("offre_id",array('default'=>$offre['Offre']['offre_id']));
        echo $this->Form->end("Signaler abus");
        ?>
</div>