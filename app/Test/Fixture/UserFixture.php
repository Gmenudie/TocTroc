<?php
/**
 * UserFixture
 *
 */
class UserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'uder_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'prenom' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'nom' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'email' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'image_profil' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'telephone_2' => array('type' => 'integer', 'null' => true, 'default' => null),
		'telephone_2_1' => array('type' => 'integer', 'null' => true, 'default' => null),
		'telephone_3' => array('type' => 'integer', 'null' => true, 'default' => null),
		'date' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'adresse_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'role_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'uder_id', 'unique' => 1),
			'profil_user_fk' => array('column' => 'role_id', 'unique' => 0),
			'adresse_user_fk' => array('column' => 'adresse_id', 'unique' => 0)
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
			'uder_id' => 1,
			'prenom' => 'Lorem ipsum dolor sit amet',
			'nom' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'image_profil' => 'Lorem ipsum dolor sit amet',
			'telephone_2' => 1,
			'telephone_2_1' => 1,
			'telephone_3' => 1,
			'date' => '2014-03-31 10:33:06',
			'adresse_id' => 1,
			'role_id' => 1
		),
	);

}
