<?php
/**
 * InvitationFixture
 *
 */
class InvitationFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'invitation_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'appartenance_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'invitation_id', 'unique' => 1),
			'appartenance_invitation_fk' => array('column' => 'appartenance_id', 'unique' => 0),
			'user_invitation_fk' => array('column' => 'user_id', 'unique' => 0)
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
			'invitation_id' => 1,
			'appartenance_id' => 1,
			'user_id' => 1,
			'created' => '2014-04-23 10:32:52'
		),
	);

}
