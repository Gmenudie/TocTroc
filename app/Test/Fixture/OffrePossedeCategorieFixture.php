<?php
/**
 * OffrePossedeCategorieFixture
 *
 */
class OffrePossedeCategorieFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'offre_possede_categorie';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id_offre' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'id_categorie' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'indexes' => array(
			'PRIMARY' => array('column' => array('id_offre', 'id_categorie'), 'unique' => 1),
			'categorie_offre_possede_categorie_fk' => array('column' => 'id_categorie', 'unique' => 0)
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
			'id_offre' => 1,
			'id_categorie' => 1
		),
	);

}
