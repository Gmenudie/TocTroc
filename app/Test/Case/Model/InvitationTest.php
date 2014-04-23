<?php
App::uses('Invitation', 'Model');

/**
 * Invitation Test Case
 *
 */
class InvitationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.invitation',
		'app.appartenance',
		'app.communaute',
		'app.adress',
		'app.user',
		'app.role',
		'app.abus_profil',
		'app.titre',
		'app.users_titre',
		'app.commentaire',
		'app.post',
		'app.canal',
		'app.abus_post',
		'app.abus_commentaire',
		'app.annonce',
		'app.category',
		'app.annonces_category',
		'app.offre',
		'app.demande',
		'app.emprunt',
		'app.publie_offre',
		'app.abus_offre',
		'app.categories_offre'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Invitation = ClassRegistry::init('Invitation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Invitation);

		parent::tearDown();
	}

}
