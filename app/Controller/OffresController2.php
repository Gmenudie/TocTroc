<?php

class OffresController extends AppController {

	/* Liste des actions du controller
	 * 
	 * 1. beforeFilter()
	 * 2. index()
	 * 3. add()
	 *
	 */

	/* ------------------------------------------
	 * espacePerso
	 * ------------------------------------------
	 * Page d'accueil pour l'espace perso d'une entreprise
	 *   -> Accès : groupe entreprises
	 * ------------------------------------------ */

	public function beforeFilter() {
	    parent::beforeFilter();
	    // Allow users to register and logout.
	    $this->Auth->allow('index','add', 'logout');
	}

	
	/* ------------------------------------------
	 * espacePerso
	 * ------------------------------------------
	 * Page d'accueil pour l'espace perso d'une entreprise
	 *   -> Accès : groupe entreprises
	 * ------------------------------------------ */
	
	public function index() {


		$$appartenances=$this->Offre->Appartenance->find('all',array('conditions'=>array('Appartenance.user_id'=>$this->Auth->user('user_id')),array('recursive'=>1)));

		$i;
		$j;
		$offres=array();
		$communautes=array();
		$cates=array();
		

		foreach($appartenances as $appartenance){

			$offresinter=$this->Offre->find('all',array('conditions'=>array('Offre.appartenance_id'=>$appartenance["Appartenance"]["appartenance_id"])));
			if($offresinter!=null){

			foreach ($offresinter as $offreinter);{
				$offres[count($offres)]=$offreinter;
			}}

			$communaute[$appartenance["Appartenance"]["appartenance_id"]]=$appartenance["Communaute"]["nom"];
		}

		$categories=$this->Offre->Category->find("all",array('recursive'=>0));
		foreach ($categories as $categorie) {
			$cates[$categorie["Category"]["categorie_id"]]=$categorie["Category"]["nom"];
		}



		}

		$this->set('offres',$offres);
		$this->set('appartenances', $this->Offre->Appartenance->find('list',array('conditions'=>array('Appartenance.user_id'=>$this->Auth->user('user_id'))));
		$this->set('categories', $this->Offre->Categories->find('list'));

		

			
	}


	
	/* ------------------------------------------
	 * espacePerso
	 * ------------------------------------------
	 * Page d'accueil pour l'espace perso d'une entreprise
	 *   -> Accès : groupe entreprises
	 * ------------------------------------------ */
	
	public function add(){

		if ($this->request->is('post')) {
			$appartient=$this->Offre->Appartenance->find('first',array('conditions'=>array("Appartenance.appartenance_id"=>$this->request->data["Offre"]["appartenance_id"])));
			if($appartient!=null && $appartient["Appartenance"]["user_id"]===$this->Auth->user('user_id')){	            

	            $this->Offre->create();
	            if ($this->Offre->saveAll($this->request->data)) {
					
	                $this->Session->setFlash(__('Votre Offre a bien été enregistré'));
	                return $this->redirect( array('controller' => 'Offres', 'action' => 'index', $appartient["Appartenance"]["appartenance_id"]));
	            }
	            $this->Session->setFlash(__('Erreur'));
	        }

	        }



	}
		
	
}
