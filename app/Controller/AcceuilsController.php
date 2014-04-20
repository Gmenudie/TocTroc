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

		// Si non authentifié on lui affiche l'acceuil classique, avec possibilité de se connecter        
        if ($this->Auth->user("user_id") === null){
        	$this->layout ='unauthentified';
        }

        // Si l'utilisateur est connecté, et qu'il s'agit d'un utilisateur normal, on le redirige vers ses communautés
        else if ($this->Auth->user('role_id')==3)
        {
        	return $this->redirect(array('controller'=>'appartenances','action'=>'index'));
        }

        // S'il s'agit d'un administrateur, on le renvoie vers sa page principale
        else if ($this->Auth->user('role_id')==1)
        {
        	return $this->redirect(array('controller'=>'communautes','action'=>'getall'));
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