<?php
/**
 * AnnoncesCategoryFixture
 *
 */
class AnnoncesCategoryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'annonce_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'categorie_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'indexes' => array(
			'PRIMARY' => array('column' => array('annonce_id', 'categorie_id'), 'unique' => 1),
			'categorie_annonce_possede_categorie_fk' => array('column' => 'categorie_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_bin', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'annonce_id' => 1,
			'categorie_id' => 1
		),
	);

}
