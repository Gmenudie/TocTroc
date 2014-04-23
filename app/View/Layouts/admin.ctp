<!DOCTYPE html>
<html>
   <head>
       <meta charset="utf-8" />
   <?php echo $this->Html->css('style'); ?>
   <?php echo $this->Html->css('style_connecte'); ?>
       <title>TocTroc</title>
   </head>

   <body>
<header>
		<div id="banniere">
	<div id="logo">
	<?php echo $this->Html->link($this->Html->image('dessins/logo_toctroc.png', array('alt' => 'TocTroc Logo')), array('controller'=>'appartenances','action'=>'index'),array('escape'=>false)); ?>
	</div>
	
	<?php
      echo $this->Html->link('Communautes', array('controller' => 'communautes', 'action' => "getall"));
      echo $this->Html->link('Utilisateurs',array('controller' => 'users', 'action' => "getall"));
      echo $this->Html->link('Offres',array('controller' => 'offres', 'action' => "getall"));
      echo $this->Html->link('Adresses', array('controller' => 'adresses', 'action' => "getall"));
      echo $this->Html->link('Appartenance',array('controller' => 'appartenances', 'action' => "getall"));
      echo $this->Html->link('Posts',array('controller' => 'posts', 'action' => "getall"));
      echo $this->Html->link('Commentaires', array('controller' => 'commentaires', 'action' => "getall"));
  ?>
          


	 
	</div>
	<div id="barre_connexion">
		<div id="barre_connexion_contenu">
			<div id="informations_user">
				<?php echo('Bonjour '.AuthComponent::user('prenom').' '); ?>
				
			</div>	
					<?php
					if(AuthComponent::user('image_profil') !== null)
					{
						echo $this->Html->image('user/'.AuthComponent::user('user_id').'/miniature.'.AuthComponent::user('image_profil'), array('alt' => 'Image de profil', 'class' => 'compte-image'));
					}
					else
					{
						echo $this->Html->image('dessins/image_profil_miniature.png');
					}
					?>
				
			
			<div id="logout">
				<?php
				echo $this->Html->link(_(' Se déconnecter'),array("controller"=>"users","action"=>"logout"));?>
			</div>
		</div>
	</div>
</header>

<div id="fond">
	<div id="page">
	<?php echo $this->fetch('content'); ?>
		
	</div>
</div>

<footer>
	Mur | Proposer | Demander | Mon Compte
	<br/>
	Signaler un abus | Contact | Mentions légales
</footer>


<script>
	function ajuster_hauteur_pied() {
		//on retire à la taille de l'écran toutes le tailles des header et padding
		var taille_page = window.innerHeight - 330;
		document.getElementById('page').style.minHeight = taille_page+"px";
	}ajuster_hauteur_pied();
</script>

   </body>
</html>