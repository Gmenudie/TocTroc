<?php

class CommentairesController extends AppController {

	/* Liste des actions du controller
	 * 
	 * 1. add()
	 *
	 */

	public function beforeFilter(){
	parent::beforeFilter();

	}

	 
	 /* ------------------------------------------
	 * add
	 * ------------------------------------------
	 * Fonction extrêmement classique, qui permet d'enregistrer un commentaire pour un post.
	 * Les premières lignes sont des vérifications que l'utilisateur a bien le droit de commenter.
	 * Une fois le commentaire enregistré, on renvoie vers le mur.
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
	                $this->Session->setFlash(__('Votre commentaire a bien été posté'), 'success');
	                return $this->redirect( array('controller' => 'posts', 'action' => 'index', $appartenance["Appartenance"]["appartenance_id"]));
	            }
	            $this->Session->setFlash(__('Erreur lors de la sauvegarde de votre commentaire'), 'error');
	        }
	        
	    }

		return $this->redirect( array('controller' => 'posts', 'action' => 'index', $appartenance["Appartenance"]["appartenance_id"]));
	}

	public function getall(){
		
		$this->Commentaire->Appartenance->unbindModel(
        array('hasMany' => array('Commentaires','Posts','Annonces','PublieOffres','Demandes','Emprunts')));
        $this->Commentaire->Post->unbindModel(
        array('hasMany' => array('Commentaires'),
        	  'belongsTo'=>array('Canal','Appartenace')));

		$this->Paginator->settings = array('recursive'=>2,'fields' => array('Commentaire.commentaire_id','Commentaire.contenu','Commentaire.created','Commentaire.post_id','Post.contenu','Commentaire.appartenance_id'));
		$this->set('commentaires', $this->Paginator->paginate());
	}

	public function delete($id = null) {
		$this->Commentaire->id = $id;
		if (!$this->Commentaire->exists()) {
			throw new NotFoundException(__('Invalid commentaire'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Commentaire->delete()) {
			$this->Session->setFlash(__('Le commentaire a été supprimé.', 'success'));
		} else {
			$this->Session->setFlash(__('Le commentaire n\'a pas pu être supprimé. Veuillez réessayer.', 'error'));
		}
		return $this->redirect($this->referer());
	}

	public function addAbus($id=null){

		//Vérification 
		$this->Commentaire->Appartenance->unbindModel(
			array('hasMany' => array('Commentaires','Post','Annonces','PublieOffres','Demandes','Emprunts'),
        	 	 'belongsTo'=>array('Commentaire')));
		$this->Commentaire->unbindModel(
			array('belongsTo'=>array('Post'),
				'hasMany'=>array('AbusCommentaire')));

		$commentaire=$this->Commentaire->find('first',array('conditions'=>array('commentaire_id'=>$id),'recursive'=>2));
		$appartenance=$this->Commentaire->Appartenance->find('first',array('conditions'=>array('Appartenance.user_id'=>$this->Auth->user('user_id'),'Appartenance.communaute_id'=>$commentaire['Appartenance']['communaute_id'])));

		//Une personne ne peut signaler qu'une fois le meme commentaire comme étant abusif!
		$nbAbus=$this->Commentaire->AbusCommentaire->find('count',array('conditions'=>array('AbusCommentaire.appartenance_id'=>$appartenance['Appartenance']['appartenance_id'],'AbusCommentaire.commentaire_id'=>$id)));
		
		if($appartenance!=null && $nbAbus==0) //Utilisateur autorisé
		{

			if($this->request->is('post'))
			{
				$this->Commentaire->AbusCommentaire->create();
				$addAbus=$this->request->data;
				$addAbus["AbusCommentaire"]["appartenance_id"]=$appartenance['Appartenance']['appartenance_id'];
				if($this->Commentaire->AbusCommentaire->save($addAbus))
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
			$this->set('commentaire',$commentaire);
		}
		else if ($nbAbus==0) //Pas autorisé (Commentaire pas de ses communautés)
		{
			$this->Session->setFlash("Vous n'êtes pas autorisé à faire ce signalement", 'error');
			return $this->redirect(array('controller'=>'acceuils','action'=>'index'));
		}
		else //Déjà signalé
		{
			$this->Session->setFlash("Vous avez déjà signalé ce message comme abusif", 'error');
			return $this->redirect(array('controller'=>'posts','action'=>'index',$appartenance['Appartenance']['appartenance_id']));
		}

	}

	public function retirerAbus($id=null)
	{
		$commentaire=$this->Commentaire->find('first',array('recursive'=>1,'conditions'=>array('commentaire_id'=>$id)));
		$appartenance=$this->Commentaire->Appartenance->find('first',array('recursive'=>0,'conditions'=>array('Appartenance.user_id'=>$this->Auth->user('user_id'), 'Appartenance.communaute_id'=>$commentaire['Appartenance']['communaute_id'], 'Appartenance.role'=>2)));

		if(isset($appartenance)&&$appartenance!=null)
		{
			foreach($commentaire['AbusCommentaire'] as $abuscommentaire)
			{
				if(!$this->Commentaire->AbusCommentaire->delete($abuscommentaire))
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
			$this->Session->setFlash("Vous n'avez pas l'autorisation", 'error');
			return $this->redirect($this->referer());
		}
	}
	

	public function confirmerAbus($id=null)
	{
		$commentaire=$this->Commentaire->find('first',array('recursive'=>1,'conditions'=>array('commentaire_id'=>$id)));
		$appartenance=$this->Commentaire->Appartenance->find('first',array('recursive'=>0,'conditions'=>array('Appartenance.user_id'=>$this->Auth->user('user_id'), 'Appartenance.communaute_id'=>$commentaire['Appartenance']['communaute_id'], 'Appartenance.role'=>2)));

		if(isset($appartenance)&&$appartenance!=null)
		{
			foreach($commentaire['AbusCommentaire'] as $abuscommentaire)
			{
				if(!$this->Commentaire->AbusCommentaire->delete($abuscommentaire))
				{
					$this->Session->setFlash("Problème rencontré lors de la suppression d'un abus", 'error');
					return $this->redirect($this->referer());
				}
			}
			$this->Session->setFlash('Abus retiré correctement', 'success');
			$commentaire['Commentaire']['etat']=2;
			if($this->Commentaire->save($commentaire))
			{
				$this->Session->setFlash('Abus confirmé, commentaire retiré', 'success');
				return $this->redirect($this->referer());
			}
			else
			{
				$this->Session->setFlash("Problème rencontré lors de la modification de l'etat", 'error');
				return $this->redirect($this->referer());
			}

			return $this->redirect($this->referer());
		}
		else
		{
			$this->Session->setFlash("Vous n'avez pas l'autorisation", 'error');
			return $this->redirect($this->referer());
		}
	}
}