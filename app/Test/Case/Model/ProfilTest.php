<?php
App::uses('Profil', 'Model');

/**
 * Profil Test Case
 *
 */
class ProfilTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.profil'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Profil = ClassRegistry::init('Profil');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Profil);

		parent::tearDown();
	}

}
