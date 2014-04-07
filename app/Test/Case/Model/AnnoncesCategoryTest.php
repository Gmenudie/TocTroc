<?php
App::uses('AnnoncesCategory', 'Model');

/**
 * AnnoncesCategory Test Case
 *
 */
class AnnoncesCategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.annonces_category',
		'app.categorie'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->AnnoncesCategory = ClassRegistry::init('AnnoncesCategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AnnoncesCategory);

		parent::tearDown();
	}

}
