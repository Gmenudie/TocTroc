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
		'app.demande',
		'app.appartenance',
		'app.communaute',
		'app.adress',
		'app.user',
		'app.role',
		'app.titre',
		'app.users_titre',
		'app.commentaire',
		'app.post',
		'app.canal',
		'app.annonce',
		'app.category',
		'app.annonces_category',
		'app.categories_offre',
		'app.emprunt',
		'app.appartenances_offre'
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
