<?php
App::uses('AnnoncePossedeCategorie', 'Model');

/**
 * AnnoncePossedeCategorie Test Case
 *
 */
class AnnoncePossedeCategorieTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.annonce_possede_categorie'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->AnnoncePossedeCategorie = ClassRegistry::init('AnnoncePossedeCategorie');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AnnoncePossedeCategorie);

		parent::tearDown();
	}

}
