<?php
App::uses('AppModel', 'Model');
/**
 * Appartenance Model
 *
 * @property Communaute $Communaute
 * @property User $User
 */
class Appartenance extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'appartenance_id';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'communaute_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'valide' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'role' => array(
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
		'Communaute' => array(
			'className' => 'Communaute',
			'foreignKey' => 'communaute_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $hasMany = array(
		'Commentaire' => array(
			'className' => 'Commentaire',
			'foreignKey' => 'appartenance_id',
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
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'appartenance_id',
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
		'Annonce' => array(
			'className' => 'Annonce',
			'foreignKey' => 'appartenance_id',
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
			'foreignKey' => 'appartenance_id',
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
		'Demande' => array(
			'className' => 'Demande',
			'foreignKey' => 'appartenance_id',
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
			'foreignKey' => 'appartenance_id',
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
		'Invitation'=>array(
			'className'=>'Invitation',
			'foreignKey'=>'appartenance_id',
			'dependent'=>false)
	);

	public function get_communautes($user_id) {

		$db = $this->getDataSource();
		$appartenances=$db->fetchAll(
			    'SELECT Appartenance.appartenance_id, Communaute.nom, Communaute.description 
			    FROM appartenances Appartenance INNER JOIN communautes Communaute ON Appartenance.communaute_id=Communaute.communaute_id 
			    WHERE Appartenance.user_id=?',
			    array($user_id)
			);

		return $appartenances ;
	}

	public function find_for_select($user_id){
		$appartenances=$this->find('list',array(			
			'fields'=>array('Appartenance.communaute_id','Communaute.nom'),
			'joins'=>array('JOIN communautes as Communaute ON Communaute.communaute_id=Appartenance.communaute_id'),
			'conditions'=>array('Appartenance.user_id'=>$user_id)));
		return $appartenances;
	}
}
