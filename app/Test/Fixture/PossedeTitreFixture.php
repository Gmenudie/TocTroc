<?php
/**
 * PossedeTitreFixture
 *
 */
class PossedeTitreFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'possede_titre';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id_user' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'id_titre' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'indexes' => array(
			'PRIMARY' => array('column' => array('id_user', 'id_titre'), 'unique' => 1),
			'titre_possede_titre_fk' => array('column' => 'id_titre', 'unique' => 0)
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
			'id_user' => 1,
			'id_titre' => 1
		),
	);

}
