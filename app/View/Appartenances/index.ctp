<h1>Vos communautés</h1>
<table>
    

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php if ($appartenances != NULL){?>

        <tr>
            <th>Image</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Action</th>
        </tr>

       <?php foreach ($appartenances as $communaute): ?>


            <tr>
            <td></td>
            <td><?php echo $communaute['Communaute']['nom']; ?></td>
            <td><?php echo $communaute['Communaute']['description']; ?></td>
            <td><?php echo $this->Html->link(__('Voir'), array('controller'=>'posts','action' => 'index', $communaute['Appartenance']['appartenance_id'])); ?></td>
        
            </tr>
        <?php endforeach;
    }

        else echo "Vous n'avez pas encore de communauté";
    ?>


    


    <?php unset($appartenances); ?>
</table>
<br/>
<div id='créer'>

    <?php echo $this->Form->create('Appartenance',(array('url'=>array('controller'=>'appartenances','action'=>'add'))));
?>

<fieldset><legend> Créer une communauté </legend>
<?php   
    
    echo $this->Form->input('Communaute.nom', array('label' => 'Nom'));
    echo $this->Form->input('Communaute.description' , array('label' => 'Description'));
?>
</fieldset>

<br/>
<fieldset><legend>Adresse de la communauté</legend>
<?php
    echo $this->Form->input('Adress.numero' , array('label' => 'N°'));
    echo $this->Form->input('Adress.rue' , array('label' => 'Rue'));
    echo $this->Form->input('Adress.code_postal' , array('label' => 'Code Postal'));
    echo $this->Form->input('Adress.ville' , array('label' => 'Ville'));
?>
</fieldset> 
<br/>
<?php
    echo $this->Form->end("Créer"); ?>
</div>