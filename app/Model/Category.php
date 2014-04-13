<?php
App::uses('AppModel', 'Model');
/**
 * Category Model
 *
 * @property Annonce $Annonce
 * @property Offre $Offre
 */
class Category extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'categorie_id';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'nom' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Une catégorie doit avoir un nom',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Annonce' => array(
			'className' => 'Annonce',
			'joinTable' => 'annonces_categories',
			'foreignKey' => 'categorie_id',
			'associationForeignKey' => 'annonce_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'Offre' => array(
			'className' => 'Offre',
			'joinTable' => 'categories_offres',
			'foreignKey' => 'categorie_id',
			'associationForeignKey' => 'offre_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
