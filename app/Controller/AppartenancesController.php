<?php

class AppartenancesController extends AppController {

	public function index(){
		$this->set('appartenances',$this->Appartenance->find('all', array('conditions' => array('Appartenance.user_id' => $this->Auth->User("user_id")), 'recursive'=> 2)));

	}

		public function add() {
		
			if ($this->request->is('post')) {
	            $this->Appartenance->create();
	            $temporaryAppartenance=array();
	            $temporaryAppartenance["Communaute"]=$this->request->data["Communaute"];
	            $temporaryAppartenance["Communaute"]["Adress"]=$this->request->data["Adress"];
	            $temporaryAppartenance["Communaute"]["parametres"]='0';
	            $temporaryAppartenance["Appartenance"]["valide"]='1';
	            $temporaryAppartenance["Appartenance"]["role"]='2';
	            $temporaryAppartenance["Appartenance"]["user_id"]=$this->Auth->user("user_id");

	            if ($this->Appartenance->saveAssociated($temporaryAppartenance,array('deep'=>true))) {
					unset($temporaryAppartenance);
	                $this->Session->setFlash(__('Bienvenue sur TocTroc !'));
	                return $this->redirect( array('controller' => 'appartenances', 'action' => 'index'));
	            }
	            $this->Session->setFlash(__('Erreur'));
	            return $this->redirect( array('controller' => 'appartenances', 'action' => 'index'));
	        }
	    }



	
}