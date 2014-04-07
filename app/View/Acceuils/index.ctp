<div id="fond">
	<div id="page">
	<div id="dessin">
	<?php echo $this->Html->image('dessins/immeuble.png', array('alt' => 'Immeuble')); ?>
	</div>
	<div id="presentation">
	<h2> Qu'est-ce que TocTroc ?</h2>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at odio nisl. Pellentesque eros magna, condimentum et convallis eu, tempor eget orci. Nam eget erat non quam tristique pretium et imperdiet enim. Etiam aliquam metus sit amet luctus pretium. Proin nec eros vel enim ullamcorper accumsan. Cras ante diam, aliquam ut tristique sed, mattis vitae arcu. In mauris tortor, malesuada vitae faucibus ac, aliquam vitae arcu. Aenean id tincidunt nunc. Aliquam suscipit feugiat feugiat. Fusce id orci at nisi tincidunt mattis sagittis vel est. Phasellus vulputate pulvinar enim at lacinia. Donec ullamcorper id est eu hendrerit. Suspendisse potenti.</p>
	<h2> <?php echo $this->Html->link("S'inscrire", array('controller' => 'users', 'action' => 'add')); ?> </h2>
	<h2> <?php echo $this->Html->link("Se connecter", array('controller' => 'users', 'action' => 'login')); ?> </h2>
	</div>
	</div>
</div>