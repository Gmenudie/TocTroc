<?php
App::uses('Appartanance', 'Model');

/**
 * Appartanance Test Case
 *
 */
class AppartananceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.appartanance',
		'app.communaute',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Appartanance = ClassRegistry::init('Appartanance');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Appartanance);

		parent::tearDown();
	}

}
