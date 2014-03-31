<?php
/**
 * EmpruntFixture
 *
 */
class EmpruntFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id_emprune' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'appartenance_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'offre_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'date_emprunt' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'date_retour' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'qualite_retour' => array('type' => 'integer', 'null' => false, 'default' => null),
		'commentaire' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id_emprune', 'unique' => 1),
			'offre_emprunt_fk' => array('column' => 'offre_id', 'unique' => 0),
			'appartient_emprunt_fk' => array('column' => 'appartenance_id', 'unique' => 0)
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
			'id_emprune' => 1,
			'appartenance_id' => 1,
			'offre_id' => 1,
			'date_emprunt' => '2014-03-31 10:33:05',
			'date_retour' => '2014-03-31 10:33:05',
			'qualite_retour' => 1,
			'commentaire' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);

}
