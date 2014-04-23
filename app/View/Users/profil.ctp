<?php echo $this->Html->css('style_profil'); ?>

<h1>Profil de <?php echo $user['User']['prenom'].' '.$user['User']['nom']?> </h1>

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