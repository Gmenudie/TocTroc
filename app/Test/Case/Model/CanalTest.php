<?php
App::uses('Canal', 'Model');

/**
 * Canal Test Case
 *
 */
class CanalTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.canal'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Canal = ClassRegistry::init('Canal');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Canal);

		parent::tearDown();
	}

}
