<?php

class AppartenancesController extends AppController {

	public function beforeFilter(){
	parent::beforeFilter();

	}

	public function index(){
		//On récupère les communautés de l'utilisateur
		$appartenances=$this->Appartenance->get_communautes($this->Auth->user("user_id"));	
		$this->set('appartenances', $appartenances );

		//On regarde si l'utilisateur a envoyé des invitations
		$appartenance_id=array();
		foreach($appartenances as $appartenance)
		{
			array_push($appartenance_id, $appartenance['Appartenance']['appartenance_id']);
		}		
		$this->set('invitationsEnvoyees', $this->Appartenance->Invitation->find('count', array('conditions'=>array('Invitation.appartenance_id'=>$appartenance_id))));

		//Idem avec les invitations reçues
		$this->set('invitationsRecues',$this->Appartenance->Invitation->find('count', array('conditions'=>array('Invitation.user_id'=>$this->Auth->user('user_id')))));
	}

	public function add() {
		
		if ($this->request->is('post')) {
	        $this->Appartenance->create();
	        $temporaryAppartenance=array();
	        $temporaryAppartenance["Communaute"]=$this->request->data["Communaute"];
	        $temporaryAppartenance["Communaute"]["Adress"]=$this->request->data["Adress"];
	        $temporaryAppartenance["Communaute"]["parametres"]='0';
	        $temporaryAppartenance["Appartenance"]["valide"]='1';
	        $temporaryAppartenance["Appartenance"]["role"]='2';
	        $temporaryAppartenance["Appartenance"]["user_id"]=$this->Auth->user("user_id");
	        $data=array();
	        $data['User']['User_id']=$this->Auth->user('user_id');
	        $data['User']['role_id']='2';
	        $this->Appartenance->User->save($data);

	        if ($this->Appartenance->saveAssociated($temporaryAppartenance,array('deep'=>true))) {
				unset($temporaryAppartenance);
	            $this->Session->setFlash(__('La communauté a bien été enregistrée.'), 'success');
	            return $this->redirect( array('controller' => 'appartenances', 'action' => 'index'));
	        }
	        $this->Session->setFlash(__('Erreur lors de l\'enregistrement.', 'error'));
	        return $this->redirect( array('controller' => 'appartenances', 'action' => 'index'));
	    }
	}

	public function getall(){
		$this->Appartenance->recursive = 1;
		$this->Paginator->settings = array('fields' => array('Appartenance.appartenance_id','Appartenance.user_id','User.email','Appartenance.communaute_id','Communaute.nom','Appartenance.valide','Appartenance.role'));
		$this->set('appartenances', $this->Paginator->paginate());
	}

