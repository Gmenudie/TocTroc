<div class="offres form">
<?php echo $this->Form->create('Offre'); 
print_r($data);?>
	<fieldset>
		<legend><?php echo __('Modifier Offre'); ?></legend>
	<?php
		echo $this->Form->input('offre_id');
		echo $this->Form->input('Offre.titre');
		echo $this->Form->input('Offre.description');
		echo ("Publier l'annonce dans les communautés:");
		echo $this->Form->select('PublieOffre.appartenance_id', $appartenances, array('multiple'=>'checkbox'));
		echo $this->Form->input('Category',array('label'=>'Categorie'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
