<!DOCTYPE html>
<html>
   <head>
       <meta charset="utf-8" />
   <?php echo $this->Html->css('style'); ?>
       <title>TocTroc</title>
   </head>

   <body>
<header>
		<div id="banniere">
	<div id="logo">
	<?php echo $this->Html->link($this->Html->image('dessins/logo_toctroc.png', array('alt' => 'TocTroc Logo')), array('controller'=>'acceuils','action'=>'index'),array('escape'=>false)); ?>
	</div>
		<?php
     echo $this->Html->link(
           '<div class="carre_menu" id="menu1" href="emprunter.html">
            <div class="titre_carre_menu">Mur</div>
            <div class="symbole_carre_menu">
            </div>
            </div>',
          
          array('controller' => 'appartenances', 'action' => "index"),
          array('escape' => false) // Ceci pour indiquer de ne pas échapper les caractères HTML du lien vu qu'ici tu as des balises
     );

          echo $this->Html->link('

            <div class="carre_menu" id="menu2" href="proposer.html">
            <div class="titre_carre_menu">Proposer</div>
            <div class="symbole_carre_menu">
            </div>
            </div>',
           
          array('controller' => 'offres', 'action' => "index"),
          array('escape' => false) // Ceci pour indiquer de ne pas échapper les caractères HTML du lien vu qu'ici tu as des balises
     );

               echo $this->Html->link('

             <div class="carre_menu" id="menu3" href="demander.html">
             <div class="titre_carre_menu">Demander</div>
             <div class="symbole_carre_menu">
             </div>
             </div>',
          
          array('controller' => 'comingson', 'action' => "comingsoon"),
          array('escape' => false) // Ceci pour indiquer de ne pas échapper les caractères HTML du lien vu qu'ici tu as des balises
     );

                    echo $this->Html->link('

            <div class="carre_menu" id="menu4" href="moncompte.html">
            <div class="titre_carre_menu">Mon Compte</div>
            <div class="symbole_carre_menu">
            </div>
            </div>
            </div>',
          
          array('controller' => 'comingson', 'action' => "comingsoon"),
          array('escape' => false) // Ceci pour indiquer de ne pas échapper les caractères HTML du lien vu qu'ici tu as des balises
     );
     ?>
       

        
        
		
	<div id="user">
		<?php echo("Bonjour ".AuthComponent::user('prenom')." ".AuthComponent::user('nom')); ?>
		<?php echo $this->Html->link(_('Se déconnecter'),array("controller"=>"users","action"=>"logout"),array("class"=>'button'));?>
		
	</div>
</header>

<div id="fond">
	<div id="page">
	<?php echo $this->fetch('content'); ?>
		
	</div>
</div>


   </body>
</html>