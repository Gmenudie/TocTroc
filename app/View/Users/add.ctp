<?php echo $this->Html->css('style_add'); ?>

<h1>S'inscrire</h1>

<div id="formAdd">
<?php
	echo $this->Form->create('User');
	echo $this->Form->input('prenom', array('label' => '', 'placeholder'=>'Prénom'));
	echo $this->Form->input('nom' , array('label' => '', 'placeholder'=>'Nom'));
	echo $this->Form->input('email' , array('label' => '', 'placeholder'=>'Email'));
	echo $this->Form->input('password' , array('label' => '', 'placeholder'=>'Mot de passe'));
	echo $this->Form->input('telephone_1' , array('label' => '', 'placeholder'=>'Téléphone'));
	echo $this->Form->input('telephone_2' , array('label' => '', 'placeholder'=>'Autre téléphone'));
	echo $this->Form->end("S'inscrire");
<<<<<<< HEAD
	
	
?>
=======
?>
</div>
>>>>>>> origin/bob
