<?php

class CommunautesController extends AppController {

	/* Liste des actions du controller
	 * 
	 * 1. add()
	 *
	 */
	

	/* ------------------------------------------
	 * espacePerso
	 * ------------------------------------------
	 * Page d'accueil pour l'espace perso d'une entreprise
	 *   -> Accès : groupe entreprises
	 * ------------------------------------------ */

	public function add() {
		
		if ($this->request->is('post')) {
			$this->Communaute->create();
			$temporaryCommunaute=array();
			$temporaryCommunaute=$this->request->data; 
			$temporaryCommunaute["Communaute"]["parametres"]='0';

			if ($this->Communaute->saveAll($temporaryCommunaute)) {
					
				unset($temporaryCommunaute);
				$this->Session->setFlash(__('Bienvenue sur TocTroc !'));
				return $this->redirect( array('controller' => 'appartenances', 'action' => 'index'));
			}
			$this->Session->setFlash(__('Erreur'));
		}
	}


	





}