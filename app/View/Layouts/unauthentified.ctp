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
	<?php echo $this->Html->image('dessins/logo_toctroc.png', array('alt' => 'TocTroc Logo')); ?>
	</div>
	
	</div>
	<div id="barre_connexion">
		<div id="barre_connexion_contenu">
			<?php echo $this->Session->flash('auth'); ?>
			<?php echo $this->Form->create('User',array('url'=>array('controller'=>'users','action'=>'login'))); ?>
			<?php 
				echo $this->Form->input('email', array('label'=>'', 'placeholder'=>'Email'));
				echo $this->Form->input('password', array('label'=>'', 'placeholder'=>'Mot de passe'));
				echo $this->Form->end(__('Se connecter')); 
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