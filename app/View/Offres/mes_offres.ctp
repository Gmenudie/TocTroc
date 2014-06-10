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
		
			<?php 
		
			echo $this->Paginator->sort('titre');
			echo $this->Paginator->sort('description');			
			echo $this->Paginator->sort('created'); 	
			echo __('Actions');
	
			foreach ($offres as $offre): 
			
			?>
		
			<!--Mon offre-->
			
			<div class="une_offre">
			
				<?php
				echo "<div class='colonne_gauche'>";
				
					if(isset($user['User']['image_profil']))
					{
						echo "<div class='message_profil'>".$this->Html->image('user/'.$user['User']['user_id'].'/miniature.'.$user['User']['image_profil'], array('alt' => 'Image de profil', 'class' => 'compte-image'))."<br/>".$user['User']['prenom']."<br/>".$user['User']['nom']."</div>";
					}
					else
					{
						echo "<div class='message_profil'>".$this->Html->image('dessins/image_profil.png', array('alt' => 'Image de profil', 'class' => 'compte-image')) . "<br/>" . $user['User']['prenom']."<br/>".$user['User']['nom']."</div>";
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
							
						echo $this->Html->link(__('Voir'), array('action' => 'view', $offre['Offre']['offre_id']));
						echo $this->Html->link(__('Modifier'), array('action' => 'edit', $offre['Offre']['offre_id'])); 
						echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $offre['Offre']['offre_id']), null, __("Voulez-vous vraiment supprimer l'offre '%c?", $offre['Offre']['titre'])); 

						
						
				echo "</div>";
				?>
				
			</div>
		
		<?php endforeach;?>
		
		
				<?php echo $this->Paginator->counter(array('format' => __('Page {:page} sur {:pages}')));	?>	
				
					<div class="paging">
					
						<?php
							echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
							echo $this->Paginator->numbers(array('separator' => ''));
							echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
						?>
					
					</div>
		
					<?php 
					}else{
						echo("Vous n'avez pas encore publié d'offre");}
					?>
	
		</div>
		
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