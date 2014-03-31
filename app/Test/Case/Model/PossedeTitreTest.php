<?php
App::uses('PossedeTitre', 'Model');

/**
 * PossedeTitre Test Case
 *
 */
class PossedeTitreTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.possede_titre'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PossedeTitre = ClassRegistry::init('PossedeTitre');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PossedeTitre);

		parent::tearDown();
	}

}
