<?php
App::uses('Titre', 'Model');

/**
 * Titre Test Case
 *
 */
class TitreTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.titre',
		'app.user',
		'app.users_titre'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Titre = ClassRegistry::init('Titre');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Titre);

		parent::tearDown();
	}

}
