<?php
/**
 * ProfilFixture
 *
 */
class ProfilFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id_profil' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'nom' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'id_droits' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id_profil', 'unique' => 1),
			'droits_profil_fk' => array('column' => 'id_droits', 'unique' => 0)
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
			'id_profil' => 1,
			'nom' => 'Lorem ipsum dolor sit amet',
			'id_droits' => 1
		),
	);

}
