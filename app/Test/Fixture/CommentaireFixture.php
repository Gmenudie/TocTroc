<?php
/**
 * CommentaireFixture
 *
 */
class CommentaireFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'commentaire_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'contenu' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'date' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'commentaire_id', 'unique' => 1)
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
			'contenu' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'date' => '2014-03-31 10:33:04'
		),
	);

}
