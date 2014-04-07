<?php
App::uses('Commente', 'Model');

/**
 * Commente Test Case
 *
 */
class CommenteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.commente',
		'app.appartenance',
		'app.post'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Commente = ClassRegistry::init('Commente');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Commente);

		parent::tearDown();
	}

}
