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
	<?php echo $this->Html->image("dessins/logo_toctroc.png", array('alt' => 'TocTroc Logo')); ?>
	</div>
		<div class="carre_menu" id="menu1" href="emprunter.html">
            <div class="titre_carre_menu">Mur</div>
        </div>
        <div class="carre_menu" id="menu2" href="proposer.html">
            <div class="titre_carre_menu">Proposer</div>
        </div>
        <div class="carre_menu" id="menu3" href="demander.html">
            <div class="titre_carre_menu">Demander</div>
        </div>
		<?php 
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
			<div id="informations_connexion">
			<?php echo("Bonjour ".AuthComponent::user('prenom')." ");
			echo $this->Html->link(_(' Se déconnecter'),array("controller"=>"users","action"=>"logout"));?>
			
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