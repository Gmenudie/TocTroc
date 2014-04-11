<?php

class CommentairesController extends AppController {

	/* Liste des actions du controller
	 * 
	 * 1. add()
	 *
	 */

	 
	 /* ------------------------------------------
	 * espacePerso
	 * ------------------------------------------
	 * Page d'accueil pour l'espace perso d'une entreprise
	 *   -> Accès : groupe entreprises
	 * ------------------------------------------ */
	 
	public function add(){

		if ($this->request->is("post")){

			$appartenance=$this->Commentaire->Appartenance->find('first',array('conditions'=>array('Appartenance.user_id'=> $this->Auth->user('user_id'), "Appartenance.communaute_id"=>$this->request->data["Commentaire"]["appartenance_id"]), 'recursive'=>0));

			$post=$this->Commentaire->Post->find('first',array('conditions'=>array('Post.post_id'=> $this->request->data["Commentaire"]["post_id"]), 'recursive'=>1));


			if($appartenance!=null && $appartenance["Appartenance"]["communaute_id"]===$post["Appartenance"]["communaute_id"]){


			$this->Commentaire->create();
			$tempcommentaire=array();
			$tempcommentaire["Commentaire"]["contenu"]=$this->request->data["Commentaire"]["contenu"];
			$tempcommentaire["Commentaire"]["appartenance_id"]=$appartenance["Appartenance"]["appartenance_id"];
			$tempcommentaire["Commentaire"]["post_id"]=$post["Post"]["post_id"];


			if ($this->Commentaire->save($tempcommentaire)) {
					unset($tempcommentaire);
	                $this->Session->setFlash(__('Votre commentaire a bien été posté'));
	                return $this->redirect( array('controller' => 'posts', 'action' => 'index', $appartenance["Appartenance"]["appartenance_id"]));
	            }
	            $this->Session->setFlash(__('Erreur'));
	        }
	        
	    }

		return $this->redirect( array('controller' => 'posts', 'action' => 'index', $appartenance["Appartenance"]["appartenance_id"]));



	}





	}