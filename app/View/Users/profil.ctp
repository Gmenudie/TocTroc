<?php echo $this->Html->css('style_profil'); ?>

<h1>Profil de <?php echo $user['User']['prenom'].' '.$user['User']['nom']?> </h1>

<div class="carte_compte">

	<div class="colonne_gauche">
	
		<?php 
		
			if(isset($user[0]['User']['image_profil'])) {
				echo $this->Html->image('user/'.$user[0]['User']['user_id'].'/profil.'.$user[0]['User']['image_profil'], array('alt' => 'Image de profil', 'class' => 'compte-image'));
				echo "<br/>";
			}
			else
			{
				echo "<img src='../../app/webroot/img/dessins/image_profil.png'/><br/>";
			}
		echo $user[0]['User']['prenom']."<br/>";
		echo($user[0]['User']['nom']);
		
		?>
		
	</div>
	
	<div class="colonne_droite">
		
		<div class="sous_titre_colonne_droite" style="margin-top:0px;">Ses informations de contact</div>
		
		<?php 
		
		echo $user[0]['User']['email']."<br/>";
		echo $user[0]['User']['telephone_1']."<br/>";
		echo $user[0]['User']['telephone_2']; 
		
		?>
		
		<div class="sous_titre_colonne_droite">Son adresse</div>
		
		<?php 
		
		if(isset($user[0]['Adresse']['numero_appartement'])){echo "Appartement n°".$user[0]['Adresse']['numero_appartement'];}
		if(isset($user[0]['Adresse']['etage'])){echo " (Etage ".$user[0]['Adresse']['etage'].")<br/>";}
		if(isset($user[0]['Adresse']['numero'])){echo "n°".$user[0]['Adresse']['numero'].",<br/>";}
		if(isset($user[0]['Adresse']['rue'])){echo "Rue ".$user[0]['Adresse']['rue']."<br/>";}
		if(isset($user[0]['Adresse']['code_postal'])){echo $user[0]['Adresse']['code_postal']."<br/>";}
		if(isset($user[0]['Adresse']['ville'])){echo $user[0]['Adresse']['ville'];}
		
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