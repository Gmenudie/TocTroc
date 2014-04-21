<?php echo $this->Html->css('style_posts'); ?>

<div>
	<h2>Signaler un abus</h2>

	<p>Vous souhaitez signaler le message suivant comme abusif:</p>


<div class="message_ensemble">
		
			<!--Message initial-->
			
			<div class="message">
			
				<div class='colonne_gauche'>

					<?php
				
					if(isset($post['Appartenance']['User']['image_profil']))
					{
						?>
						<div class='message_profil'>
							<?php echo $this->Html->link($this->Html->image('user/'.$post['Appartenance']['User']['user_id'].'/miniature.'.$post['Appartenance']['User']['image_profil'], array('alt' => 'Image de profil', 'class' => 'compte-image'))."<br/>".$post['Appartenance']['User']['prenom']."<br/>".$post['Appartenance']['User']['nom'], array('controller'=>'users','action'=>'profil', $post['Appartenance']['User']['user_id']),array('escape'=>false)); ?>
						</div>
						<?php
					}
					else
					{
						?>
						<div class='message_profil'>
							<?php echo $this->Html->link($this->Html->image('dessins/miniature.png', array('alt' => 'Image de profil', 'class' => 'compte-image'))."<br/>".$post['Appartenance']['User']['prenom']."<br/>".$post['Appartenance']['User']['nom'], array('controller'=>'users','action'=>'profil', $post['Appartenance']['User']['user_id']),array('escape'=>false)); ?>
						</div>
						<?php
					}?>
					
				</div>
				<div class='colonne_droite'>				
					<div class='message_date'><?php echo $post['Post']['created']; ?></div>
					<div class='message_contenu'><?php echo $post['Post']['contenu']; ?></div>
					
				</div>
				
				
			</div>
</div>



<div id="signaler_abus">

	<p>Vous pouvez préciser en quoi vous trouvez ce message abusif afin d'aider les modérateurs à agir:</p>
	
        <?php 
        echo $this->Form->create("AbusPost",array('url'=>array('controller'=>'posts','action'=>'addAbus',$post['Post']['post_id'])));
        echo $this->Form->input('explication', array('label' => '', 'placeholder'=>"Explication de l'abus", 'rows'=>'10'));
        echo $this->Form->hidden("post_id",array('default'=>$post['Post']['post_id']));
        echo $this->Form->end("Signaler abus");
        ?>
</div>