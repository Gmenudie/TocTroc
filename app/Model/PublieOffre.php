<?php
App::uses('AppModel', 'Model');
/**
 * PublieOffre Model
 *
 * @property Appartenance $Appartenance
 * @property Offre $Offre
 */
class PublieOffre extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'publieOffre';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'publieOffre_id';


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
