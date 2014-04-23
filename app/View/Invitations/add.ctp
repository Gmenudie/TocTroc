<?php echo $this->Html->css('style_profil'); ?>

<h2>Inviter un ami</h2>


<div id="recherche_personne">
		<div  style="width: 400px; margin: auto;">
			<?php 
			echo $this->Form->create(false,array('url'=>array('controller'=>'invitations','action'=>'add')));
			echo ("Entrez l'adresse email de la personne que vous souhaitez inviter dans votre communauté");
			echo $this->Form->input('email', array('type'=>'email','label' => '','placeholder'=>"Email"));
			echo $this->Form->end("Rechercher");
			?>
		</div>
</div>

<?php if (isset($searched)): ?>
	<?php if ($user!=null) : ?>

		<?php 
		//On a trouvé un utilisateur, on affiche son profil	?>

		<div class='profil_signaler_abus'><?php echo $this->html->link('Signaler un abus', array('controller'=>'users','action'=>'addAbus',$user['User']['user_id'])); ?></div>

		<div class="carte_compte">

			<div class="colonne_gauche">
			
				<?php 
				
					if(isset($user['User']['image_profil'])) {
						echo $this->Html->image('user/'.$user['User']['user_id'].'/profil.'.$user['User']['image_profil'], array('alt' => 'Image de profil', 'class' => 'compte-image'));
						echo "<br/>";
					}
					else
					{
						echo "<img src='../../app/webroot/img/dessins/image_profil.png'/><br/>";
					}
				echo $user['User']['prenom']."<br/>";
				echo($user['User']['nom']);
				
				?>
				
			</div>
			
			<div class="colonne_droite">
				
				<div class="sous_titre_colonne_droite" style="margin-top:0px;">Ses informations de contact</div>
				
				<?php 
				
				echo $user['User']['email']."<br/>";
				echo $user['User']['telephone_1']."<br/>";
				echo $user['User']['telephone_2']; 
				
				?>
				
				<div class="sous_titre_colonne_droite">Son adresse</div>
				
				<?php 
				
				if(isset($user['Adresse']['numero_appartement'])){echo "Appartement n°".$user['Adresse']['numero_appartement'];}
				if(isset($user['Adresse']['etage'])){echo " (Etage ".$user['Adresse']['etage'].")<br/>";}
				if(isset($user['Adresse']['numero'])){echo "n°".$user['Adresse']['numero'].",<br/>";}
				if(isset($user['Adresse']['rue'])){echo "Rue ".$user['Adresse']['rue']."<br/>";}
				if(isset($user['Adresse']['code_postal'])){echo $user['Adresse']['code_postal']."<br/>";}
				if(isset($user['Adresse']['ville'])){echo $user['Adresse']['ville'];}
				
				?>
				
				
			</div>
		</div>

		<div style="width: 400px; margin:auto;">
			<?php
			//Et on propose de l'inviter
			echo('Inviter cet utilisateur');
			echo $this->Form->create('Invitation');
			echo $this->Form->select('appartenance_id', $appartenances, array('label'=>"Dans quelle communauté voulez-vous l'inviter?"));
			echo $this->Form->hidden('email', array('default'=>$user['User']['email']));
			echo $this->Form->end("Inviter");			
			?>
		</div>

	<?php else: ?>
		<p>Désolé, nous n'avons pas pu trouver cet utilisateur. Essayez avec un autre email.</p>
	<?php endif; ?>
<?php endif; ?>
