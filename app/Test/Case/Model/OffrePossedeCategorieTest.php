<?php
App::uses('OffrePossedeCategorie', 'Model');

/**
 * OffrePossedeCategorie Test Case
 *
 */
class OffrePossedeCategorieTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.offre_possede_categorie'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->OffrePossedeCategorie = ClassRegistry::init('OffrePossedeCategorie');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->OffrePossedeCategorie);

		parent::tearDown();
	}

}
