<?php echo $this->Html->css('style_posts'); ?>

<div>
	<h2>Signaler un abus</h2>

	<p>Vous souhaitez signaler le commentaire suivant comme abusif:</p>


<div class='commentaire_message'>
					
						<div class='colonne_gauche'>

						<?php						
						if(isset($commentaire['Appartenance']['User']['image_profil']))
						{
							?>
							<div class='message_profil'>
								<?php echo $this->Html->link($this->Html->image(
									'user/'.$commentaire['Appartenance']['User']['user_id'].'/miniature.'.$commentaire['Appartenance']['User']['image_profil'],	array(
										'alt' => 'Image de profil', 
										'class' => 'compte-image')).
										"<br/>".$commentaire['Appartenance']['User']['prenom']."<br/>".$commentaire['Appartenance']['User']['nom'],
										 array('controller'=>'users','action'=>'profil', $commentaire['Appartenance']['User']['user_id']),
										 array('escape'=>false)); ?>
							</div>
							<?php
						}
						else
						{
							?>
							<div class='message_profil'>
								<?php echo $this->Html->link($this->Html->image('dessins/miniature.png', array('alt' => 'Image de profil', 'class' => 'compte-image'))."<br/>".$commentaire['Appartenance']['User']['prenom']."<br/>".$commentaire['Appartenance']['User']['nom'], array('controller'=>'users','action'=>'profil', $commentaire['Appartenance']['User']['user_id']),array('escape'=>false)); ?>
							</div>
							<?php
						}	?>						
						</div>
							
							<div class='colonne_droite'>
					
								<div class='commentaire_date'><?php echo $commentaire['Commentaire']['created']; ?></div>
								<div class='commentaire_contenu'><?php echo $commentaire['Commentaire']['contenu']; ?></div> 
								
							</div>

												
</div>



<div id="signaler_abus">

	<p>Vous pouvez préciser en quoi vous trouvez ce commentaire abusif afin d'aider les modérateurs à agir:</p>
	
        <?php 
        echo $this->Form->create("AbusCommentaire",array('url'=>array('controller'=>'commentaires','action'=>'addAbus',$commentaire['Commentaire']['commentaire_id'])));
        echo $this->Form->input('explication', array('label' => '', 'placeholder'=>"Explication de l'abus", 'rows'=>'10'));
        echo $this->Form->hidden("commentaire_id",array('default'=>$commentaire['Commentaire']['commentaire_id']));
        echo $this->Form->end("Signaler abus");
        ?>
</div>