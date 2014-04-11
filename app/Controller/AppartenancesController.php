<?php

class AppartenancesController extends AppController {

	/* Liste des actions du controller
	 * 
	 * 1. index()
	 * 2. add()
	 *
	 * Remarque: ce controller est central car c'est lui qui permet de représenter l'action d'un utilisateur donné dans une communauté donnée.
	 *
	 */


	/* ------------------------------------------
	 * index
	 * ------------------------------------------
	 * C'est la page sur laquelle tombe un utilisateur lorsqu'il est authentifié.
	 * On trouve toutes ses communautés (= appartenances) et on lui propose de choisir dans laquelle il veut aller.
	 * Par défaut, on renvoie au wall de la communauté (PostsController -> index()), il peut gérér les offres via le menu de navigation.
	 * ------------------------------------------ */

	public function index(){
		$this->set('appartenances',$this->Appartenance->find('all', array('conditions' => array('Appartenance.user_id' => $this->Auth->User("user_id")), 'recursive'=> 2)));

	}

	
	/* ------------------------------------------
	 * add
	 * ------------------------------------------
	 * Permet de créer une nouvelle communauté. L'utilisateur peut en même temps entrer l'adresse de sa communauté, elle sera enregistrée.
	 * L'utilisateur est directement ajouté comme Modérateur de sa communauté.
	 * ------------------------------------------ */
	
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

			if ($this->Appartenance->saveAssociated($temporaryAppartenance,array('deep'=>true))) {
				unset($temporaryAppartenance);
				$this->Session->setFlash(__('Bienvenue sur TocTroc !'));
				return $this->redirect( array('controller' => 'appartenances', 'action' => 'index'));
			}
			$this->Session->setFlash(__('Erreur'));
			return $this->redirect( array('controller' => 'appartenances', 'action' => 'index'));
		}
	}



	
}