<?php
App::uses('AppModel', 'Model');
/**
 * AbusPost Model
 *
 * 
 */
class AbusPost extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'abusPost';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'abusPost_id';


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
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'post_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
