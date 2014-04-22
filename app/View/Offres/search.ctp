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

		<?php

			//Les résultats

			if (isset($offres)){?>
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
						
						echo h($offre['Offre']['titre']);
						echo h($offre['Offre']['description']);		
						echo $this->Html->link(__('Voir'), array('action' => 'view', $offre['Offre']['offre_id']));
					
						endforeach; 
					
					
				
						
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
				<?php }
				?>
</div>