<?php echo $this->Html->css('style_profil'); ?>

<div>
	<h2>Signaler un abus</h2>

	<p>Vous souhaitez signaler le profil suivant comme abusif:</p>


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



<div id="signaler_abus">

	<p>Vous pouvez préciser en quoi vous trouvez ce profil abusif afin d'aider les modérateurs à agir:</p>
	
        <?php 
        echo $this->Form->create("AbusProfil",array('url'=>array('controller'=>'users','action'=>'addAbus',$user['User']['user_id'])));
        echo $this->Form->input('explication', array('label' => '', 'placeholder'=>"Explication de l'abus", 'rows'=>'10'));
        echo $this->Form->hidden("user_id",array('default'=>$user['User']['user_id']));
        echo $this->Form->end("Signaler abus");
        ?>
</div>