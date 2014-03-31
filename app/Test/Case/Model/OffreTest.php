<?php
App::uses('Offre', 'Model');

/**
 * Offre Test Case
 *
 */
class OffreTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.offre',
		'app.category',
		'app.annonce',
		'app.annonces_category',
		'app.categories_offre'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Offre = ClassRegistry::init('Offre');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Offre);

		parent::tearDown();
	}

}
