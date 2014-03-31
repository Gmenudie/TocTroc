<?php
App::uses('AppartenancesOffre', 'Model');

/**
 * AppartenancesOffre Test Case
 *
 */
class AppartenancesOffreTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.appartenances_offre',
		'app.offre'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->AppartenancesOffre = ClassRegistry::init('AppartenancesOffre');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AppartenancesOffre);

		parent::tearDown();
	}

}
