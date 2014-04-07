<h1>Créer une communauté</h1>

<?php
	echo $this->Form->create('Appartenance');
	echo $this->Form->input('Communaute.nom', array('label' => 'Nom'));
	echo $this->Form->input('Communaute.description' , array('label' => 'Description'));
	echo $this->Form->input('Adress.numero' , array('label' => 'N°'));
	echo $this->Form->input('Adress.rue' , array('label' => 'Rue'));
	echo $this->Form->input('Adress.code_postal' , array('label' => 'Code Postal'));
	echo $this->Form->input('Adress.ville' , array('label' => 'Ville'));
	
	echo $this->Form->end("Créer");

?>