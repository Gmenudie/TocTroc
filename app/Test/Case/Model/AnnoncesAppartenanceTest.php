<?php
App::uses('AnnoncesAppartenance', 'Model');

/**
 * AnnoncesAppartenance Test Case
 *
 */
class AnnoncesAppartenanceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.annonces_appartenance',
		'app.annonce',
		'app.category',
		'app.annonces_category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->AnnoncesAppartenance = ClassRegistry::init('AnnoncesAppartenance');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AnnoncesAppartenance);

		parent::tearDown();
	}

}
