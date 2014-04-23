<div class="users form" style="width: 400px; margin: auto;">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
            <?php echo __('Entrez votre identifiant et votre mot de passe'); ?>
        <?php echo $this->Form->input('email', array('label'=>'', 'placeholder'=>'Email'));
        	  echo $this->Form->input('password', array('label'=>'', 'placeholder'=>'Mot de passe'));
    ?>
<?php echo $this->Form->end(__('Login')); ?>
</div>
