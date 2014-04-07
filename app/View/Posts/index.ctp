<h1>Le mur</h1>

   
    <?php foreach ($posts as $post): ?>

        <div class='Post'>
        <h2><?php echo $post['Post']['titre']; ?></h2>
        <?php 
        echo ($post['Post']['User']['prenom']." ".$post['Post']['User']['nom']."\n");
        echo ($post['Post']['contenu']."\n"); 
        echo ($post['Post']['created']."\n");
        ?>
        
        
        <?php if(array_key_exists("Commentaires", $post)){?>

            <div class='Commentaires'>
            <?php foreach ($post["Commentaires"] as $com){?>
                <p class"commentaire">
                <?php                
                echo $com['contenu'];
                echo ($com['User']['prenom']." ".$com['User']['nom']);
                echo $com['created'];
                ?> </p>
                <?php }?>
            </div>
            <?php 
        }
        ?>

        <?php 
        echo $this->Form->create("Commentaire",array('url'=> array('controller'=>'commentaires','action'=>'add')));
        
        echo $this->Form->input('contenu');
        echo $this->Form->hidden('appartenance_id',array('default'=>$post["Post"]["communaute_id"]));
        echo $this->Form->hidden('post_id',array('default'=>$post["Post"]["post_id"]));        
        echo $this->Form->end("Commenter");
        ?>
        </div>       
        
    
    <?php endforeach;?>


    <div class="Poster">
        <?php 
        echo $this->Form->create("Post",array('url'=>array('controller'=>'posts','action'=>'add')));
        echo $this->Form->input('titre');
        echo $this->Form->input('contenu');
        echo $this->Form->hidden("appartenance_id",array('default'=>$user));
        echo $this->Form->hidden("canal_id",array('default'=>1));
        echo $this->Form->end("Poster");
        ?>
    </div>

    <?php echo $this->Html->link('Voir plus', array('controller'=>'posts','action'=>'index', $user, sizeof($posts)+10));?>
    <?php unset($post); ?>



