<?php
App::uses('Annonce', 'Model');

/**
 * Annonce Test Case
 *
 */
class AnnonceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.annonce',
		'app.category',
		'app.annonces_category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Annonce = ClassRegistry::init('Annonce');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Annonce);

		parent::tearDown();
	}

}
