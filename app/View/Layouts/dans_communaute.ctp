<!DOCTYPE html>
<html>
   <head>
       <meta charset="utf-8" />
   <?php echo $this->Html->css('style'); ?>
   <?php echo $this->Html->css('style_dans_communaute'); ?>
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
           
          array('controller' => 'offres', 'action' => "index"),
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
	<div id="barre_connexion">
		<div id="barre_connexion_contenu">
			<div id="informations_connexion">
			<?php echo("Bonjour ".AuthComponent::user('prenom').". ");
			//echo(" Vous êtes connecté à ".AuthComponent::communaute('nom')." ");
			echo $this->Html->link(_(' Changer de communaute'),array("controller"=>"communautes","action"=>"index"));
			echo $this->Html->link(_(' Se déconnecter'),array("controller"=>"users","action"=>"logout"));
			?>
			
		</div>
	</div>
</header>

<div id="fond">
	<div id="page">
	<?php echo $this->fetch('content'); ?>
		
	</div>
</div>


   </body>
</html>