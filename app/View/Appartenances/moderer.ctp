<div>
	<h2>Modérer les communautés</h2>
	<?php foreach($communautes as $communaute): ?>

	<h3>Communauté <?php echo $communaute['nom'] ?></h3>


	<!-- Partie Posts -->
	<?php if(null!=$communaute['Posts']): ?>
	<h4>Gérer les posts abusifs</h4>
	<?php echo $this->Html->css('style_posts'); ?>

	<?php foreach($communaute['Posts'] as $post): ?>

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

		<h4>Abus reportés pour ce post:</h4>
		<?php foreach($post['AbusPost'] as $abuspost): ?>

			<div class='abus'>
				<div class="message">
					
						<div class='colonne_gauche'>

							<?php
						
							if(isset($abuspost['Appartenance']['User']['image_profil']))
							{
								?>
								<div class='message_profil'>
									<?php echo $this->Html->link($this->Html->image('user/'.$abuspost['Appartenance']['User']['user_id'].'/miniature.'.$abuspost['Appartenance']['User']['image_profil'], array('alt' => 'Image de profil', 'class' => 'compte-image'))."<br/>".$abuspost['Appartenance']['User']['prenom']."<br/>".$abuspost['Appartenance']['User']['nom'], array('controller'=>'users','action'=>'profil', $abuspost['Appartenance']['User']['user_id']),array('escape'=>false)); ?>
								</div>
								<?php
							}
							else
							{
								?>
								<div class='message_profil'>
									<?php echo $this->Html->link($this->Html->image('dessins/miniature.png', array('alt' => 'Image de profil', 'class' => 'compte-image'))."<br/>".$abuspost['Appartenance']['User']['prenom']."<br/>".$abuspost['Appartenance']['User']['nom'], array('controller'=>'users','action'=>'profil', $abuspost['Appartenance']['User']['user_id']),array('escape'=>false)); ?>
								</div>
								<?php
							}?>
							
						</div>
						<div class='colonne_droite'>				
							<div class='message_contenu'><?php echo $abuspost['explication']; ?></div>
							
						</div>				
				</div>
			</div>
		<?php endforeach; ?>

		<?php echo $this->Form->postLink(('Confirmer Abus'), array('controller'=>'posts','action' => 'confirmerAbus', $post['Post']['post_id']), null, __('Souhaitez-vous vraiment retirer ce post?')); ?>
		<?php echo $this->Form->postLink(("Ce n'est pas abusif"), array('controller'=>'posts','action' => 'retirerAbus', $post['Post']['post_id'])); ?>


		<?php endforeach; ?>
	<?php endif; ?>


		<!-- Partie Commentaires -->
		<?php if(null!=$communaute['Commentaires']): ?>
		<h4>Gérer les commentaires abusifs</h4>
		<?php echo $this->Html->css('style_posts'); ?>
		<?php foreach($communaute['Commentaires'] as $commentaire): ?>

			<div class="message_ensemble">

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
			</div>

			<h4>Abus signalés pour ce commentaire</h4>
			<?php foreach($commentaire['AbusCommentaire'] as $abuscommentaire): ?>

				<div class='abus'>
					<div class="message">
						
							<div class='colonne_gauche'>

								<?php
							
								if(isset($abuscommentaire['Appartenance']['User']['image_profil']))
								{
									?>
									<div class='message_profil'>
										<?php echo $this->Html->link($this->Html->image('user/'.$abuscommentaire['Appartenance']['User']['user_id'].'/miniature.'.$abuscommentaire['Appartenance']['User']['image_profil'], array('alt' => 'Image de profil', 'class' => 'compte-image'))."<br/>".$abuscommentaire['Appartenance']['User']['prenom']."<br/>".$abuscommentaire['Appartenance']['User']['nom'], array('controller'=>'users','action'=>'profil', $abuscommentaire['Appartenance']['User']['user_id']),array('escape'=>false)); ?>
									</div>
									<?php
								}
								else
								{
									?>
									<div class='message_profil'>
										<?php echo $this->Html->link($this->Html->image('dessins/miniature.png', array('alt' => 'Image de profil', 'class' => 'compte-image'))."<br/>".$abuscommentaire['Appartenance']['User']['prenom']."<br/>".$abuscommentaire['Appartenance']['User']['nom'], array('controller'=>'users','action'=>'profil', $abuscommentaire['Appartenance']['User']['user_id']),array('escape'=>false)); ?>
									</div>
									<?php
								}?>
								
							</div>
							<div class='colonne_droite'>				
								<div class='message_contenu'><?php echo $abuscommentaire['explication']; ?></div>
								
							</div>				
					</div>

					
				</div>
			<?php endforeach; ?>
			
			<?php echo $this->Form->postLink(('Confirmer Abus'), array('controller'=>'commentaires','action' => 'confirmerAbus', $commentaire['Commentaire']['commentaire_id']), null, __('Souhaitez-vous vraiment retirer ce commentaire?' )); ?>
			<?php echo $this->Form->postLink(("Ce n'est pas abusif"), array('controller'=>'commentaires','action' => 'retirerAbus', $commentaire['Commentaire']['commentaire_id'])); ?>
		
		<?php endforeach; ?>
		<?php endif; ?>

		
		<!-- Partie Offres -->
		<?php if(null!=$communaute['Offres']): ?>
		<h4>Gérer les offres abusives</h4>
		<?php echo $this->Html->css('style_posts'); ?>
		<?php foreach($communaute['Offres'] as $offre): ?>

		<div class="message_ensemble">
			
				<!--Message initial-->
				
				<div class="message">
				
					<div class='colonne_gauche'>

						<?php
					
						if(isset($offre['PublieOffre'][0]['Appartenance']['User']['image_profil']))
						{
							?>
							<div class='message_profil'>
								<?php echo $this->Html->link($this->Html->image('user/'.$offre['PublieOffre'][0]['Appartenance']['User']['user_id'].'/miniature.'.$offre['PublieOffre'][0]['Appartenance']['User']['image_profil'], array('alt' => 'Image de profil', 'class' => 'compte-image'))."<br/>".$offre['PublieOffre'][0]['Appartenance']['User']['prenom']."<br/>".$offre['PublieOffre'][0]['Appartenance']['User']['nom'], array('controller'=>'users','action'=>'profil', $offre['PublieOffre'][0]['Appartenance']['User']['user_id']),array('escape'=>false)); ?>
							</div>
							<?php
						}
						else
						{
							?>
							<div class='message_profil'>
								<?php echo $this->Html->link($this->Html->image('dessins/miniature.png', array('alt' => 'Image de profil', 'class' => 'compte-image'))."<br/>".$offre['PublieOffre'][0]['Appartenance']['User']['prenom']."<br/>".$offre['PublieOffre'][0]['Appartenance']['User']['nom'], array('controller'=>'users','action'=>'profil', $offre['PublieOffre'][0]['Appartenance']['User']['user_id']),array('escape'=>false)); ?>
							</div>
							<?php
						}?>
						
					</div>
					<div class='colonne_droite'>				
						<div class='message_date'><?php echo $offre['Offre']['created']; ?></div>
						<div class='message_contenu'><?php echo $offre['Offre']['description']; ?></div>
						<div class="catégorie">
							<h3><?php echo __('Categories'); ?></h3>
							<?php if (!empty($offre['Category'])): ?>
							
							<?php foreach ($offre['Category'] as $category): ?>					
									<p><?php echo $category['nom']; ?></p>				
							<?php endforeach; ?>
							<?php endif; ?>
						</div>

						
					</div>				
				</div>
		</div>
		<h4>Abus signalés pour cette offre</h4>
			<?php foreach($offre['AbusOffre'] as $abusoffre): ?>

				<div class='abus'>
					<div class="message">
						
							<div class='colonne_gauche'>

								<?php
							
								if(isset($abusoffre['Appartenance']['User']['image_profil']))
								{
									?>
									<div class='message_profil'>
										<?php echo $this->Html->link($this->Html->image('user/'.$abusoffre['Appartenance']['User']['user_id'].'/miniature.'.$abusoffre['Appartenance']['User']['image_profil'], array('alt' => 'Image de profil', 'class' => 'compte-image'))."<br/>".$abusoffre['Appartenance']['User']['prenom']."<br/>".$abusoffre['Appartenance']['User']['nom'], array('controller'=>'users','action'=>'profil', $abusoffre['Appartenance']['User']['user_id']),array('escape'=>false)); ?>
									</div>
									<?php
								}
								else
								{
									?>
									<div class='message_profil'>
										<?php echo $this->Html->link($this->Html->image('dessins/miniature.png', array('alt' => 'Image de profil', 'class' => 'compte-image'))."<br/>".$abusoffre['Appartenance']['User']['prenom']."<br/>".$abusoffre['Appartenance']['User']['nom'], array('controller'=>'users','action'=>'profil', $abusoffre['Appartenance']['User']['user_id']),array('escape'=>false)); ?>
									</div>
									<?php
								}?>
								
							</div>
							<div class='colonne_droite'>				
								<div class='message_contenu'><?php echo $abusoffre['explication']; ?></div>
								
							</div>				
					</div>
				</div>
			<?php endforeach; ?>

			<?php echo $this->Form->postLink(('Confirmer Abus'), array('controller'=>'offres','action' => 'confirmerAbus', $offre['Offre']['offre_id']), null, __('Souhaitez-vous vraiment retirer cette offre?' )); ?>
			<?php echo $this->Form->postLink(("Ce n'est pas abusif"), array('controller'=>'offres','action' => 'retirerAbus', $offre['Offre']['offre_id'])); ?>

		<?php endforeach; ?>
		<?php endif; ?>



		<!-- Partie Profils -->
		<?php if(null!=$communaute['Users']): ?>
		<?php echo $this->Html->css('style_profil'); ?>
		<h4>Gérer les profils abusifs</h4>
		<?php foreach($communaute['Users'] as $user): ?>

			<div class="carte_compte">

				<div class="colonne_gauche">
				
					<?php 
					
						if(isset($user['User']['image_profil'])) {
							echo $this->Html->image('user/'.$user['User']['user_id'].'/profil.'.$user['User']['image_profil'], array('alt' => 'Image de profil', 'class' => 'compte-image'));
							echo "<br/>";
						}
						else
						{
							echo "<img src='../../app/webroot/img/dessins/image_profil.png'/><br/>";
						}
					echo $user['User']['prenom']."<br/>";
					echo($user['User']['nom']);
					
					?>
					
				</div>
				
				<div class="colonne_droite">
					
					<div class="sous_titre_colonne_droite" style="margin-top:0px;">Ses informations de contact</div>
					
					<?php 
					
					echo $user['User']['email']."<br/>";
					echo $user['User']['telephone_1']."<br/>";
					echo $user['User']['telephone_2']; 
					
					?>
					
					<div class="sous_titre_colonne_droite">Son adresse</div>
					
					<?php 
					
					if(isset($user['Adresse']['numero_appartement'])){echo "Appartement n°".$user['Adresse']['numero_appartement'];}
					if(isset($user['Adresse']['etage'])){echo " (Etage ".$user['Adresse']['etage'].")<br/>";}
					if(isset($user['Adresse']['numero'])){echo "n°".$user['Adresse']['numero'].",<br/>";}
					if(isset($user['Adresse']['rue'])){echo "Rue ".$user['Adresse']['rue']."<br/>";}
					if(isset($user['Adresse']['code_postal'])){echo $user['Adresse']['code_postal']."<br/>";}
					if(isset($user['Adresse']['ville'])){echo $user['Adresse']['ville'];}
					
					?>
					
					
				</div>


			</div>

				
			<script>

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


		<h4>Abus signalés pour cet profil</h4>
			<?php foreach($user['AbusProfil'] as $abususer): ?>

				<div class='abus'>
					<div class="message">
						
							<div class='colonne_gauche'>

								<?php
							
								if(isset($abususer['Appartenance']['User']['image_profil']))
								{
									?>
									<div class='message_profil'>
										<?php echo $this->Html->link($this->Html->image('user/'.$abususer['Appartenance']['User']['user_id'].'/miniature.'.$abususer['Appartenance']['User']['image_profil'], array('alt' => 'Image de profil', 'class' => 'compte-image'))."<br/>".$abususer['Appartenance']['User']['prenom']."<br/>".$abususer['Appartenance']['User']['nom'], array('controller'=>'users','action'=>'profil', $abususer['Appartenance']['User']['user_id']),array('escape'=>false)); ?>
									</div>
									<?php
								}
								else
								{
									?>
									<div class='message_profil'>
										<?php echo $this->Html->link($this->Html->image('dessins/miniature.png', array('alt' => 'Image de profil', 'class' => 'compte-image'))."<br/>".$abususer['Appartenance']['User']['prenom']."<br/>".$abususer['Appartenance']['User']['nom'], array('controller'=>'users','action'=>'profil', $abususer['Appartenance']['User']['user_id']),array('escape'=>false)); ?>
									</div>
									<?php
								}?>
								
							</div>
							<div class='colonne_droite'>				
								<div class='message_contenu'><?php echo $abususer['explication']; ?></div>
								
							</div>				
					</div>
				</div>
			<?php endforeach; ?>

			<?php echo $this->Form->postLink(('Confirmer Abus'), array('controller'=>'users','action' => 'confirmerAbus', $user['User']['user_id']), null, __('Souhaitez-vous vraiment retirer ce profil?' )); ?>
			<?php echo $this->Form->postLink(("Ce n'est pas abusif"), array('controller'=>'users','action' => 'retirerAbus', $user['User']['user_id'])); ?>

		<?php endforeach; ?>
		<?php endif; ?>





	<?php endforeach; ?>
</div>


