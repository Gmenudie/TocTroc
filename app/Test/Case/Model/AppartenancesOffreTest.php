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
		'app.offre',
		'app.demande',
		'app.emprunt',
		'app.categories_offre'
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
