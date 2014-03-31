<?php
App::uses('AppModel', 'Model');
/**
 * CategoriesOffre Model
 *
 * @property Categorie $Categorie
 */
class CategoriesOffre extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'offre_id';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'categorie_id' => array(
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
		'Categorie' => array(
			'className' => 'Categorie',
			'foreignKey' => 'categorie_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
