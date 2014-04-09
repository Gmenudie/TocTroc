<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 * @property Canal $Canal
 */
class Post extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'post_id';

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
		'canal_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Canal' => array(
			'className' => 'Canal',
			'foreignKey' => 'canal_id',
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
		'Commentaires' => array(
			'className' => 'Commentaire',
			'foreignKey' => 'post_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);



}
