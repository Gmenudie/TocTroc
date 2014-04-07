<?php
App::uses('Appartient', 'Model');

/**
 * Appartient Test Case
 *
 */
class AppartientTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.appartient'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Appartient = ClassRegistry::init('Appartient');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Appartient);

		parent::tearDown();
	}

}
