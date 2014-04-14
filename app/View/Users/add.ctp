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
	
	if(isset($ajout))
	{
		echo $this->Form->input('password' , array('label' => '', 'placeholder'=>'Mot de passe'));
	}
	
	echo $this->Form->input('telephone_1' , array('label' => '', 'placeholder'=>'Téléphone'));
	echo $this->Form->input('telephone_2' , array('label' => '', 'placeholder'=>'Autre téléphone'));
	
	/* Champ caché contenant l'id s'il s'agit d'une modification */
	if(isset($ajout) == false)
	{
		echo $this->Form->input('user_id', array('type' => 'hidden'));
	}
	
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
