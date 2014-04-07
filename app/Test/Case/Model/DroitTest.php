<?php
App::uses('Droit', 'Model');

/**
 * Droit Test Case
 *
 */
class DroitTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.droit'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Droit = ClassRegistry::init('Droit');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Droit);

		parent::tearDown();
	}

}
