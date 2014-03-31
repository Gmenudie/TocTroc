<?php
App::uses('Demande', 'Model');

/**
 * Demande Test Case
 *
 */
class DemandeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.demande',
		'app.appartenance',
		'app.offre'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Demande = ClassRegistry::init('Demande');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Demande);

		parent::tearDown();
	}

}
