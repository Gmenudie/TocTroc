<?php echo $this->Html->css('style_posts'); ?>



<h1><?php echo($nomCommunaute); ?> - Le Mur</h1>



    <div id="poster_message">
	
        <?php 
        echo $this->Form->create("Post",array('url'=>array('controller'=>'posts','action'=>'add')));
        echo $this->Form->input('contenu', array('label' => '', 'placeholder'=>'Entrez votre message', 'rows'=>'10'));
        echo $this->Form->hidden("appartenance_id",array('default'=>$user));
        echo $this->Form->hidden("canal_id",array('default'=>1));
        echo $this->Form->end("Poster");
        ?>
		
    </div>
	
	
	

	<div id="messages">
	
		<?php foreach ($posts as $post): ?>

		<div class="message_ensemble">
		
			<!--Message initial-->
			
			<div class="message">
			
				<?php
				echo "<div class='colonne_gauche'>";
				
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
						<div class='message_profil>
							<?php echo $this->Html->link($this->Html->image('dessins/miniature.png', array('alt' => 'Image de profil', 'class' => 'compte-image'))."<br/>".$post['Post']['User']['prenom']."<br/>".$post['Post']['User']['nom'], array('controller'=>'users','action'=>'profil', $post['Post']['User']['user_id']),array('escape'=>false)); ?>
						</div>
						<?php
					}
					
				echo "</div>";
				echo "<div class='colonne_droite'>";
				
					echo "<div class='message_date'>".$post['Post']['created']."</div>";
					echo "<div class='message_contenu'>".$post['Post']['contenu']."</div>"; 
					
				echo "</div>";
				?>
				
			</div>
			
			
			
			<!--Commentaires aux messages-->
			
			<?php 
			
			if(array_key_exists("Commentaires", $post)){

				foreach ($post["Commentaires"] as $com){

					echo "<div class='commentaire_message'>";
					
						echo "<div class='colonne_gauche'>";
					
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
						<div class='message_profil>
							<?php echo $this->Html->link($this->Html->image('dessins/miniature.png', array('alt' => 'Image de profil', 'class' => 'compte-image'))."<br/>".$post['Post']['User']['prenom']."<br/>".$post['Post']['User']['nom'], array('controller'=>'users','action'=>'profil', $post['Post']['User']['user_id']),array('escape'=>false)); ?>
						</div>
						<?php
					}							
						echo "</div>";
						
						echo "<div class='colonne_droite'>";
				
							echo "<div class='commentaire_date'>".$com['created']."</div>";
							echo "<div class='commentaire_contenu'>".$com['contenu']."</div>"; 
							
						echo "</div>";
					
					echo "</div>";
					
				}
				
			}
			?>
			
			
			<!--Formulaire pour ajouter un commentaire-->
			
			<div class="formulaire_commentaire">

				<?php 
				
				echo $this->Form->create("Commentaire",array('url'=> array('controller'=>'commentaires','action'=>'add')));
				
				echo $this->Form->input('contenu', array('label' => '', 'placeholder'=>'Ecrire votre commentaire', 'rows'=>'2'));
				echo $this->Form->hidden('appartenance_id',array('default'=>$post["Post"]["communaute_id"]));
				echo $this->Form->hidden('post_id',array('default'=>$post["Post"]["post_id"]));        
				echo $this->Form->end("Commenter");
				
				?>
			
			</div>       
			
		
		<?php endforeach;?>
		
	</div>
	
	

    <!--<?php echo $this->Html->link('Voir plus', array('controller'=>'posts','action'=>'index', $user, sizeof($posts)+10));?>
    <?php unset($post); ?>-->
	
	
	
	
	
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