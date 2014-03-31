<?php
/**
 * AppartientFixture
 *
 */
class AppartientFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'appartient';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id_appartient' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'id_communaute' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'id_user' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'valide' => array('type' => 'integer', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id_appartient', 'unique' => 1),
			'communaute_appartient_fk' => array('column' => 'id_communaute', 'unique' => 0),
			'user_appartient_fk' => array('column' => 'id_user', 'unique' => 0)
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
			'id_appartient' => 1,
			'id_communaute' => 1,
			'id_user' => 1,
			'valide' => 1
		),
	);

}
