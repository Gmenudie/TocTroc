<?php
/**
 * AppartenancesPostFixture
 *
 */
class AppartenancesPostFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'post_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'appartenance_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'indexes' => array(
			'PRIMARY' => array('column' => array('post_id', 'appartenance_id'), 'unique' => 1),
			'appartient_publie_post_fk' => array('column' => 'appartenance_id', 'unique' => 0)
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
			'post_id' => 1,
			'appartenance_id' => 1
		),
	);

}
