<?php echo $this->Html->css('style_search'); ?>

<div id="chercher_offre">

	<?php 

		//Le formulaire de recherche		
		echo $this->Form->create(false, array('url'=>array('controller'=>'offres','action'=>'search')));
		echo $this->Form->input('Nom' , array('label'=>'', 'label'=>'Nom'));
		echo $this->Form->select('appartenance_id', $appartenances, array('multiple'=>'checkbox','label'=>'Rechercher dans les communautés'));
		echo $this->Form->input('Category',array('label'=>'Catégorie','empty'=>'Toutes'));
		echo $this->Form->end(__('Rechercher')); 
	
	?>
		
</div>

<div id="resultats">

	<?php if (isset($offres)&&$offres!=null){ ?>
		
		<h2>Résultats</h2>
		
		<?php foreach ($offres as $offre): ?>
		
			<div class="un_resultat">
	
				<?php
					echo "<div class='colonne_gauche'>";
					
						if(isset($offre['User']['image_profil']))
						{
							echo "<div class='message_profil'>".$this->Html->image('user/'.$offre['User']['user_id'].'/miniature.'.$offre['User']['image_profil'], array('alt' => 'Image de profil', 'class' => 'compte-image'))."<br/>".$offre['User']['prenom']."<br/>".$offre['User']['nom']."</div>";
						}
						else
						{
							echo "<div class='message_profil'><img src='../../app/webroot/img/dessins/image_profil.png'/><br/>".$offre['User']['prenom']."<br/>".$offre['User']['nom']."</div>";
						}
						
					echo "</div>";
					echo "<div class='colonne_droite'>";
				?>
			
				<div class="sous_titre_colonne_droite" style="margin-top:0px;">Description</div>
					
				<?php
				
					echo h($offre['Offre']['titre']); 
					echo h($offre['Offre']['description']); 	
					echo h($offre['Offre']['created']);
				
				?>
				
				<div class="sous_titre_colonne_droite" style="margin-top:0px;">Actions</div>
				
				<?php
					
					echo $this->Html->link(__('Voir'), array('action' => 'view', $offre['Offre']['offre_id']))." | ";
					echo $this->Html->link(__('Modifier'), array('action' => 'edit', $offre['Offre']['offre_id']))." | "; 
					echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $offre['Offre']['offre_id']), null, __("Voulez-vous vraiment supprimer l'offre '%c?", $offre['Offre']['titre'])); 						
					echo "</div>";
				?>
			
		</div>
		
		<?php endforeach;?>
					
	<?php 
	}
	else if (isset($offres))
	{
		echo("Aucune offre ne correspond à votre recherche");
	}
	else
	{
		echo("Entrez le nom de l'offre que vous recherchez");
	}
	?>

</div>