	public function moderer(){

		$this->Appartenance->unbindModel(
			array('hasMany' => array('Commentaire','Post','Annonce','PublieOffre','Demande','Emprunt'),
        	 	 'belongsTo'=>array('User')));
		//On regarde les communautés pour lesquelles il est modérateur
		$peutmoderer=$this->Appartenance->find('all',array('recursive'=>1,'conditions'=>array('Appartenance.user_id'=>$this->Auth->user('user_id'),'Appartenance.role'=>2)));
		$communautes=array();
		$i=0;

		//On fait un tableau par communauté
		foreach($peutmoderer as $appartenance)
		{
			// Infos de base sur la communauté			
			$communautes[$i]['communaute_id']=$appartenance['Appartenance']['communaute_id'];
			$communautes[$i]['nom']=$appartenance['Communaute']['nom'];			
			
			// On récupère les AbusPosts, avec les informations importantes (Post de référence, auteurs, etc)			
			$this->Appartenance->Post->AbusPost->unbindModel(
				array('belongsTo'=>array('Post')));

			$listeAbusPosts=$this->Appartenance->Post->AbusPost->find('all',array('recursive'=>1,'conditions'=>array('Appartenance.communaute_id'=>$appartenance['Appartenance']['communaute_id'])));
			$listePosts=array();
			foreach ($listeAbusPosts as $abusPost)
			{
				array_push($listePosts, $abusPost['AbusPost']['post_id']);
			}

			$this->Appartenance->Post->unbindModel(
				array('belongsTo'=>array('Canal'),
					  'hasMany'=>array('Commentaire')));

			$this->Appartenance->unbindModel(
				array('hasMany' => array('Commentaire','Post','Annonce','PublieOffre','Demande','Emprunt'),
        	  		  'belongsTo'=>array('Communaute')));

			$this->Appartenance->User->unbindModel(
				array('hasMany'=>array('Appartenance','AbusProfil'),
					  'hasAndBelongsToMany'=>array('Titre'),
					  'belongsTo'=>array('Appartenance','Adresse')));
			$this->Appartenance->Post->AbusPost->unbindModel(
				array('belongsTo'=>array('Post')));

			// Après cette ligne, on a tout récupéré concernant les posts abusifs.
			$communautes[$i]['Posts']=$this->Appartenance->Post->find('all',array('recursive'=>3,'conditions'=>array('Post.post_id'=>$listePosts)));


			// On récupère les AbusCommentaires, avec les informations importantes (Commentaire, auteurs)
			$this->Appartenance->Commentaire->AbusCommentaire->unbindModel(
				array('belongsTo'=>array('Commentaire')));

			$listeAbusCommentaires=$this->Appartenance->Commentaire->AbusCommentaire->find('all',array('recursive'=>1,'conditions'=>array('Appartenance.communaute_id'=>$appartenance['Appartenance']['communaute_id'])));
			$listeCommentaires=array();
			foreach ($listeAbusCommentaires as $abusCommentaire)
			{
				array_push($listeCommentaires, $abusCommentaire['AbusCommentaire']['commentaire_id']);
			}
			$this->Appartenance->Post->unbindModel(
				array('belongsTo'=>array('Canal'),
					  'hasMany'=>array('Commentaire','AbusPost')));

			$this->Appartenance->unbindModel(
				array('hasMany' => array('Post','Annonce','PublieOffre','Demande','Emprunt','Commentaire'),
        	  		  'belongsTo'=>array('Communaute')));

			$this->Appartenance->User->unbindModel(
				array('hasMany'=>array('Appartenance','AbusProfil'),
					  'hasAndBelongsToMany'=>array('Titre'),
					  'belongsTo'=>array('Appartenance','Adresse')));
			$this->Appartenance->Commentaire->AbusCommentaire->unbindModel(
				array('belongsTo'=>array('Commentaire')));

			// Après cette ligne, on a tout récupéré concernant les commentaires abusifs.
			$communautes[$i]['Commentaires']=$this->Appartenance->Commentaire->find('all',array('recursive'=>3,'conditions'=>array('Commentaire.commentaire_id'=>$listeCommentaires)));


			// On récupère les AbusOffres, avec les informations importantes (Offre, auteurs)
			$this->Appartenance->PublieOffre->Offre->AbusOffre->unbindModel(
				array('belongsTo'=>array('Offre')));

			$listeAbusOffres=$this->Appartenance->PublieOffre->Offre->AbusOffre->find('all',array('recursive'=>1,'conditions'=>array('Appartenance.communaute_id'=>$appartenance['Appartenance']['communaute_id'])));
			$listeOffres=array();
			foreach ($listeAbusOffres as $abusOffre)
			{
				array_push($listeOffres, $abusOffre['AbusOffre']['offre_id']);
			}
			$this->Appartenance->PublieOffre->Offre->unbindModel(
				array('hasMany'=>array('Demande','Emprunt')));

			$this->Appartenance->PublieOffre->unbindModel(
				array('belongsTo'=>array('Offre')));

			$this->Appartenance->unbindModel(
				array('hasMany' => array('Post','Commentaire','Annonce','PublieOffre','Demande','Emprunt','Offre'),
        	  		  'belongsTo'=>array('Communaute')));

			$this->Appartenance->User->unbindModel(
				array('hasMany'=>array('Appartenance','AbusProfil'),
					  'hasAndBelongsToMany'=>array('Titre'),
					  'belongsTo'=>array('Appartenance','Adresse')));


			$this->Appartenance->PublieOffre->Offre->AbusOffre->unbindModel(
				array('belongsTo'=>array('Offre')));

			// Après cette ligne, on a tout récupéré concernant les offres abusifs.
			$communautes[$i]['Offres']=$this->Appartenance->PublieOffre->Offre->find('all',array('recursive'=>3,'conditions'=>array('Offre.offre_id'=>$listeOffres)));


			// On récupère les AbusProfils, avec les informations importantes (User...)
			$this->Appartenance->User->AbusProfil->unbindModel(
				array('belongsTo'=>array('User')));

			$listeAbusProfils=$this->Appartenance->User->AbusProfil->find('all',array('recursive'=>1,'conditions'=>array('Appartenance.communaute_id'=>$appartenance['Appartenance']['communaute_id'])));
			$listeUsers=array();
			foreach ($listeAbusProfils as $abusProfil)
			{
				array_push($listeUsers, $abusProfil['AbusProfil']['user_id']);
			}

			$this->Appartenance->User->unbindModel(
				array('hasMany'=>array('Appartenance'),
					  'hasAndBelongsToMany'=>array('Titre'),
					  'belongsTo'=>array('Appartenance','Role')));

			$this->Appartenance->unbindModel(
				array('hasMany' => array('Post','PublieOffre','Commentaire','Annonce','PublieUser','Demande','Emprunt','User'),
        	  		  'belongsTo'=>array('Communaute')));


			$this->Appartenance->User->AbusProfil->unbindModel(
				array('belongsTo'=>array('User')));

			// Après cette ligne, on a tout récupéré concernant les users abusifs.
			$communautes[$i]['Users']=$this->Appartenance->User->find('all',array('recursive'=>3,'conditions'=>array('User.user_id'=>$listeUsers)));



			$i=$i+1;
		}
		$this->set('communautes',$communautes);

	}
	
}