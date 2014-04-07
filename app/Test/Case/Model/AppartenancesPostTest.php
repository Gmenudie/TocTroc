<?php
App::uses('AppartenancesPost', 'Model');

/**
 * AppartenancesPost Test Case
 *
 */
class AppartenancesPostTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.appartenances_post',
		'app.appartenance'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->AppartenancesPost = ClassRegistry::init('AppartenancesPost');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AppartenancesPost);

		parent::tearDown();
	}

}
