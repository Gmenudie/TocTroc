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
	<?php echo $this->Html->image('dessins/logo_toctroc.png', array('alt' => 'TocTroc Logo')); ?>
	<div id="wall">
	<p>Mur</p>
	</div>
	<div id="proposer">
	<p>Proposer</p>
	</div>
	<div id="demander">
	<p>Demander</p>
	</div>
	<div id="monCompte">
	<p>Mon compte</p>
	</div>
	<div> <?php echo $this->Html->link("Se déconnecter", array('controller' => 'users', 'action' => 'logout')); ?> </div>
	</div>
</header>

	<?php echo $this->fetch('content'); ?>
	


   </body>
</html>