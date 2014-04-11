<?php

class PostsController extends AppController {

	/* Liste des actions du controller
	 * 
	 * 1. beforeFilter()
	 * 2. index()
	 * 3. add()
	 *
	 * Le controller du mur! Mon bébé :D
	 */

	 
	 

	
	/* ------------------------------------------
	 * index
	 * ------------------------------------------
	 * Algorithme très complexe :P, qui
	 * 1) Vérifie que l'utilisateur a bien le droit d'accéder au mur
	 * 2) Récupère de façon très brute des posts, identité des posteurs, commentaires, etc...
	 * 3) Restructure tout ça pour qu'à chaque post soit associé les bons commentaires et bonnes personnes
	 * 4) Trie posts et commentaires par date
	 * 5) Envoie tout ça à la vue pour affichage :)
	 * 6) Comprend une fonction pour limiter le nombre de posts affichés,
	 * l'utilisateur dispose d'un bouton ("plus") comme sur 9gag :P
	 * 
	 * ------------------------------------------ */
	
	public function index($id=null,$size=10) {

		// Vérification: l'utilisateur appartient-il à la communauté dont il essaie de voir le mur ?

		$appartient=$this->Post->Appartenance->find('all', array('conditions' => array('appartenance_id' => $id)));

			if($appartient[0]["Appartenance"]["user_id"]===$this->Auth->user('user_id')){

				// On récupère les identités de toutes les personnes de la communautés, pour pouvoir récupérer leurs posts et commentaires

				$personnes=$this->Post->Appartenance->find('all',array('conditions'=>array('Appartenance.communaute_id'=>$appartient[0]["Appartenance"]["communaute_id"])));
				$i=0;
				$j=0;
				$posts=array();
				$coms=array();

				foreach($personnes as $personne){

					// Pour chaque membre de la communauté, on récupère leurs posts/commentaires. On arrange tout ça dans une structure cohérente

					
					$postsintermediate=$this->Post->find('all',array('conditions'=>array('Post.appartenance_id'=>$personne["Appartenance"]["appartenance_id"]),'recursive'=>3));
					foreach ($postsintermediate as $postsinter) {

						$posts[$j]["Post"]["created"]=$postsinter["Post"]["created"];
						$posts[$j]["Post"]["post_id"]=$postsinter["Post"]["post_id"];
						$posts[$j]["Post"]["communaute_id"]=$appartient[0]["Appartenance"]["communaute_id"];
						$posts[$j]["Post"]["User"]["user_id"]=$personne["Appartenance"]["user_id"];
						$posts[$j]["Post"]["User"]["prenom"]=$personne["User"]["prenom"];
						$posts[$j]["Post"]["User"]["nom"]=$personne["User"]["nom"];
						$posts[$j]["Post"]["contenu"]=$postsinter["Post"]["contenu"];
						$posts[$j]["Post"]["canal_id"]=$postsinter["Post"]["canal_id"];
						

						if(array_key_exists("Commentaires", $postsinter)){
							foreach ($postsinter["Commentaires"] as $com) {

								$posts[$j]["Commentaires"][$i]["created"]=$com["created"];								
								$posts[$j]["Commentaires"][$i]["commentaire_id"]=$com["commentaire_id"];
								$posts[$j]["Commentaires"][$i]["User"]["user_id"]=$com["Appartenance"]["User"]["user_id"];
								$posts[$j]["Commentaires"][$i]["User"]["prenom"]=$com["Appartenance"]["User"]["prenom"];
								$posts[$j]["Commentaires"][$i]["User"]["nom"]=$com["Appartenance"]["User"]["nom"];
								$posts[$j]["Commentaires"][$i]["contenu"]=$com["contenu"];
								$i=$i+1;
							}
						}

						$j=$j+1;


					}
				}
					//Tri des commentaires du plus récent au plus vieux
					foreach ($posts as &$post) {
						
						if(array_key_exists("Commentaires", $post)){
							
							foreach($post["Commentaires"] as $key=>$row){
								$rang[$key]=$row['created'];								
							}
							array_multisort($rang, SORT_ASC, $post["Commentaires"]);

							unset($key);
							unset($rang);
							unset($row);
							
						}
					}/* Version manuelle en cas de problème

					foreach ($posts as &$post) {
						
						if(array_key_exists("Commentaires", $post)){
							$l=count($post["Commentaires"]);
							$memoire=array();
							$trie=array();

							for ($n=0; $n <$l-1 ; $n++) { 
								if($post["Commentaires"][$n]["created"]<$post["Commentaires"][$n+1]["created"]){
									$memoire=$post["Commentaires"][$n];
									$post["Commentaires"][$n]=$post["Commentaires"][$n+1];
									$post["Commentaires"][$n+1]=$memoire;
								}
							}
							
							
						}
					}*/			



					
					//Tri des posts du plus récent au plus vieux

					if($posts!=null){
					foreach ($posts as $key2 => $row2) {
					    $rang2[$key2]  = $row2["Post"]['created'];
					} 
					
					array_multisort($rang2, SORT_DESC, $posts);	
				}




				

				$this->set('user',$appartient[0]["Appartenance"]["appartenance_id"]);

				$this->set('posts', array_slice($posts, 0,$size));
				unset($personnes);
				unset($appartient);
				unset($posts);

			}
	}


	
	/* ------------------------------------------
	 * add
	 * ------------------------------------------
	 * Fonction basique qui vérifie que l'utilisateur a bien le droit de poster sur ce mur et enregistre son post.
	 * ------------------------------------------ */
	
	public function add(){

		if ($this->request->is('post')) {
			$appartient=$this->Post->Appartenance->find('first',array('conditions'=>array("Appartenance.appartenance_id"=>$this->request->data["Post"]["appartenance_id"])));
			if($appartient!=null && $appartient["Appartenance"]["user_id"]===$this->Auth->user('user_id')){	            

	            $this->Post->create();
	            if ($this->Post->save($this->request->data)) {
					
	                $this->Session->setFlash(__('Votre post a bien été enregistré'));
	                return $this->redirect( array('controller' => 'posts', 'action' => 'index', $appartient["Appartenance"]["appartenance_id"]));
	            }
	            $this->Session->setFlash(__('Erreur'));
	        }

	        }



	}
		
	
}
