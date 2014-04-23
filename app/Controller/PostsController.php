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

	public function beforeFilter(){
	parent::beforeFilter();

	} 
	 

	
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

		// Ou alors l'utilisateur est un administrateur

		if((array_key_exists(0, $appartient) && $appartient[0]["Appartenance"]["user_id"]===$this->Auth->user('user_id'))||($this->Auth->user('role_id')==1))
		{

			// Petite manip a faire parce qu'un utilisateur normal et un admin n'accèdent pas à la page de la même façon...
			if(array_key_exists(0, $appartient) && $appartient[0]["Appartenance"]["user_id"]===$this->Auth->user('user_id'))
			{
				$communaute_id=$appartient[0]["Appartenance"]["communaute_id"];
			}
			else
			{
				// L'administrateur arrive sur la page en envoyant à $id directement communaute_id.
				$communaute_id=$id;
			}

			// On récupère le nom de la communauté
			$this->set('nomCommunaute',$this->Post->Appartenance->Communaute->find('first',array('conditions'=>array('communaute_id'=>$communaute_id),'fields'=>'nom')));
		
			// On récupère les identités de toutes les personnes de la communautés, pour pouvoir récupérer leurs posts et commentaires
			$personnes=$this->Post->Appartenance->find('all',array('conditions'=>array('Appartenance.communaute_id'=>$communaute_id)));
			$i=0;
			$j=0;
			$posts=array();
			$coms=array();

			foreach($personnes as $personne){

				// Pour chaque membre de la communauté, on récupère leurs posts/commentaires. On arrange tout ça dans une structure cohérente

				
				$postsintermediate=$this->Post->find('all',array('conditions'=>array('Post.etat'=>1,'Post.appartenance_id'=>$personne["Appartenance"]["appartenance_id"]),'recursive'=>3));
				foreach ($postsintermediate as $postsinter) {

					$posts[$j]["Post"]["created"]=$postsinter["Post"]["created"];
					$posts[$j]["Post"]["post_id"]=$postsinter["Post"]["post_id"];
					$posts[$j]["Post"]["communaute_id"]=$communaute_id;
					$posts[$j]["Post"]["User"]["user_id"]=$personne["Appartenance"]["user_id"];
					$posts[$j]["Post"]["User"]["prenom"]=$personne["User"]["prenom"];
					$posts[$j]["Post"]["User"]["nom"]=$personne["User"]["nom"];
					$posts[$j]["Post"]["User"]["image_profil"]=$personne["User"]["image_profil"];
					$posts[$j]["Post"]["contenu"]=$postsinter["Post"]["contenu"];
					$posts[$j]["Post"]["canal_id"]=$postsinter["Post"]["canal_id"];
					

					if(array_key_exists("Commentaire", $postsinter)){
						foreach ($postsinter["Commentaire"] as $com) {

							if($com['etat']==1)
							{
								$posts[$j]["Commentaires"][$i]["created"]=$com["created"];								
								$posts[$j]["Commentaires"][$i]["commentaire_id"]=$com["commentaire_id"];
								$posts[$j]["Commentaires"][$i]["User"]["user_id"]=$com["Appartenance"]["User"]["user_id"];
								$posts[$j]["Commentaires"][$i]["User"]["prenom"]=$com["Appartenance"]["User"]["prenom"];
								$posts[$j]["Commentaires"][$i]["User"]["nom"]=$com["Appartenance"]["User"]["nom"];
								$posts[$j]["Commentaires"][$i]["User"]["image_profil"]=$com["Appartenance"]["User"]["image_profil"];
								$posts[$j]["Commentaires"][$i]["contenu"]=$com["contenu"];
								$i=$i+1;
							}
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
				}
				
				//Tri des posts du plus récent au plus vieux

				if($posts!=null){
				foreach ($posts as $key2 => $row2) {
					$rang2[$key2]  = $row2["Post"]['created'];
				} 
				
				array_multisort($rang2, SORT_DESC, $posts);	
			}

			// Réglage des paramètres pour l'envoi de nouveaux posts. S'il s'agit d'un utilisateur normal, on enregistre ses infos.
			// Si c'est un admin, on le signale à la vue pour offrir de nouvelles possibilités

			if(array_key_exists(0, $appartient) && $appartient[0]["Appartenance"]["user_id"]===$this->Auth->user('user_id'))
			{
				// On envoie à la vue l'identité de l'utilisateur pour pouvoir créer des posts. (Peut-être inutile, à vérifier)
				$this->set('user',$appartient[0]["Appartenance"]["appartenance_id"]);
				$this->set('role',3);
			}
			else
			{
				//C'est un admin, on le signale
				$this->set('user',$id);
				$this->set('role',1);
			}				

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
			if($appartient!=null && $appartient["Appartenance"]["user_id"]==$this->Auth->user('user_id'))
			{
	            $this->Post->create();
	            if ($this->Post->save($this->request->data)) 
	            {					
	                $this->Session->setFlash(__('Votre message a bien été enregistré', 'success'));
	                return $this->redirect( array('controller' => 'posts', 'action' => 'index', $appartient["Appartenance"]["appartenance_id"]));
	            }
	            $this->Session->setFlash(__('Erreur lors de l\'enregistrement', 'error'));
	        }

	    }
	}

	public function addAbus($id=null){

		//Vérification 
		$this->Post->Appartenance->unbindModel(
			array('hasMany' => array('Commentaires','Posts','Annonces','PublieOffres','Demandes','Emprunts'),
        	 	 'belongsTo'=>array('Commentaire')));

		$post=$this->Post->find('first',array('conditions'=>array('post_id'=>$id),'recursive'=>2));
		$appartenance=$this->Post->Appartenance->find('first',array('conditions'=>array('Appartenance.user_id'=>$this->Auth->user('user_id'),'Appartenance.communaute_id'=>$post['Appartenance']['communaute_id'])));

		//Une personne ne peut signaler qu'une fois le meme post comme étant abusif!
		$nbAbus=$this->Post->AbusPost->find('count',array('conditions'=>array('AbusPost.appartenance_id'=>$appartenance['Appartenance']['appartenance_id'],'AbusPost.post_id'=>$id)));
		
		if($appartenance!=null && $nbAbus==0) //Utilisateur autorisé
		{

			if($this->request->is('post'))
			{
				$this->Post->AbusPost->create();
				$addAbus=$this->request->data;
				$addAbus["AbusPost"]["appartenance_id"]=$appartenance['Appartenance']['appartenance_id'];
				if($this->Post->AbusPost->save($addAbus))
				{
					$this->Session->setFlash('Votre signalement a bien été pris en compte. Il sera transmis aux modérateurs', 'success');
				}
				else
				{
					$this->Session->setFlash("Désolé, un problème est survenu et votre signalement n'a pas pu être enregistré", 'error');
				}
				return $this->redirect(array('controller'=>'posts','action'=>'index',$appartenance['Appartenance']['appartenance_id']));
				
			}

			// On prépare les informations pour les envoyer à la vue			
			$this->set('post',$post);
		}
		else if ($nbAbus==0) //Pas autorisé (Post pas de ses communautés)
		{
			$this->Session->setFlash("Vous n'êtes pas autorisé à faire cette action", 'error');
			return $this->redirect(array('controller'=>'acceuils','action'=>'index'));
		}
		else //Déjà signalé
		{
			$this->Session->setFlash("Vous avez déjà signalé ce message comme abusif", 'error');
			return $this->redirect(array('controller'=>'posts','action'=>'index',$appartenance['Appartenance']['appartenance_id']));
		}

	}


	public function getall(){
		
		$this->Post->unbindModel(
        array('belongsTo' => array('Canal'),
        	  'hasMany' => array('Commentaires')));


		$this->Paginator->settings = array('recursive'=>1,'fields' => array('Post.post_id','Post.contenu','Post.created','Post.document_joint','Post.canal_id','Post.appartenance_id','Appartenance.user_id','Appartenance.communaute_id'));
		$this->set('posts', $this->Paginator->paginate());
	}

	public function delete($id = null) {
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Post->delete()) {
			$this->Session->setFlash(__('Le message a été supprimé', 'success'));
		} else {
			$this->Session->setFlash(__('Le message n\'a pas pu être supprimé. Veuillez réessayer.', 'error'));
		}
		return $this->redirect($this->referer());
	}

	public function retirerAbus($id=null)
	{
		$post=$this->Post->find('first',array('recursive'=>1,'conditions'=>array('post_id'=>$id)));
		$appartenance=$this->Post->Appartenance->find('first',array('recursive'=>0,'conditions'=>array('Appartenance.user_id'=>$this->Auth->user('user_id'), 'Appartenance.communaute_id'=>$post['Appartenance']['communaute_id'], 'Appartenance.role'=>2)));

		if(isset($appartenance)&&$appartenance!=null)
		{
			foreach($post['AbusPost'] as $abuspost)
			{
				if(!$this->Post->AbusPost->delete($abuspost))
				{
					$this->Session->setFlash("Problème rencontré lors de la suppression d'un abus", 'error');
					return $this->redirect($this->referer());
				}
			}
			$this->Session->setFlash('Abus retiré correctement', 'success');
			return $this->redirect($this->referer());
		}
		else
		{
			$this->Session->setFlash("Vous n'avez pas l'autorisation pour faire cette action", 'error');
			return $this->redirect($this->referer());
		}
	}
	

	public function confirmerAbus($id=null)
	{
		$post=$this->Post->find('first',array('recursive'=>1,'conditions'=>array('post_id'=>$id)));
		$appartenance=$this->Post->Appartenance->find('first',array('recursive'=>0,'conditions'=>array('Appartenance.user_id'=>$this->Auth->user('user_id'), 'Appartenance.communaute_id'=>$post['Appartenance']['communaute_id'], 'Appartenance.role'=>2)));

		if(isset($appartenance)&&$appartenance!=null)
		{
			foreach($post['AbusPost'] as $abuspost)
			{
				if(!$this->Post->AbusPost->delete($abuspost))
				{
					$this->Session->setFlash("Problème rencontré lors de la suppression d'un abus", 'error');
					return $this->redirect($this->referer());
				}
			}
			$this->Session->setFlash('Abus retiré correctement', 'success');
			$post['Post']['etat']=2;
			if($this->Post->save($post))
			{
				$this->Session->setFlash('Abus confirmé, post retiré', 'success');
				return $this->redirect($this->referer());
			}
			else
			{
				$this->Session->setFlash("Problème rencontré lors de la modification de l'état", 'error');
				return $this->redirect($this->referer());
			}

			return $this->redirect($this->referer());
		}
		else
		{
			$this->Session->setFlash("Vous n'avez pas l'autorisation pour faire cette action", 'error');
			return $this->redirect($this->referer());
		}
	}
}
