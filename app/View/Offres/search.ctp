<?php echo $this->Html->css('style_search'); ?>

<div id="chercher_offre">

				<?php 
				
				//Le formulaire de recherche
				
				echo $this->Form->create(false, array('url'=>array('controller'=>'offres','action'=>'search')));
			
				echo $this->Form->input('Nom' , array('label'=>'', 'label'=>'Nom'));
				echo $this->Form->select('appartenance_id', $appartenances, array('multiple'=>'checkbox','label'=>'Rechercher dans les communautés'));
				echo $this->Form->input('Category',array('label'=>'Catégorie','empty'=>'Toutes'));
				echo $this->Form->end(__('Rechercher')); 
				
				?>
		
</div>

<div id="resultats">

		<?php if ($offres!=null){ ?>
			
				<h2>Résultats</h2>
				
					<?php
					
					echo $this->Paginator->sort('titre');
					echo $this->Paginator->sort('description');			
					echo __('Actions');
				
						foreach ($offres as $offre): 
					
					?>
					
					<!--Mes resultat-->
			
					<div class="un_resultat">
				
						<?php
						echo "<div class='colonne_gauche'>";
						
							if(isset($post['Post']['User']['image_profil']))
							{
								echo "<div class='message_profil'>".$this->Html->image('user/'.$post['Post']['User']['user_id'].'/miniature.'.$post['Post']['User']['image_profil'], array('alt' => 'Image de profil', 'class' => 'compte-image'))."<br/>".$post['Post']['User']['prenom']."<br/>".$post['Post']['User']['nom']."</div>";
							}
							else
							{
								echo "<div class='message_profil'><img src='../../app/webroot/img/dessins/image_profil.png'/><br/>".$post['Post']['User']['prenom']."<br/>".$post['Post']['User']['nom']."</div>";
							}
							
						echo "</div>";
						echo "<div class='colonne_droite'>";
						?>
						
							<div class="sous_titre_colonne_droite" style="margin-top:0px;">Description</div>
								
								<?php
								
								echo h($offre['Offre']['titre']); 
								echo h($offre['Offre']['description']); 	
								echo h($offre['Offre']['created']);
								
								?>
							
							<div class="sous_titre_colonne_droite" style="margin-top:0px;">Actions</div>
							
								<?php
									
								echo $this->Html->link(__('Voir'), array('action' => 'view', $offre['Offre']['offre_id']));
								echo $this->Html->link(__('Modifier'), array('action' => 'edit', $offre['Offre']['offre_id'])); 
								echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $offre['Offre']['offre_id']), null, __("Voulez-vous vraiment supprimer l'offre '%c?", $offre['Offre']['titre'])); 

								
								
						echo "</div>";
						?>
						
					</div>
					
					
						<?php endforeach;
					
					
				
						
						echo $this->Paginator->counter(array(
						'format' => __('Page {:page} sur {:pages}')
						));
						
						?>
							
							
						<div class="paging">
							<?php
								echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
								echo $this->Paginator->numbers(array('separator' => ''));
								echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
							?>
						</div>
						
						
					<?php 
					}else{
					echo("Aucune offre ne correspond à votre recherche");}
					?>
</div>