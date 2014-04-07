<?php

class CommunautesController extends AppController {


	

	

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