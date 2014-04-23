<?php echo $this->Html->css('style_profil'); ?>

<h1>Invitations reçues</h1>

	<?php if ($invitationsRecues!=null):
		foreach($invitationsRecues as $invitR) : ?>
			<div class="carte_compte">

				<div class="colonne_gauche">
				
					<?php 
					
						if(isset($invitR['Appartenance']['User']['image_profil'])) {
							echo $this->Html->image('user/'.$invitR['Appartenance']['User']['user_id'].'/profil.'.$invitR['Appartenance']['User']['image_profil'], array('alt' => 'Image de profil', 'class' => 'compte-image'));
							echo "<br/>";
						}
						else
						{
							echo "<img src='../../app/webroot/img/dessins/profil.png'/><br/>";
						}
					echo $invitR['Appartenance']['User']['prenom']."<br/>";
					echo($invitR['Appartenance']['User']['nom']);
					
					?>
					
				</div>
				
				<div class="colonne_droite">
					
					<div class="sous_titre_colonne_droite" style="margin-top:0px;">Ses informations de contact</div>
					
					<?php 
					
					echo $invitR['Appartenance']['User']['email']."<br/>";
					echo $invitR['Appartenance']['User']['telephone_1']."<br/>";
					echo $invitR['Appartenance']['User']['telephone_2']; 
					
					?>
					
					<div class="sous_titre_colonne_droite">Son adresse</div>
					
					<?php 
					
					if(isset($invitR['Appartenance']['User']['Adresse']['numero_appartement'])){echo "Appartement n°".$invitR['Appartenance']['User']['Adresse']['numero_appartement'];}
					if(isset($invitR['Appartenance']['User']['Adresse']['etage'])){echo " (Etage ".$invitR['Appartenance']['User']['Adresse']['etage'].")<br/>";}
					if(isset($invitR['Appartenance']['User']['Adresse']['numero'])){echo "n°".$invitR['Appartenance']['User']['Adresse']['numero'].",<br/>";}
					if(isset($invitR['Appartenance']['User']['Adresse']['rue'])){echo "Rue ".$invitR['Appartenance']['User']['Adresse']['rue']."<br/>";}
					if(isset($invitR['Appartenance']['User']['Adresse']['code_postal'])){echo $invitR['Appartenance']['User']['Adresse']['code_postal']."<br/>";}
					if(isset($invitR['Appartenance']['User']['Adresse']['ville'])){echo $invitR['Appartenance']['User']['Adresse']['ville'];}
					
					?>					
				</div>

				<div class="invitation">
					<?php

					echo ("Vous a invité dans sa communauté ".$invitR['Appartenance']['Communaute']['nom']);
					echo $this->Form->postLink(__("Refuser l'invitation"), array('controller'=>'invitations','action'=>'delete',$invitR["Invitation"]['invitation_id']),null,__("Etes-vous sur de vouloir supprimer cette invitation?"));
					echo $this->Form->postLink(__("Accepter l'invitation"), array('controller'=>'invitations','action'=>'accepter',$invitR["Invitation"]['invitation_id']),null,__("Etes-vous sur de vouloir supprimer cette invitation?"));

					?>


			</div>
		<?php endforeach; ?>

	<?php else: ?>
		<p>Vous n'avez reçu aucune invitation</p>
	<?php endif; ?>
		