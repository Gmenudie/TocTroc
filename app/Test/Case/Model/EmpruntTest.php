<?php
App::uses('Emprunt', 'Model');

/**
 * Emprunt Test Case
 *
 */
class EmpruntTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.emprunt',
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
		$this->Emprunt = ClassRegistry::init('Emprunt');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Emprunt);

		parent::tearDown();
	}

}
