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

    <?php echo $this->html->link('Créer une communauté', array('controller' => 'appartenances','action' => 'add')); ?>
    


    <?php unset($appartenances); ?>
</table>