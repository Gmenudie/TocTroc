<?php
/**
 * PublieOffreFixture
 *
 */
class PublieOffreFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'publie_offre';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id_appartient' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'id_offre' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'indexes' => array(
			'PRIMARY' => array('column' => array('id_appartient', 'id_offre'), 'unique' => 1),
			'offre_publie_offre_fk' => array('column' => 'id_offre', 'unique' => 0)
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
			'id_offre' => 1
		),
	);

}
