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
	public $table = 'publieOffre';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'publieOffre_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'appartenance_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'offre_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'publieOffre_id', 'unique' => 1),
			'appartient_publie_offre_fk' => array('column' => 'appartenance_id', 'unique' => 0),
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
			'publieOffre_id' => 1,
			'appartenance_id' => 1,
			'offre_id' => 1
		),
	);

}
