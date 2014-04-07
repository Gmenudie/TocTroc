<?php
/**
 * AnnoncesAppartenanceFixture
 *
 */
class AnnoncesAppartenanceFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'appartenance_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'annonce_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'indexes' => array(
			'PRIMARY' => array('column' => array('appartenance_id', 'annonce_id'), 'unique' => 1),
			'annonce_publie_annonce_fk' => array('column' => 'annonce_id', 'unique' => 0)
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
			'annonce_id' => 1
		),
	);

}
