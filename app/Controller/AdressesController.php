<?php
App::uses('AppController', 'Controller');
/**
 * Adresses Controller
 *
 * @property Adress $Adress
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AdressesController extends AppController {

	/* Liste des actions du controller
	 * 
	 * 1. index()
	 * 2. view($id = null)
	 * 3. add()
	 * 4. edit($id = null)
	 * 5. delete($id = null)
	 *
	 */


	/* Remarque: ce controlleur a totalement été crée par scaffolding, en utilisant la commande de console cake bake.
	 * Je l'ai fait parce que j'avais des problèmes dans la prise en charge du modèle, ça m'a aidé à les résoudre.
	 * Je garde ce fichier parce qu'il m'aide à structurer certaines fonctions et à utiliser Paginator,
	 * mais aucune de ces fonctions ni des vue n'est utilisée par notre appli. Vous pouvez donc sauter cette page!


/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
 
	/* ------------------------------------------
	 * espacePerso
	 * ------------------------------------------
	 * Page d'accueil pour l'espace perso d'une entreprise
	 *   -> Accès : groupe entreprises
	 * ------------------------------------------ */
 
	public function index() {
		$this->Adress->recursive = 0;
		$this->set('adresses', $this->Paginator->paginate());
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
	 * Page d'accueil pour l'espace perso d'une entreprise
	 *   -> Accès : groupe entreprises
	 * ------------------------------------------ */
 
	public function view($id = null) {
		if (!$this->Adress->exists($id)) {
			throw new NotFoundException(__('Invalid adress'));
		}
		$options = array('conditions' => array('Adress.' . $this->Adress->primaryKey => $id));
		$this->set('adress', $this->Adress->find('first', $options));
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
		if ($this->request->is('post')) {
			$this->Adress->create();
			if ($this->Adress->save($this->request->data)) {
				$this->Session->setFlash(__('The adress has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The adress could not be saved. Please, try again.'));
			}
		}
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
		if (!$this->Adress->exists($id)) {
			throw new NotFoundException(__('Invalid adress'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Adress->save($this->request->data)) {
				$this->Session->setFlash(__('The adress has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The adress could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Adress.' . $this->Adress->primaryKey => $id));
			$this->request->data = $this->Adress->find('first', $options);
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
		$this->Adress->id = $id;
		if (!$this->Adress->exists()) {
			throw new NotFoundException(__('Invalid adress'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Adress->delete()) {
			$this->Session->setFlash(__('The adress has been deleted.'));
		} else {
			$this->Session->setFlash(__('The adress could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
