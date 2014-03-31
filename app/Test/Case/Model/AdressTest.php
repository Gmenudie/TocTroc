<?php
App::uses('Adress', 'Model');

/**
 * Adress Test Case
 *
 */
class AdressTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.adress'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Adress = ClassRegistry::init('Adress');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Adress);

		parent::tearDown();
	}

}
