<h1>Modification de mot de passe</h1>

<div id="formChangerMotdePasse" style="width: 400px; margin: auto;">
<?php
	echo $this->Form->create('User');
	
	echo $this->Form->input('password_1' , array('label' => '', 'placeholder'=>'Mot de passe', 'type' => 'password'));
	echo $this->Form->input('password_2' , array('label' => '', 'placeholder'=>'Retapez votre mot de passe', 'type' => 'password'));
	

	
	echo '<br/>';
	
	echo $this->Form->end("Modifier");

	
	
?>
</div>
