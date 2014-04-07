<?php
/**
 * AppartenancesOffreFixture
 *
 */
class AppartenancesOffreFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'appartenance_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'offre_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'indexes' => array(
			'PRIMARY' => array('column' => array('appartenance_id', 'offre_id'), 'unique' => 1),
			'offre_publie_offre_fk' => array('column' => 'offre_id', 'unique' => 0)
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
			'offre_id' => 1
		),
	);

}
