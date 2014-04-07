<?php
/**
 * DroitFixture
 *
 */
class DroitFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id_droits' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'exemple_droit_1' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'exemple_droit_2' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id_droits', 'unique' => 1)
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
			'id_droits' => 1,
			'exemple_droit_1' => 1,
			'exemple_droit_2' => 1
		),
	);

}
