<?php
App::uses('CategoriesOffre', 'Model');

/**
 * CategoriesOffre Test Case
 *
 */
class CategoriesOffreTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.categories_offre',
		'app.categorie'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CategoriesOffre = ClassRegistry::init('CategoriesOffre');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CategoriesOffre);

		parent::tearDown();
	}

}
