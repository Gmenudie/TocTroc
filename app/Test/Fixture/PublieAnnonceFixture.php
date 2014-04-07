<?php
/**
 * PublieAnnonceFixture
 *
 */
class PublieAnnonceFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'publie_annonce';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id_appartient' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'id_annonce' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'indexes' => array(
			'PRIMARY' => array('column' => array('id_appartient', 'id_annonce'), 'unique' => 1),
			'annonce_publie_annonce_fk' => array('column' => 'id_annonce', 'unique' => 0)
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
			'id_annonce' => 1
		),
	);

}
