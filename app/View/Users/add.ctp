<h1>S'inscrire</h1>

<?php
	echo $this->Form->create('User');
	echo $this->Form->inputs(array('fieldset'=>false, 'prenom' => array('label' => 'Prénom')));
	echo $this->Form->inputs(array('fieldset'=>false, 'nom' => array('label' => 'Nom')));
	echo $this->Form->inputs(array('fieldset'=>false, 'email' => array('label' => 'Email')));
	echo $this->Form->inputs(array('fieldset'=>false, 'password' => array('label' => 'Mot de passe')));
	echo $this->Form->inputs(array('fieldset'=>false, 'telephone_1' => array('label' => 'Téléphone')));
	echo $this->Form->inputs(array('fieldset'=>false, 'telephone_2' => array('label' => 'Autre téléphone')));
	echo $this->Form->end("S'inscrire");
	
?>