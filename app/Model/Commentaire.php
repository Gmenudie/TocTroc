<?php
App::uses('AppModel', 'Model');
/**
 * Commentaire Model
 *
 */
class Commentaire extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'commentaire_id';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'contenu' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Vous devez écrire quelque chose',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'created' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	public $belongsTo = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'post_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Appartenance' => array(
			'className' => 'Appartenance',
			'foreignKey' => 'appartenance_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $hasMany = array(
		'AbusCommentaire'=> array(
			'className'=>'AbusCommentaire',
			'foreignKey'=>'commentaire_id',
			'dependent'=>false
		)
	);
}
