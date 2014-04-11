<h1>Mon Compte</h1>

<?php 
	if(isset($user[0]['User']['image_profil'])) {
		echo $this->Html->image('profil/'.$user[0]['User']['image_profil'], array('alt' => 'Image de profil', 'class' => 'compte-image'));
	}
?>
	
<table class="compte-perso">
	<tr>
		<td>Nom</td>
		<td><?php echo($user[0]['User']['prenom']); ?></td>
	</tr
	<tr>
		<td>Pr&eacute;nom</td>
		<td><?php echo($user[0]['User']['nom']); ?></td>
	</tr>
	<tr>
		<td>e-mail</td>
		<td><?php echo($user[0]['User']['email']); ?></td>
	</tr>
	<tr>
		<td>T&eacute;l&eacute;phone 1</td>
		<td><?php echo($user[0]['User']['telephone_1']); ?></td>
	</tr>
	<tr>
		<td>T&eacute;l&eacute;phone 2</td>
		<td><?php echo($user[0]['User']['telephone_2']); ?></td>
	</tr>
</table>

<table class="compte-adresse">
	<tr>
		<td>Num&eacute;ro</td>
		<td><?php echo($user[0]['Adresse']['numero']); ?></td>
	</tr
	<tr>
		<td>Rue</td>
		<td><?php echo($user[0]['Adresse']['rue']); ?></td>
	</tr>
	<tr>
		<td>Code Postal</td>
		<td><?php echo($user[0]['Adresse']['code_postal']); ?></td>
	</tr>
	<tr>
		<td>Ville</td>
		<td><?php echo($user[0]['Adresse']['ville']); ?></td>
	</tr>
	<tr>
		<td>&Eacute;tage</td>
		<td><?php echo($user[0]['Adresse']['etage']); ?></td>
	</tr>
	<tr>
		<td>Num&eacute;ro appartement</td>
		<td><?php echo($user[0]['Adresse']['numero_appartement']); ?></td>
	</tr>
</table>