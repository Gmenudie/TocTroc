<?php

class PostsController extends AppController {

	public function index() {
			$this->set('posts', $this->Post->find('all'));
	}
}