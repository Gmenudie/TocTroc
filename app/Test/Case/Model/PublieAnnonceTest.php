<?php
App::uses('PublieAnnonce', 'Model');

/**
 * PublieAnnonce Test Case
 *
 */
class PublieAnnonceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.publie_annonce'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PublieAnnonce = ClassRegistry::init('PublieAnnonce');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PublieAnnonce);

		parent::tearDown();
	}

}
