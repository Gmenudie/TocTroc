<?php

class AcceuilsController extends AppController {
	
	

	public function beforeFilter() {
        $this->Auth->allow('index');

        if ($this->Auth->user("user_id") === null){
        	$this->layout ='unauthentified';
        }
        
    }

	public function index() {		
		
	}


	

}