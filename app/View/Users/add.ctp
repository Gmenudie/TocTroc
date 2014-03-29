<h1>S'inscrire</h1>

<?php
	echo $this->Form->create('User');
	echo $this->Form->input('prenom', array('label' => 'Prénom'));
	echo $this->Form->input('nom' , array('label' => 'Nom'));
	echo $this->Form->input('email' , array('label' => 'Email'));
	echo $this->Form->input('password' , array('label' => 'Mot de passe'));
	echo $this->Form->input('telephone_1' , array('label' => 'Téléphone'));
	echo $this->Form->input('telephone_2' , array('label' => 'Autre téléphone'));
	echo $this->Form->end("S'inscrire");
	
?>