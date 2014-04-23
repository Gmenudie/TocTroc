<?php
App::uses('AppModel', 'Model');
/**
 * Invitation Model
 *
 * @property Appartenance $Appartenance
 * @property User $User
 */
class Invitation extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'invitation_id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Appartenance' => array(
			'className' => 'Appartenance',
			'foreignKey' => 'appartenance_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
