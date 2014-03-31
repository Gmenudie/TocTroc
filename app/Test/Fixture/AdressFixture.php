<?php
/**
 * AdressFixture
 *
 */
class AdressFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'adresse_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'numero' => array('type' => 'integer', 'null' => true, 'default' => null),
		'rue' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'code_postal' => array('type' => 'integer', 'null' => true, 'default' => null),
		'ville' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'numero_appartement' => array('type' => 'integer', 'null' => true, 'default' => null),
		'etage' => array('type' => 'integer', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'adresse_id', 'unique' => 1)
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
			'adresse_id' => 1,
			'numero' => 1,
			'rue' => 'Lorem ipsum dolor sit amet',
			'code_postal' => 1,
			'ville' => 'Lorem ipsum dolor sit amet',
			'numero_appartement' => 1,
			'etage' => 1
		),
	);

}
