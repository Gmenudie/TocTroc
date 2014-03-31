<?php
App::uses('Communaute', 'Model');

/**
 * Communaute Test Case
 *
 */
class CommunauteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.communaute',
		'app.adresse'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Communaute = ClassRegistry::init('Communaute');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Communaute);

		parent::tearDown();
	}

}
