<?php
App::uses('AppModel', 'Model');
/**
 * Offre Model
 *
 * @property Demande $Demande
 * @property Emprunt $Emprunt
 * @property Appartenance $Appartenance
 * @property Category $Category
 */
class Offre extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'offre_id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Demande' => array(
			'className' => 'Demande',
			'foreignKey' => 'offre_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Emprunt' => array(
			'className' => 'Emprunt',
			'foreignKey' => 'offre_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PublieOffre' => array(
			'className' => 'PublieOffre',
			'foreignKey' => 'offre_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''

	));


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Category' => array(
			'className' => 'Category',
			'joinTable' => 'categories_offres',
			'foreignKey' => 'offre_id',
			'associationForeignKey' => 'categorie_id',
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
