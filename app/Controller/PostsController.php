<?php

class PostsController extends AppController {

	public function beforeFilter() {
	    parent::beforeFilter();
	    // Allow users to register and logout.
	    $this->Auth->allow('index','add', 'logout');
	}

<<<<<<< HEAD
	public function index($id=null,$size=10) {
=======
	public function index($id=null,$size=1) {
>>>>>>> origin/bob

		$appartient=$this->Post->Appartenance->find('all', array('conditions' => array('appartenance_id' => $id)));

			if($appartient[0]["Appartenance"]["user_id"]===$this->Auth->user('user_id')){

				$personnes=$this->Post->Appartenance->find('all',array('conditions'=>array('Appartenance.communaute_id'=>$appartient[0]["Appartenance"]["communaute_id"])));
				$i=0;
				$j=0;
				$posts=array();
				$coms=array();
				foreach($personnes as $personne){

					
					$postsintermediate=$this->Post->find('all',array('conditions'=>array('Post.appartenance_id'=>$personne["Appartenance"]["appartenance_id"]),'recursive'=>3));
					foreach ($postsintermediate as $postsinter) {

						$posts[$j]["Post"]["created"]=$postsinter["Post"]["created"];
						$posts[$j]["Post"]["post_id"]=$postsinter["Post"]["post_id"];
						$posts[$j]["Post"]["communaute_id"]=$appartient[0]["Appartenance"]["communaute_id"];
						$posts[$j]["Post"]["User"]["user_id"]=$personne["Appartenance"]["user_id"];
						$posts[$j]["Post"]["User"]["prenom"]=$personne["User"]["prenom"];
						$posts[$j]["Post"]["User"]["nom"]=$personne["User"]["nom"];
						$posts[$j]["Post"]["titre"]=$postsinter["Post"]["titre"];
						$posts[$j]["Post"]["contenu"]=$postsinter["Post"]["contenu"];
						$posts[$j]["Post"]["canal_id"]=$postsinter["Post"]["canal_id"];
						$posts[$j]["Post"]["Userwatching"]=$appartient[0]["Appartenance"]["appartenance_id"];

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
							
							
							//Tri des commentaires du plus récent au plus vieux
							
						}

						$j=$j+1;


					}
				}

				
					

					foreach ($posts as &$post) {
						
						if(array_key_exists("Commentaires", $post)){
							
							foreach($post["Commentaires"] as $key=>$row){
								$rang[$key]=$row['created'];								
							}
<<<<<<< HEAD
							array_multisort($rang, SORT_ASC, $post["Commentaires"]);

							unset($key);
							unset($rang);
							unset($row);
=======
							array_multisort($rang,SORT_ASC, $post["Commentaires"]);
>>>>>>> origin/bob
							
						}
					}/*

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
					foreach ($posts as $key2 => $row2) {
					    $rang2[$key2]  = $row2["Post"]['created'];
					} 
					
					array_multisort($rang2, SORT_DESC, $posts);	

				
				



				$this->set('posts', array_slice($posts, 0,$size));
				unset($personnes);
				unset($appartient);
				unset($posts);

			}
	}

<<<<<<< HEAD

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
=======
/*
	public function add(){

		if ($this->request->is('post')) {
			$appartient=$this->Post->Appartenance->find('first',array(conditions("Appartenance.user_id")))
			if($this->request->data["Post"]["appartenance_id"]===)
	            

	            $this->Post->create();
>>>>>>> origin/bob



	}
		
<<<<<<< HEAD
	
=======
	*/
>>>>>>> origin/bob
}
