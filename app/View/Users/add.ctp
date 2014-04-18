<?php echo $this->Html->css('style_add'); ?>

<?php
	if(isset($ajout))
	{
?>
		<h1>S'inscrire</h1>
<?php
	}
	
	else
	{
?>
		<h1>Modifier vos informations</h1>
<?php
	}
?>

<div id="formAdd">
<?php

	echo $this->Form->create('User', array('type' => 'file'));
	echo $this->Form->input('upload_profil', array('label' => '', 'type' => 'file'));
	echo $this->Form->input('prenom', array('label' => '', 'placeholder'=>'Prénom'));
	echo $this->Form->input('nom' , array('label' => '', 'placeholder'=>'Nom'));
	echo $this->Form->input('email' , array('label' => '', 'placeholder'=>'Email'));	
	echo $this->Form->input('telephone_1' , array('label' => '', 'placeholder'=>'Téléphone'));
	echo $this->Form->input('telephone_2' , array('label' => '', 'placeholder'=>'Autre téléphone'));
	
	echo '<br/>';
	
	if(isset($ajout))
	{
		echo $this->Form->input('password_1' , array('label' => '', 'placeholder'=>'Mot de passe', 'type' => 'password'));
		echo $this->Form->input('password_2' , array('label' => '', 'placeholder'=>'Retapez votre mot de passe', 'type' => 'password'));
	}
	
	echo '<br/>';
	
	if(isset($ajout))
	{
		echo $this->Form->end("S'inscrire");
	}
	else
	{
		echo $this->Form->end("Modifier");
	}
	
	
?>
</div>
