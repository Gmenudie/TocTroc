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
		

		$conditions=array('Appartenance.user_id'=>$this->Auth->user('user_id'));
		$appartenances=$this->Offre->Appartenance->find('all',array('fields'=>'appartenance_id','conditions'=>$conditions,'recursive'=>0));
		$conditions1=array();
		foreach ($appartenances as $appartenance) {
			array_push($conditions1, $appartenance["Appartenance"]["appartenance_id"]);
		}
		
		$this->Paginator->settings = array('conditions' => array('Offre.appartenance_id'=> $conditions1));
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
	 * Page d'accueil pour l'espace perso d'une entreprise
	 *   -> Accès : groupe entreprises
	 * ------------------------------------------ */
 
	public function view($id = null) {
		if (!$this->Offre->exists($id)) {
			throw new NotFoundException(__('Invalid offre'));
		}
		$options = array('conditions' => array('Offre.' . $this->Offre->primaryKey => $id));
		$offre=$this->Offre->find('first', $options);
		$appartient=$this->Offre->Appartenance->find('first', array('conditions'=>array('Appartenance.communaute_id'=>$offre["Appartenance"]["communaute_id"], 'Appartenance.user_id'=>$this->Auth->user('user_id'))));
		if($appartient!=null){		
		$this->set('offre', $offre);
	}
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
			$this->Offre->create();
			if ($this->Offre->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The offre has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The offre could not be saved. Please, try again.'));
			}
		}
		$appartenances = $this->Offre->Appartenance->find('list');
		$categories = $this->Offre->Category->find('list');
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
		if (!$this->Offre->exists($id)) {
			throw new NotFoundException(__('Invalid offre'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Offre->save($this->request->data)) {
				$this->Session->setFlash(__('The offre has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The offre could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Offre.' . $this->Offre->primaryKey => $id));
			$this->request->data = $this->Offre->find('first', $options);
		}
		$appartenances = $this->Offre->Appartenance->find('list');
		$categories = $this->Offre->Category->find('list');
		$this->set(compact('appartenances', 'categories'));
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
		return $this->redirect(array('action' => 'index'));
	}}
