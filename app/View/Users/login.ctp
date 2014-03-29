<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend>
            <?php echo __('Entrez votre identifiant et votre mot de passe'); ?>
        </legend>
        <?php echo $this->Form->input('email', array('label'=>'Email'));
        	  echo $this->Form->input('password', array('label'=>'Mot de passe'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>
