<?php
/**
 * CommenteFixture
 *
 */
class CommenteFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'commente';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'commentaire_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'appartenance_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'post_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'indexes' => array(
			'PRIMARY' => array('column' => array('commentaire_id', 'appartenance_id', 'post_id'), 'unique' => 1),
			'post_commente_fk' => array('column' => 'post_id', 'unique' => 0),
			'appartient_commente_fk' => array('column' => 'appartenance_id', 'unique' => 0)
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
			'commentaire_id' => 1,
			'appartenance_id' => 1,
			'post_id' => 1
		),
	);

}
