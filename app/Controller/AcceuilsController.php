<?php

class AcceuilsController extends AppController {
	
	/* Liste des actions du controller
	 * 
	 * 1. beforeFilter()
	 *
	 */
	

	/* ------------------------------------------
	 * espacePerso
	 * ------------------------------------------
	 * Page d'accueil pour l'espace perso d'une entreprise
	 *   -> Accès : groupe entreprises
	 * ------------------------------------------ */
	
	public function beforeFilter() {
        $this->Auth->allow('index');

        if ($this->Auth->user("user_id") === null){
        	$this->layout ='unauthentified';
        }
        
    }

	public function index() {		
		
	}


	

}