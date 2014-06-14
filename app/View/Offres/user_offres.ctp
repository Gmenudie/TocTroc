<?php echo $this->Html->css('style_offre'); ?>

<h1>Mes offres</h1>

    <div id="poster_offre">
	
        <?php 
		
			echo $this->Form->create('Offre',array('url'=>array('controller'=>'offres','action'=>'add'))); 
			echo $this->Form->input('Offre.titre', array('label' => '', 'placeholder'=>'Titre'));
			echo $this->Form->input('Offre.description', array('label' => '', 'placeholder'=>'Description', 'rows'=>'10'));
			echo ("Publier l'annonce dans les communautés:");
			echo $this->Form->select('PublieOffre.appartenance_id', $appartenances, array('multiple'=>'checkbox'));
			echo $this->Form->input('Category',array('label'=>'Categorie'));
				
			echo $this->Form->end(__('Publier offre')); 
			
		?>
		
    </div>

	<div id="offres">
	<?php if ($offres!=null){?>
		<h2>Vos offres publi&eacute;es</h2>
		
			<?php foreach ($offres as $offre): ?>
		
		
			<div class="une_offre">
			
				<?php
				
				echo "<div class='colonne_droite'>";
				?>
				
					<div class="sous_titre_colonne_droite" style="margin-top:0px;">Description</div>
						
						<?php echo h($offre['Offre']['titre']); ?>
						<p> <?php echo h($offre['Offre']['description']); ?></p>	
						<p> <?php echo h($offre['Offre']['created']); ?></p>
						
										
					<div class="sous_titre_colonne_droite" style="margin-top:0px;">Actions</div>
					
						<?php
							
						echo 
							$this->Html->link(__('Voir'), array('action' => 'view', $offre['Offre']['offre_id'])) , " | " ,
							
							$this->Html->link(__('Modifier'), array('action' => 'edit', $offre['Offre']['offre_id'])), " | " ,

							$this->Form->postLink(__('Supprimer'), array('action' => 'delete', $offre['Offre']['offre_id']), null, __("Voulez-vous vraiment supprimer l'offre '%c?", $offre['Offre']['titre'])); 						
						
				echo "</div>";
				?>
				
			</div>
		
		<?php endforeach;?>	

	<?php 
	}else{
		echo("Vous n'avez pas encore publié d'offre");}
	?>

		</div>

	
	
<script>

	function afficher_poster() 
	{
		if (document.getElementById("Poster").style.display == "none") 
		{ 
			document.getElementById("Poster").style.display = "block";
		} 
		else
		{
			document.getElementById("Poster").style.display = "none";
		}
	}

	function ajuster_taille_colonnes_message()
	{
		var colonnes_gauche = document.getElementsByClassName("colonne_gauche");
		var colonnes_droite = document.getElementsByClassName("colonne_droite");
		for (var i=0 ; i<colonnes_gauche.length ; i++)
		{
			if(colonnes_gauche[i].offsetHeight<colonnes_droite[i].offsetHeight)
			{
				colonnes_gauche[i].style.height=colonnes_droite[i].offsetHeight-20+"px";
			}
		}
	}ajuster_taille_colonnes_message();
	
</script>