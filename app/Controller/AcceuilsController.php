<?php

class AcceuilsController extends AppController {
	
	/* Liste des actions du controller
	 * 
	 * 1. beforeFilter()
	 * 2. index()
	 *
	 */
	

	/* ------------------------------------------
	 * beforeFilter()
	 * ------------------------------------------
	 * fonction générique dans un controlleur, définit les instructions qui doivent être exécutées avant d'appeler 
	 * une quelconque fonction du controlleur en question. Ici, on vérifie si le visiteur est connecté et on adapte le layout
	 * de la page d'acceuil en fonction
	 * ------------------------------------------ */
	
	public function beforeFilter() {

		$this->Auth->allow();
        
        if ($this->Auth->user("user_id") === null){
        	$this->layout ='unauthentified';
        }
        
    }

    /* ------------------------------------------
	 * index()
	 * ------------------------------------------
	 * affiche notre page d'acceuil.
	 * Permet au visiteur de s'inscrire, ou de se connecter (il passe alors à AppartenancesController -> index())
	 * ------------------------------------------ */

	public function index() {		
		
	}


	

}