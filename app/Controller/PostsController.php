<?php

class PostsController extends AppController {

	public function beforeFilter() {
	    parent::beforeFilter();
	    // Allow users to register and logout.
	    $this->Auth->allow('index','add', 'logout');
	}

	public function index() {
			$this->set('posts', $this->Post->find('all'));
	}
}