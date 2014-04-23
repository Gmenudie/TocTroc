<?php echo $this->Html->css('style_profil'); ?>

<h1>Vos invitations envoyées</h1>

	<?php if ($invitationsEnvoyees!=null):
		foreach($invitationsEnvoyees as $invitE) : ?>
			<div class="carte_compte">

				<div class="colonne_gauche">
				
					<?php 
					
						if(isset($invitE['User']['image_profil'])) {
							echo $this->Html->image('user/'.$invitE['User']['user_id'].'/profil.'.$invitE['User']['image_profil'], array('alt' => 'Image de profil', 'class' => 'compte-image'));
							echo "<br/>";
						}
						else
						{
							echo "<img src='../../app/webroot/img/dessins/profil.png'/><br/>";
						}
					echo $invitE['User']['prenom']."<br/>";
					echo($invitE['User']['nom']);
					
					?>
					
				</div>
				
				<div class="colonne_droite">
					
					<div class="sous_titre_colonne_droite" style="margin-top:0px;">Ses informations de contact</div>
					
					<?php 
					
					echo $invitE['User']['email']."<br/>";
					echo $invitE['User']['telephone_1']."<br/>";
					echo $invitE['User']['telephone_2']; 
					
					?>
					
					<div class="sous_titre_colonne_droite">Son adresse</div>
					
					<?php 
					
					if(isset($invitE['User']['Adresse']['numero_appartement'])){echo "Appartement n°".$invitE['User']['Adresse']['numero_appartement'];}
					if(isset($invitE['User']['Adresse']['etage'])){echo " (Etage ".$invitE['User']['Adresse']['etage'].")<br/>";}
					if(isset($invitE['User']['Adresse']['numero'])){echo "n°".$invitE['User']['Adresse']['numero'].",<br/>";}
					if(isset($invitE['User']['Adresse']['rue'])){echo "Rue ".$invitE['User']['Adresse']['rue']."<br/>";}
					if(isset($invitE['User']['Adresse']['code_postal'])){echo $invitE['User']['Adresse']['code_postal']."<br/>";}
					if(isset($invitE['User']['Adresse']['ville'])){echo $invitE['User']['Adresse']['ville'];}
					
					?>					
				

					<div class="invitation">
						<?php

						echo ("Invité dans la communaut\eacute ".$invitE['Appartenance']['Communaute']['nom'].'. </br>');
						echo $this->Form->postLink(__("  Retirer l'invitation"), array('controller'=>'invitations','action'=>'delete',$invitE["Invitation"]['invitation_id']),null,__("Etes-vous sur de vouloir supprimer cette invitation?"));

						?>
					</div>
					
				</div>

			</div>
		<?php endforeach; ?>

	<?php else: ?>
		<p>Vous n'avez envoyé aucune invitation</p>
	<?php endif; ?>
		
		
<script>
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