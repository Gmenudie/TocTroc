<?php
/**
 * PubliePostFixture
 *
 */
class PubliePostFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'publie_post';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id_post' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'id_appartient' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'indexes' => array(
			'PRIMARY' => array('column' => array('id_post', 'id_appartient'), 'unique' => 1),
			'appartient_publie_post_fk' => array('column' => 'id_appartient', 'unique' => 0)
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
			'id_post' => 1,
			'id_appartient' => 1
		),
	);

}
