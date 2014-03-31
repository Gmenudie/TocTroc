<?php
App::uses('PubliePost', 'Model');

/**
 * PubliePost Test Case
 *
 */
class PubliePostTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.publie_post'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PubliePost = ClassRegistry::init('PubliePost');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PubliePost);

		parent::tearDown();
	}

}
