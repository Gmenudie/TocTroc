<?php

class CommunautesController extends AppController {

	public function beforeFilter(){
	parent::beforeFilter();

	}	

	public function add()
	{
			
		
		if ($this->request->is('post')) {
			$this->Communaute->create();
			$temporaryCommunaute=array();
			$temporaryCommunaute=$this->request->data; 
			$temporaryCommunaute["Communaute"]["parametres"]='0';

			if ($this->Communaute->saveAll($temporaryCommunaute)) {
					
				unset($temporaryCommunaute);
				$this->Session->setFlash(__('La communauté a bien été rajoutée.'), 'success');
				return $this->redirect( array('controller' => 'appartenances', 'action' => 'index'));
			}
			$this->Session->setFlash(__('Erreur lors de l\'enregistrement', 'error'));
		}
	}

		
	public function getall(){
		

		$this->Paginator->settings = array('recursive'=>0);
		$this->set('communautes', $this->Paginator->paginate());
	}

}

?>