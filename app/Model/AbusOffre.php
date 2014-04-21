<?php
App::uses('AppModel', 'Model');
/**
 * AbusOffre Model
 *
 * 
 */
class AbusOffre extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'abusOffre';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'abusOffre_id';


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
		'Offre' => array(
			'className' => 'Offre',
			'foreignKey' => 'offre_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
