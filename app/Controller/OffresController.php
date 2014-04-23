<?php
App::uses('AppController', 'Controller');
/**
 * Offres Controller
 *
 * @property Offre $Offre
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class OffresController extends AppController {

	/* Liste des actions du controller
	 * 
	 * 1. index()
	 * 2. view($id = null)
	 * 3. add()
	 * 4. edit($id = null)
	 * 5. delete($id = null)
	 *
	 * Remarque: controller en partie scaffoldé pour avoir le matériau de base, je ferai une meilleure doc quand il sera prêt!
	 */

	public function beforeFilter(){
	parent::beforeFilter();

	}



 
 	/* ------------------------------------------
	 * espacePerso
	 * ------------------------------------------
	 * Page d'accueil pour l'espace perso d'une entreprise
	 *   -> Accès : groupe entreprises
	 * ------------------------------------------ */
 
	public function mesOffres() {
		
		// On récupère toutes les appartenances de l'auteur
		$conditions=array('Appartenance.user_id'=>$this->Auth->user('user_id'));
		$appartenances=$this->Offre->PublieOffre->Appartenance->find('all',array('fields'=>'appartenance_id','conditions'=>$conditions,'recursive'=>0));
		
		// On récupère tous ses publieOffre, toutes appartenances confondues
		$conditions1=array();
		foreach ($appartenances as $appartenance) {
			array_push($conditions1, $appartenance["Appartenance"]["appartenance_id"]);
		}
		$publieoffres=$this->Offre->PublieOffre->find('all',array('conditions'=>array('PublieOffre.appartenance_id'=>$conditions1),'recursive'=>0));

		//On récupère toutes les offres, tous publieOffres confondus
		$conditions2=array();
		foreach	($publieoffres as $publieoffre)
		{
			array_push($conditions2,$publieoffre["PublieOffre"]["offre_id"]);
		}

		//On les envoie à la vue
		$appartenances = $this->Offre->PublieOffre->Appartenance->find('list',array('recursive'=>1,'fields'=>'Communaute.nom','conditions'=>array('Appartenance.user_id'=>$this->Auth->user('user_id'))));
		$categories = $this->Offre->Category->find('list',array('fields'=>'nom'));
		$this->set(compact('appartenances', 'categories'));		
		$this->Paginator->settings = array('conditions' => array('Offre.offre_id'=> $conditions2));
		$this->set('offres',$this->Paginator->paginate('Offre',array(),array('Category.nom','titre','created')));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
 
 	/* ------------------------------------------
	 * espacePerso
	 * ------------------------------------------
	 * Permet de voir une offre complète. Deux cas: 
	 * 1) L'utilisateur est l'auteur de l'offre, il veut voir comment elle apparaît. On lui permet dans ce cas de modifier/supprimer l'offre.
	 * Correspond à l'option statut = 2
	 * 2) L'utilisateur est un membre de la communauté dans laquelle l'offre est publiée. Il peut voir l'offre et vouloir emprunter l'objet.
	 * Correspond à l'option statut = 1
	 *
	 * Statut = 0 => utilisateur non autorisé à voir l'annonce.
	 * ------------------------------------------ */

	public function view($id = null) {

		//On vérifie déjà que l'offre demandée existe
		if (!$this->Offre->exists($id)) {
			throw new NotFoundException(__('Invalid offre'));
		}

		//On récupère l'offre en question (on détache certains modèles pour plus de simplicité)
		$this->Offre->PublieOffre->unbindModel(
        array('belongsTo' => array('Offre'))
    	);
		$options = array('conditions' => array('Offre.' . $this->Offre->primaryKey => $id),'recursive'=>2);
		$offre=$this->Offre->find('all', $options);

		$statut=0;
		$communautes=array();

		//On regarde si l'utilisateur appartient a une communauté où l'offre est publiée
		foreach ($offre[0]["PublieOffre"] as $publieoffre)
		{
			if($this->Offre->PublieOffre->Appartenance->find('count',array('conditions'=>array('Appartenance.user_id'=>$this->Auth->user('user_id'),'Appartenance.communaute_id'=>$publieoffre["Appartenance"]["communaute_id"]))))
			{
				$statut=1;
			}

			//On en profite pour lister les communautés dans lesquelles l'offre est publiée
			array_push($communautes, $publieoffre["Appartenance"]["communaute_id"]);
		}

		//On regarde si l'offre appartient à l'utilisateur qui veut la visualiser (pour lui ajouter des boutons modifier/supprimer)
		if($offre[0]["PublieOffre"][0]["Appartenance"]["user_id"]===$this->Auth->user('user_id'))
		{		
			$statut=2;
		}

		$options2=array('fields'=>'nom','conditions'=>array('communaute_id'=>$communautes));

		$this->set('statut',$statut);		
		$this->set('offre', $offre);
		$this->set('communautes',$this->Offre->PublieOffre->Appartenance->Communaute->find('list',$options2));
		$this->set('auteur',$this->Offre->PublieOffre->Appartenance->User->findByUserId($offre[0]["PublieOffre"][0]["Appartenance"]["user_id"]));
		
	}

/**
 * add method
 *
 * @return void
 */
 
 	/* ------------------------------------------
	 * espacePerso
	 * ------------------------------------------
	 * Page d'accueil pour l'espace perso d'une entreprise
	 *   -> Accès : groupe entreprises
	 * ------------------------------------------ */
 
	public function add() {

		// Si formulaire rempli et envoyé
		if ($this->request->is('post')) {

			//Vérifications d'autorisation
			//On vérifie que l'utilisateur a le droit de poster sous ce nom/ dans cette communauté (appartenances).
			$verif=true;
			foreach($this->request->data["PublieOffre"]["appartenance_id"] as $appartenanceid)
			{
				if($this->Offre->PublieOffre->Appartenance->find('count',array('conditions'=>array('Appartenance.appartenance_id'=>$appartenanceid,'Appartenance.user_id'=>$this->Auth->user("user_id"))))!=1)
				{
					$verif=false;
				}
			}

			if($verif)
			{
				//On sauve l'offre
				$this->Offre->create();
				$offre=array();
				$offre["Offre"]=$this->request->data["Offre"];
				$offre["Offre"]["etat"]=1;
				$offre["Category"]=$this->request->data["Category"];

				if ($this->Offre->saveAll($offre)) 
				{
					//On sauve les publieOffre associées
					$publieoffre=array();

					foreach($this->request->data["PublieOffre"]["appartenance_id"] as $appid)
					{
						$this->Offre->PublieOffre->create();
						$publieoffre["PublieOffre"]["appartenance_id"]=$appid;
						$publieoffre["PublieOffre"]["offre_id"]=$this->Offre->id;
						if($this->Offre->PublieOffre->save($publieoffre))
						{
							$this->Session->setFlash(__("Votre offre a bien été enregistrée"));
						}
						else
						{
							$this->Session->setFlash("Ca n'a pas marché ...");
						}
					}
					
					return $this->redirect(array('action' => 'mesOffres'));
				} 
				else 
				{
					$this->Session->setFlash(__('The offre could not be saved. Please, try again.'));
				}
			}
		}
		// Sinon, on récupère les informations et on les passe à la vue
		$appartenances = $this->Offre->PublieOffre->Appartenance->find('list',array('recursive'=>1,'fields'=>'Communaute.nom','conditions'=>array('Appartenance.user_id'=>$this->Auth->user('user_id'))));
		$categories = $this->Offre->Category->find('list',array('fields'=>'nom'));
		$this->set(compact('appartenances', 'categories'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
 
 	/* ------------------------------------------
	 * espacePerso
	 * ------------------------------------------
	 * Page d'accueil pour l'espace perso d'une entreprise
	 *   -> Accès : groupe entreprises
	 * ------------------------------------------ */
 
	public function edit($id = null) {
		
		// On vérifie que l'offre en question existe
		if (!$this->Offre->exists($id)) {
			throw new NotFoundException(__('Invalid offre'));
		}

		//On ne modifie pas encore, on recupère juste les données à modifier
		$options = array('conditions' => array('Offre.' . $this->Offre->primaryKey => $id));
		$offre= $this->Offre->find('first', $options);

		//On vérifie qu'il s'agit bien de l'auteur de l'offre
		if($this->Offre->PublieOffre->Appartenance->find('count',array(
			'conditions'=>array(
				'Appartenance.appartenance_id'=>$offre["PublieOffre"][0]["appartenance_id"],
				'Appartenance.user_id'=>$this->Auth->user("user_id"))))==1)
		{

			// Si on envoie une requête de modification
			if ($this->request->is(array('post', 'put'))) 
			{

				//On vérifie que l'utilisateur a le droit de poster sous ce nom / dans cette communauté (appartenances).
				$verif=true;
				foreach($this->request->data["PublieOffre"]["appartenance_id"] as $appartenanceid)
				{
					if($this->Offre->PublieOffre->Appartenance->find('count',array('conditions'=>array('Appartenance.appartenance_id'=>$appartenanceid,'Appartenance.user_id'=>$this->Auth->user("user_id"))))!=1)
					{
						$verif=false;
					}
				}

				if($verif)
				{
					//On sauve l'offre
					$offre["Offre"]=$this->request->data["Offre"];
					$offre["Category"]=$this->request->data["Category"];

					if ($this->Offre->saveAll($offre)) 
					{
						//On supprime les anciens publieOffre
						foreach($offre["PublieOffre"] as $publioffre){										
						$this->Offre->PublieOffre->delete($publioffre["publieOffre_id"]);
						}	


						//On sauve les nouveaux publieOffre
						$publieoffre=array();

						foreach($this->request->data["PublieOffre"]["appartenance_id"] as $appid)
						{
							$this->Offre->PublieOffre->create();
							$publieoffre["PublieOffre"]["appartenance_id"]=$appid;
							$publieoffre["PublieOffre"]["offre_id"]=$this->Offre->id;
							if($this->Offre->PublieOffre->save($publieoffre))
							{
								$this->Session->setFlash(__("Votre offre a bien été enregistrée"));
							}
							else
							{
								$this->Session->setFlash("Ca n'a pas marché ...");
							}
						}
						
						return $this->redirect(array('action' => 'mesOffres'));
					} 
					else 
					{
						$this->Session->setFlash(__('The offre could not be saved. Please, try again.'));
					}
				}
				else
				{
					$this->return->redirect(array('controller'=>'acceuil','action'=>'index'));
				}
			} 
			else
			{
				//On enregistre les communautés des publieOffre pour présélectionner les cases :)
				$selected=array();
				foreach ($offre["PublieOffre"] as $puboffre)
				{
					array_push($selected,$puboffre["appartenance_id"]);

				}

				$this->request->data = $offre;
				$this->set('selected',$selected);
				$appartenances = $this->Offre->PublieOffre->Appartenance->find('list',array('recursive'=>1,'fields'=>'Communaute.nom','conditions'=>array('Appartenance.user_id'=>$this->Auth->user('user_id'))));
				$categories = $this->Offre->Category->find('list',array('fields'=>'nom'));
				$this->set(compact('appartenances', 'categories'));
			}
			
			
			
		}
		
	}



/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
 
 	/* ------------------------------------------
	 * espacePerso
	 * ------------------------------------------
	 * Page d'accueil pour l'espace perso d'une entreprise
	 *   -> Accès : groupe entreprises
	 * ------------------------------------------ */
 
	public function delete($id = null) {
		$this->Offre->id = $id;
		if (!$this->Offre->exists()) {
			throw new NotFoundException(__('Invalid offre'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Offre->delete()) {
			$this->Session->setFlash(__('The offre has been deleted.'));
		} else {
			$this->Session->setFlash(__('The offre could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'mesOffres'));
	}

	public function search(){

		
	
		if ($this->request->is('post'))
		{
			//Vérifications
			//A	 faire


			// On récupère toutes les utilisateurs dans les communautés voulues par l'utilisateur
			$conditions=array('Appartenance.communaute_id'=>$this->request->data["appartenance_id"]);
			$appartenances=$this->Offre->PublieOffre->Appartenance->find('all',array('fields'=>'appartenance_id','conditions'=>$conditions,'recursive'=>0));
			
			// On récupère tous les publieOffre, toutes appartenances confondues
			$conditions1=array();
			foreach ($appartenances as $appartenance) {
				array_push($conditions1, $appartenance["Appartenance"]["appartenance_id"]);
			}
			//On détache appartenance pour alléger la requete suivante
			
			$publieoffres=$this->Offre->PublieOffre->find('all',array('conditions'=>array('PublieOffre.appartenance_id'=>$conditions1),'recursive'=>0));

			//On récupère toutes les offres, tous publieOffres confondus
			$conditions2=array();
			foreach	($publieoffres as $publieoffre)
			{
				array_push($conditions2,$publieoffre["PublieOffre"]["offre_id"]);
			}


			if(array_key_exists("Categories",$this->request->data))
			{
				$this->Paginator->settings = array('conditions' => array('Offre.etat'=>1,'Offre.offre_id'=> $conditions2,'titre LIKE'=>"%".$this->request->data["Nom"]."%",'categorie_id'=>$this->request->data["Categories"]),'recursive'=>0);
			}
			else
			{
				$this->Paginator->settings = array('conditions' => array('Offre.etat'=>1,'Offre.offre_id'=> $conditions2,'titre LIKE'=>"%".$this->request->data["Nom"]."%"));
			}
				
			$this->set('offres',$this->Paginator->paginate('Offre',array(),array('Category.nom','titre')));
			$this->set('data',$this->request->data);

		}

		$appartenances = $this->Offre->PublieOffre->Appartenance->find('list',array('recursive'=>1,'fields'=>array('Appartenance.communaute_id','Communaute.nom'),'conditions'=>array('Appartenance.user_id'=>$this->Auth->user('user_id'))));
		$categories = $this->Offre->Category->find('list',array('fields'=>'nom'));
		$this->set(compact('appartenances', 'categories'));
	}


	public function getall($id=null){
		
		

		if($id!=null) //Ne récupềre que les offres de la communauté donnée
		{
			// On récupère toutes les utilisateurs dans la communaute
			$conditions=array('Appartenance.communaute_id'=>$id);
			$appartenances=$this->Offre->PublieOffre->Appartenance->find('all',array('fields'=>'appartenance_id','conditions'=>$conditions,'recursive'=>0));
			
			// On récupère tous les publieOffre, toutes appartenances confondues
			$conditions1=array();
			foreach ($appartenances as $appartenance) {
				array_push($conditions1, $appartenance["Appartenance"]["appartenance_id"]);
			}
			//On détache appartenance pour alléger la requete suivante
			$publieoffres=$this->Offre->PublieOffre->find('all',array('conditions'=>array('PublieOffre.appartenance_id'=>$conditions1),'recursive'=>0));

			//On récupère toutes les offres, tous publieOffres confondus
			$conditions2=array();
			foreach	($publieoffres as $publieoffre)
			{
				array_push($conditions2,$publieoffre["PublieOffre"]["offre_id"]);
			}


			$this->Offre->unbindModel(array('hasMany' => array('Demande','Emprunt')));
			$this->Paginator->settings = array('recursive'=>1,'conditions'=>array('offre_id'=>$conditions2));
		}

		else // On récupère toutes les offres
		{
			$this->Offre->unbindModel(array('hasMany' => array('Demande','Emprunt','PublieOffre')));
			$this->Paginator->settings = array('recursive'=>1);	
		}
		
		$this->set('offres', $this->Paginator->paginate());
	}

	public function addAbus($id=null){

		//Vérification 
		$this->Offre->PublieOffre->Appartenance->unbindModel(
			array('hasMany' => array('Commentaires','Posts','Annonces','PublieOffres','Demandes','Emprunts'),
        	 	 'belongsTo'=>array('Communaute')));
		$this->Offre->Category->unbindModel(
			array('hasAndBelongsToMany'=>array('Annonce,Offre')));
		$this->Offre->unbindModel(
			array('hasMany'=>array('Demande','Emprunte','AbusOffre')));
		$this->Offre->PublieOffre->unbindModel(
			array('belongsTo'=>'Offre'));

		$offre=$this->Offre->find('first',array('conditions'=>array('offre_id'=>$id),'recursive'=>3));

		$communautes=array();

		foreach($offre['PublieOffre'] as $publieOffre)
		{
			array_push($communautes, $publieOffre['Appartenance']['communaute_id']);
		}



		$appartenance=$this->Offre->PublieOffre->Appartenance->find('first',array('conditions'=>array('Appartenance.user_id'=>$this->Auth->user('user_id'),'Appartenance.communaute_id'=>$communautes)));

		//Une personne ne peut signaler qu'une fois le meme offre comme étant abusif!
		$nbAbus=$this->Offre->AbusOffre->find('count',array('conditions'=>array('AbusOffre.appartenance_id'=>$appartenance['Appartenance']['appartenance_id'],'AbusOffre.offre_id'=>$id)));
		
		if($appartenance!=null && $nbAbus==0) //Utilisateur autorisé
		{

			if($this->request->is('post'))
			{
				$this->Offre->AbusOffre->create();
				$addAbus=$this->request->data;
				$addAbus["AbusOffre"]["appartenance_id"]=$appartenance['Appartenance']['appartenance_id'];
				if($this->Offre->AbusOffre->save($addAbus))
				{
					$this->Session->setFlash('Votre signalement a bien été pris en compte. Il sera transmis aux modérateurs');
				}
				else
				{
					$this->Session->setFlash("Désolé, un problème est survenu et votre signalement n'a pas pu être enregistré");
				}
				return $this->redirect(array('controller'=>'offres','action'=>'view',$offre['Offre']['offre_id']));
				
			}

			// On prépare les informations pour les envoyer à la vue			
			$this->set('offre',$offre);
		}
		else if ($nbAbus==0) //Pas autorisé (Offre pas de ses communautés)
		{
			$this->Session->setFlash("Vous n'êtes pas autorisé");
			return $this->redirect(array('controller'=>'acceuils','action'=>'index'));
		}
		else //Déjà signalé
		{
			$this->Session->setFlash("Vous avez déjà signalé cette offre comme abusive!");
			return $this->redirect(array('controller'=>'offres','action'=>'view',$offre['Offre']['offre_id']));
		}

	}

	public function retirerAbus($id=null)
	{
		$offre=$this->Offre->find('first',array('recursive'=>2,'conditions'=>array('offre_id'=>$id)));

		$communaute_id=array();

		foreach($offre['PublieOffre'] as $puboffre)
		{
			array_push($communaute_id, $puboffre['Appartenance']['communaute_id']);
		}
		$appartenance=$this->Offre->PublieOffre->Appartenance->find('first',array('recursive'=>0,'conditions'=>array('Appartenance.user_id'=>$this->Auth->user('user_id'), 'Appartenance.communaute_id'=>$communaute_id, 'Appartenance.role'=>2)));
		
		if(isset($appartenance)&&$appartenance!=null)
		{
			foreach($offre['AbusOffre'] as $abusoffre)
			{
				
				if(!$this->Offre->AbusOffre->delete($abusoffre['abusOffre_id']))
				{
					$this->Session->setFlash("Problème rencontré lors de la suppression d'un abus");
					return $this->redirect($this->referer());
				}
			}
			$this->Session->setFlash('Abus retiré correctement');
			return $this->redirect($this->referer());
		}
		else
		{
			$this->Session->setFlash("Vous n'avez pas l'autorisation");
			return $this->redirect($this->referer());
		}
	}
	

	public function confirmerAbus($id=null)
	{
		$offre=$this->Offre->find('first',array('recursive'=>2,'conditions'=>array('offre_id'=>$id)));
		$communaute_id=array();

		foreach($offre['PublieOffre'] as $puboffre)
		{
			array_push($communaute_id, $puboffre['Appartenance']['communaute_id']);
		}
		$appartenance=$this->Offre->PublieOffre->Appartenance->find('first',array('recursive'=>0,'conditions'=>array('Appartenance.user_id'=>$this->Auth->user('user_id'), 'Appartenance.communaute_id'=>$communaute_id, 'Appartenance.role'=>2)));

		if(isset($appartenance)&&$appartenance!=null)
		{
			foreach($offre['AbusOffre'] as $abusoffre)
			{
				if(!$this->Offre->AbusOffre->delete($abusoffre['abusOffre_id']))
				{
					$this->Session->setFlash("Problème rencontré lors de la suppression d'un abus");
					return $this->redirect($this->referer());
				}
			}
			$this->Session->setFlash('Abus retiré correctement');
			$offre['Offre']['etat']=2;
			if($this->Offre->save($offre))
			{
				$this->Session->setFlash('Abus confirmé, offre retiré');
				return $this->redirect($this->referer());
			}
			else
			{
				$this->Session->setFlash("Problème rencontré lors de la modification de l'etat");
				return $this->redirect($this->referer());
			}

			return $this->redirect($this->referer());
		}
		else
		{
			$this->Session->setFlash("Vous n'avez pas l'autorisation");
			return $this->redirect($this->referer());
		}
	}
}

