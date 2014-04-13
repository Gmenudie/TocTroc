<div class="add">

<?php echo $this->Form->create('Offre',array('url'=>array('controller'=>'offres','action'=>'add'))); ?>
	<fieldset>
		<legend><?php echo __('Publier une nouvelle offre'); ?></legend>
	<?php
		echo $this->Form->input('Offre.titre');
		echo $this->Form->input('Offre.description');
		echo ("Publier l'annonce dans les communautés:");
		echo $this->Form->select('PublieOffre.appartenance_id', $appartenances, array('multiple'=>'checkbox'));
		echo $this->Form->input('Category',array('label'=>'Categorie'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Publier offre')); ?>
</div>
