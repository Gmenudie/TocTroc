<?php echo $this->Html->css('style_appartenances'); ?>

<script>
function afficher_creer(element) 
{
	if (document.getElementById("creer_communaute").style.display == "none")
	{ 
		document.getElementById("creer_communaute").style.display = "block";
		element.innerHTML="- Ajouter une communaut&eacute; -";
	} 
	else 
	{
		document.getElementById("creer_communaute").style.display = "none";
		element.innerHTML="+ Ajouter une communaut&eacute; +";
	}
}
</script>

<h1>Vos communautés</h1>

		<?php if (isset($invitationsRecues) && $invitationsRecues!=0): ?>
		<div class="invitationsRecues">
			<?php
				echo('Vous avez reçu '.$invitationsRecues.' invitations!');
				echo $this->Html->link('Voir les invitations', array('controller'=>'invitations','action'=>'invitationsRecues'));
			?>
		</div>
		<?php endif; ?>
		


    <?php if ($appartenances != NULL){?>

		<?php foreach ($appartenances as $communaute): ?>
	   
		<div id="boite_communautes">
	   
		<?php
			echo $this->Html->link(
           '
				<div class="case_communaute_titre">'
						.$communaute['Communaute']['nom'].
				'</div>
				<div class="case_communaute_description">'
						.$communaute['Communaute']['description'].
				'</div>
			',
			array('controller'=>'posts','action' => 'index', $communaute['Appartenance']['appartenance_id']),
			array('escape' => false) // Ceci pour indiquer de ne pas échapper les caractères HTML du lien vu qu'ici tu as des balises
		);
		?>
		 
		</div>
		
        <?php endforeach; ?>

        <div id="inviter" >
    	<?php echo $this->Html->link('Inviter un ami', array('controller'=>'invitations', 'action'=>'add')); ?>
    	<?php 	if (isset ($invitationsEnvoyees) && $invitationsEnvoyees!=0):    			
    				echo('Vous avez envoyé '.$invitationsEnvoyees.' invitations');
    				echo $this->Html->link('G\$eacuterer mes invitations',array('controller'=>'invitations','action'=>'mesInvitations'));
    			endif;
    	?>

    	</div>
    <?php }

        else echo "Vous n'avez pas encore de communauté";
    ?>
	
	<div id="boite_creer">
		<div style="margin-top:20px;margin-bottom:15px;" onclick="afficher_creer(this);" id="ajouter"> 
			+ Ajouter une communaut&eacute; +
		</div>
		<div id="creer_communaute" style="display:none;">
			<?php
				echo $this->Form->create('Appartenance', array('url'=>array('controller'=>'appartenances','action'=>'add')));
				echo $this->Form->input('Communaute.nom', array('label' => '', 'placeholder'=>'Nom'));
				echo $this->Form->input('Adress.numero' , array('label' => '', 'placeholder'=>'N°'));
				echo $this->Form->input('Adress.rue' , array('label' => '', 'placeholder'=>'Voie'));
				echo $this->Form->input('Adress.code_postal' , array('label' => '', 'placeholder'=>'Code Postal'));
				echo $this->Form->input('Adress.ville' , array('label' => '', 'placeholder'=>'Ville'));
				echo $this->Form->input('Communaute.description' , array('label' => '', 'placeholder'=>'Description'));				
				echo $this->Form->end("Créer");
			?>
		</div>
	</div>




    <?php unset($appartenances); ?>

