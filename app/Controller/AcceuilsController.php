<?php

class AcceuilsController extends AppController {
	
	

	public function beforeFilter() {
        $this->Auth->allow('index');
        $this->layout ='unauthentified';
    }

	public function index() {		
		
	}


	

}