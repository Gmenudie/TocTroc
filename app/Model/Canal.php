<?php
App::uses('AppModel', 'Model');
/**
 * Canal Model
 *
 */
class Canal extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'canal_id';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'nom' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
