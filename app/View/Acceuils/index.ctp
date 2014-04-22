<?php echo $this->Html->css('style_accueil'); ?>


	<div id="dessin">
	<?php echo $this->Html->image('dessins/immeuble.png', array('alt' => 'Immeuble')); ?>
	</div>
	<div id="presentation">
	<h2> Qu'est-ce que TocTroc ?</h2>
	<p>TocTroc est une application qui facilite les &eacute;changes d'objets ou de service au sein d'un immeuble ou d'un quartier.</p>
	<p>Inscrivez-vous, recherchez votre immeuble ou cr&eacute;ez une nouvelle communaut&eacute;, indiquez ce que vous pourriez pr&ecirc;ter ou ce que vous cherchez, et c'est parti !</p>
	<br/>
	<p>Toctroc est compl&egrave;tement gratuit, sans receler de pi&egrave;ges. Nous ne vous inondons pas de publicit&eacute;s et nous ne revendons pas vos informations.</p>
	<p>Nos seuls revenus sont et seront vos dons.</p>
	<h2> <?php echo $this->Html->link("S'inscrire", array('controller' => 'users', 'action' => 'add')); ?> </h2>
	</div>
