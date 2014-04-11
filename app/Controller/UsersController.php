<?php

class UsersController extends AppController {

	/* Liste des actions du controller
	 * 
	 * 1. beforeFilter()
	 * 2. login()
	 * 3. logout()
	 * 4. add()
	 * 5. monCompte()
	 *
	 * Assez logiquement, ce controller gère l'authentification et l'inscription. Rien de bien sorcier.
	 */

	 /* ------------------------------------------
	 * beforeFilter()
	 * ------------------------------------------
	 * Parce qu'un utilisateur non authentifié a quand même le droit de s'inscrire, se login ou se logout!
	 * ------------------------------------------ */
	 
	public function beforeFilter() {
	    parent::beforeFilter();
	    // Allow users to register and logout.
	    $this->Auth->allow('add', 'logout');
	}


	/* ------------------------------------------
	 * login
	 * ------------------------------------------
	 * Fonction standard de Cake
	 * ------------------------------------------ */
	 
	public function login() {
		$this->layout='unauthentified';
	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	            return $this->redirect($this->Auth->redirect());
	        }
	        $this->Session->setFlash(__('Identifiant ou mot de passe invalide'));
	    }
	}

	
	/* ------------------------------------------
	 * logout
	 * ------------------------------------------
	 * Fonction standard de Cake
	 * ------------------------------------------ */
	
	public function logout() {
	    return $this->redirect($this->Auth->logout());
	}

	
	/* ------------------------------------------
	 * add
	 * ------------------------------------------
	 * Gestion d'inscription basique
	 * ------------------------------------------ */
	
	public function add() {

		if ($this->Auth->user("user_id") != null){
        	return $this->redirect(array('controller'=>'appartenances', 'action'=>'index'));
        }
        
			$this->layout='unauthentified';

	        if ($this->request->is('post')) {
	            $this->User->create();
	            $temporaryUser=array();
	            $temporaryUser=$this->request->data;
	            $temporaryUser["User"]["role_id"]='3';

	            if ($this->User->save($temporaryUser)) {   	
					unset($temporaryUser);
	                $this->Session->setFlash(__('Bienvenue sur TocTroc !'));
	                return $this->redirect( array('controller' => 'acceuils', 'action' => 'index'));
	            }
	            $this->Session->setFlash(__('Erreur'));
	        }

    }

	
	/* ------------------------------------------
	 * monCompte
	 * ------------------------------------------
	 * Accès à son compte et possibilité de le modifier
	 * ------------------------------------------ */
	 
	 public function monCompte() {
		$this->set('user',$this->User->find('all', array('conditions' => array('user_id' => $this->Auth->User("user_id")), 'recursive'=> 1)));
	 }
	

}