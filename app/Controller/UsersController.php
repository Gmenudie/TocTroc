<?php

class UsersController extends AppController {

	public function beforeFilter() {
	    parent::beforeFilter();
	    // Allow users to register and logout.
	    $this->Auth->allow('add', 'logout');
	}


	public function login() {
		$this->layout='unauthentified';
	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	            return $this->redirect($this->Auth->redirect());
	        }
	        $this->Session->setFlash(__('Indentifiant ou mot de passe invalide'));
	    }
	}

	public function logout() {
	    return $this->redirect($this->Auth->logout());
	}

	public function add() {

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


}