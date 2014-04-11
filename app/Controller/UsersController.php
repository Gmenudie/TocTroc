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
	
	public function add($id = null) {

		
		
		/* On envoie une variable à la vue s'il s'agit d'un ajout de membre (= s'il n'y a pas de paramètres $id) */
		if(isset($id) == false)
		{
			$this->layout='unauthentified';
			$this->set('ajout', 1);
		}
		else
		{
			/* Il s'agit d'une modification*/
			$this->layout='default';
		}
				
		/* On regarde si le formulaire a été validé */
		if (empty($this->data) == false)
		{
			
			if(isset($this->data['User']['user_id']))
			{
				/* Il s'agit d'une modification , on vérifie si le mail n'est pas déjà utilisé s'il a été modifié*/
				$email = $this->User->findByUserId($id)['User']['email'];
				$newEmail = $this->data['User']['email'];
				
				if($email == $newEmail)
				{
					/* L'email n'a pas changé */
					$this->User->save($this->data);
					$this->Session->setFlash('Vos données ont été modifiées', 'success');
					$this->redirect(array('controller' => 'users', 'action' => 'monCompte'));
				}
				else
				{
					$requete = $this->User->find('count', array('conditions' => array('email' => $newEmail)));
					
					if($requete == 0)
					{
						/* L'email n'est pas déjà utilisé */
						$this->User->save($this->data);
						$this->Session->setFlash('Vos données ont été modifiées', 'success');
						$this->redirect(array('controller' => 'users', 'action' => 'monCompte'));
					}
					else
					{
					/* L'email est déjà pris */
					$this->Session->setFlash('Cet email est déjà utilisé, désolé', 'error');
					}
				}
			}
			
			else
			{
				/*Il s'agit d'un ajout, on vérifie si le mail n'est pas déjà utilisé */
				$email = $this->data['User']['email'];
				$requete = $this->User->find('count', array('conditions' => array('email' => $email)));
				
				if($requete == 0)
				{
					$this->User->create();
					$temporaryUser=array();
					$temporaryUser=$this->request->data;
					$temporaryUser["User"]["role_id"]='3';
				

					if ($this->User->save($temporaryUser))
					{   	
						unset($temporaryUser);
						$this->Session->setFlash(__('Bienvenue sur TocTroc !'));
						return $this->redirect( array('controller' => 'acceuils', 'action' => 'index'));
					}
				}
				
				else
				{
					/* L'email est déjà pris */
					$this->Session->setFlash('Cet email est déjà utilisé, désolé', 'error');
				}
			}
			
		}
		elseif($id != null)
		{
			/* Formulaire vide, mais il y a un paramètre (c'est une modification, on charge ce qui est déjà écrit)*/
			$this->User->user_id;
			$this->request->data = $this->User->findByUserId($id);
		}
		else
		{
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