<?php
App::uses('AppModel', 'Model');
/**
 * AbusCommentaire Model
 *
 * 
 */
class AbusCommentaire extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'abusCommentaire';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'abusCommentaire_id';


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
		'Commentaire' => array(
			'className' => 'Commentaire',
			'foreignKey' => 'commentaire_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
