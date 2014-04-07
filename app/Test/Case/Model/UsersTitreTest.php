<?php
App::uses('UsersTitre', 'Model');

/**
 * UsersTitre Test Case
 *
 */
class UsersTitreTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.users_titre',
		'app.titre',
		'app.user',
		'app.adresse',
		'app.role',
		'app.appartanance',
		'app.communaute'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UsersTitre = ClassRegistry::init('UsersTitre');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UsersTitre);

		parent::tearDown();
	}

}
