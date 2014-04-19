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
     echo $this->Html->link(
           '<div class="carre_menu" id="menu1">
            <div class="titre_carre_menu">Mur</div>
            <div class="symbole_carre_menu">
            </div>
            </div>',
          
          array('controller' => 'appartenances', 'action' => "index"),
          array('escape' => false) // Ceci pour indiquer de ne pas échapper les caractères HTML du lien vu qu'ici tu as des balises
     );

          echo $this->Html->link('

            <div class="carre_menu" id="menu2">
            <div class="titre_carre_menu">Proposer</div>
            <div class="symbole_carre_menu">
            </div>
            </div>',
           
          array('controller' => 'offres', 'action' => "mesOffres"),
          array('escape' => false) // Ceci pour indiquer de ne pas échapper les caractères HTML du lien vu qu'ici tu as des balises
     );

               echo $this->Html->link('

             <div class="carre_menu" id="menu3">
             <div class="titre_carre_menu">Demander</div>
             <div class="symbole_carre_menu">
             </div>
             </div>',
          
          array('controller' => 'comingson', 'action' => "comingsoon"),
          array('escape' => false) // Ceci pour indiquer de ne pas échapper les caractères HTML du lien vu qu'ici tu as des balises
     );

                    echo $this->Html->link('

            <div class="carre_menu" id="menu4">
            <div class="titre_carre_menu">Mon Compte</div>
            <div class="symbole_carre_menu">
            </div>
            </div>
            </div>',
          
          array('controller' => 'users', 'action' => "monCompte"),
          array('escape' => false) // Ceci pour indiquer de ne pas échapper les caractères HTML du lien vu qu'ici tu as des balises
     );
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