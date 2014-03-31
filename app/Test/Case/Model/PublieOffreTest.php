<?php
App::uses('PublieOffre', 'Model');

/**
 * PublieOffre Test Case
 *
 */
class PublieOffreTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.publie_offre'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PublieOffre = ClassRegistry::init('PublieOffre');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PublieOffre);

		parent::tearDown();
	}

}
