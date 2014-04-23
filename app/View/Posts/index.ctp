<?php echo $this->Html->css('style_posts'); ?>


<h1><?php echo($nomCommunaute['Communaute']['nom']); ?> - Le Mur</h1>


	<?php //L'admin ne poste pas de messages
		if($role==3 || $role==2)
		{?>

			<div id="poster_message">
			
				<?php 
				echo $this->Form->create("Post",array('url'=>array('controller'=>'posts','action'=>'add')));
				echo $this->Form->input('contenu', array('label' => '', 'placeholder'=>'Entrez votre message', 'rows'=>'10'));
				echo $this->Form->hidden("appartenance_id",array('default'=>$user));
				echo $this->Form->hidden("canal_id",array('default'=>1));
				echo $this->Form->end("Poster");
				?>
				
			</div>
		<?php
		}
		?>
		

	<div id="messages">
	
		<?php foreach ($posts as $post): ?>

		<div class="message_ensemble">
		
			<!--Message initial-->
			
			<div class="message">
			
				<div class='colonne_gauche'>

					<?php
				
					if(isset($post['Post']['User']['image_profil']))
					{
						?>
						<div class='message_profil'>
							<?php echo $this->Html->link($this->Html->image('user/'.$post['Post']['User']['user_id'].'/miniature.'.$post['Post']['User']['image_profil'], array('alt' => 'Image de profil', 'class' => 'compte-image'))."<br/>".$post['Post']['User']['prenom']."<br/>".$post['Post']['User']['nom'], array('controller'=>'users','action'=>'profil', $post['Post']['User']['user_id']),array('escape'=>false)); ?>
						</div>
						<?php
					}
					else
					{
						?>
						<div class='message_profil'>
							<?php echo $this->Html->link($this->Html->image('dessins/miniature.png', array('alt' => 'Image de profil', 'class' => 'compte-image'))."<br/>".$post['Post']['User']['prenom']."<br/>".$post['Post']['User']['nom'], array('controller'=>'users','action'=>'profil', $post['Post']['User']['user_id']),array('escape'=>false)); ?>
						</div>
						<?php
					}?>
					
				</div>
				<div class='colonne_droite'>				
					<div class='message_date'><?php echo $post['Post']['created']; ?></div>
					<div class='message_contenu'><?php echo $post['Post']['contenu']; ?></div>
					<div class='message_signaler_abus'><?php echo $this->html->link('Signaler un abus', array('controller'=>'posts','action'=>'addAbus',$post['Post']['post_id'])); ?></div>
					
				</div>
				
				
			</div>

			<?php //Un admin peut supprimer un post
		  	if($role==1): ?>
			<div class="adminaction">
				<?php echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $post['Post']['post_id']), null, __("Voulez-vous vraiment supprimer le post '%c?", $post['Post']['post_id'])); ?>
			</div>
			<?php endif; ?>
			
			
			
			<!--Commentaires aux messages-->
			
			<?php 
			
			if(array_key_exists("Commentaires", $post)){

				foreach ($post["Commentaires"] as $com){ ?>

					<div class='commentaire_message'>
					
						<div class='colonne_gauche'>

						<?php						
						if(isset($com['User']['image_profil']))
						{
							?>
							<div class='message_profil'>
								<?php echo $this->Html->link($this->Html->image(
									'user/'.$com['User']['user_id'].'/miniature.'.$com['User']['image_profil'],	array(
										'alt' => 'Image de profil', 
										'class' => 'compte-image')).
										"<br/>".$com['User']['prenom']."<br/>".$com['User']['nom'],
										 array('controller'=>'users','action'=>'profil', $com['User']['user_id']),
										 array('escape'=>false)); ?>
							</div>
							<?php
						}
						else
						{
							?>
							<div class='message_profil'>
								<?php echo $this->Html->link($this->Html->image('dessins/miniature.png', array('alt' => 'Image de profil', 'class' => 'compte-image'))."<br/>".$com['User']['prenom']."<br/>".$com['User']['nom'], array('controller'=>'users','action'=>'profil', $com['User']['user_id']),array('escape'=>false)); ?>
							</div>
							<?php
						}	?>						
						</div>
							
							<div class='colonne_droite'>
					
								<div class='commentaire_date'><?php echo $com['created']; ?></div>
								<div class='commentaire_contenu'><?php echo $com['contenu']; ?></div>
								<div class='message_signaler_abus'><?php echo $this->html->link('Signaler un abus', array('controller'=>'commentaires','action'=>'addAbus',$com['commentaire_id'])); ?></div>
								
							</div>

							<?php //Un admin peut supprimer un post
						  	if($role==1): 
						  		?>

							<div class="adminaction">
								<?php echo $this->Form->postLink(__('Supprimer'), array('controller'=>'commentaires','action' => 'delete', $com['commentaire_id']), null, __("Voulez-vous vraiment supprimer le com '%c?", $com['commentaire_id'])); ?>
							</div>

							<?php endif; ?>
					
					</div>
						<?php
					
				}
				
			}
			?>
			
			
			<!--Formulaire pour ajouter un commentaire-->

			<?php //L'admin ne poste pas de commentaire
		  	if($role==3 || $role==2): ?>
			
			<div class="formulaire_commentaire">
				<?php 				
				echo $this->Form->create("Commentaire",array('url'=> array('controller'=>'commentaires','action'=>'add')));
				echo $this->Form->input('contenu', array('label' => '', 'placeholder'=>'Ecrire votre commentaire', 'rows'=>'2'));
				echo $this->Form->hidden('appartenance_id',array('default'=>$post["Post"]["communaute_id"]));
				echo $this->Form->hidden('post_id',array('default'=>$post["Post"]["post_id"]));        
				echo $this->Form->end("Commenter");				
				?>			
			</div> 

			<?php endif; ?>      
			
		
		<?php endforeach;?>
		
	</div>
	
	

    <?php echo $this->Html->link('Voir plus', array('controller'=>'posts','action'=>'index', $user, sizeof($posts)+10));?>
    <?php unset($post); ?>
	
	
	
	
	
<script>

	function afficher_poster() 
	{
		if (document.getElementById("Poster").style.display == "none") 
		{ 
			document.getElementById("Poster").style.display = "block";
		} 
		else
		{
			document.getElementById("Poster").style.display = "none";
		}
	}

	function ajuster_taille_colonnes_message()
	{
		var colonnes_gauche = document.getElementsByClassName("colonne_gauche");
		var colonnes_droite = document.getElementsByClassName("colonne_droite");
		for (var i=0 ; i<colonnes_gauche.length ; i++)
		{
			if(colonnes_gauche[i].offsetHeight<colonnes_droite[i].offsetHeight)
			{
				colonnes_gauche[i].style.height=colonnes_droite[i].offsetHeight-20+"px";
			}
		}
	}ajuster_taille_colonnes_message();
	
</script>