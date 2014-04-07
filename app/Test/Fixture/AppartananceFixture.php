<?php
/**
 * AppartananceFixture
 *
 */
class AppartananceFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'appartenance_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'communaute_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'valide' => array('type' => 'integer', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'appartenance_id', 'unique' => 1),
			'communaute_appartient_fk' => array('column' => 'communaute_id', 'unique' => 0),
			'user_appartient_fk' => array('column' => 'user_id', 'unique' => 0)
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
			'appartenance_id' => 1,
			'communaute_id' => 1,
			'user_id' => 1,
			'valide' => 1
		),
	);

}
