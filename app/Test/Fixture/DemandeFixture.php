<?php
/**
 * DemandeFixture
 *
 */
class DemandeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id_demande' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'appartenance_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'offre_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'date_emprunt' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'date_retour' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'date_demande' => array('type' => 'integer', 'null' => false, 'default' => null),
		'etat' => array('type' => 'integer', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id_demande', 'unique' => 1),
			'offre_demande_fk' => array('column' => 'offre_id', 'unique' => 0),
			'appartient_demande_fk' => array('column' => 'appartenance_id', 'unique' => 0)
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
			'id_demande' => 1,
			'appartenance_id' => 1,
			'offre_id' => 1,
			'date_emprunt' => '2014-03-31 10:33:04',
			'date_retour' => '2014-03-31 10:33:04',
			'date_demande' => 1,
			'etat' => 1
		),
	);

}
