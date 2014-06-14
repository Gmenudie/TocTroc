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

		),
		'AbusOffre'=> array(
			'className'=>'AbusOffre',
			'foreignKey'=>'offre_id',
			'dependent'=>false
		)
	);


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

	public function get_user_offres($user_id){

		$db = $this->getDataSource();
		$offres=$db->fetchAll(
		    'SELECT Offre.*, Category.categorie_id, Category.nom 
		    FROM offres Offre 
		    INNER JOIN publieOffre PublieOffre ON PublieOffre.offre_id=Offre.offre_id
		    INNER JOIN appartenances Appartenance ON Appartenance.appartenance_id=PublieOffre.appartenance_id
   		    LEFT JOIN categories_offres ON categories_offres.offre_id=Offre.offre_id
		    INNER JOIN categories Category ON Category.categorie_id=categories_offres.categorie_id
		    WHERE Appartenance.user_id=?
		    ORDER BY Category.nom ASC, Offre.created DESC',
		    array($user_id)
		);

		//Retraitement
		$correct_offres=[];		
		foreach ($offres as $offre) {
			if (array_key_exists($offre['Offre']["offre_id"], $correct_offres))
			{
				if (!array_key_exists($offre['Category']["categorie_id"], $correct_offres[$offre['Offre']["offre_id"]]["Categories"]))
				{
					$correct_offres[$offre['Offre']["offre_id"]]["Categories"][$offre['Category']["categorie_id"]]=$offre["Category"];
				}

			}
			else
			{
				$correct_offres[$offre['Offre']["offre_id"]]["Offre"]=$offre["Offre"];
				$correct_offres[$offre['Offre']["offre_id"]]["Categories"]=[];

			}
		}

		return $correct_offres ;
	}

	public function get_communities_offre($nom,$communautes,$categorie){

		$conditionsQuery['Offre.titre LIKE'] = "%".$nom."%";
		$conditionsQuery['Appartenance.communaute_id'] = $communautes;
		if ($categorie!=null)
		{
			$conditionsQuery['categories.categorie_id'] = $categorie;
		}

		$db = $this->getDataSource();
		$Query = $db->buildStatement(
		    array(
		        'fields'     => array('Offre.*,User.*'),
		        'table'      => 'offres',
		        'alias'      => 'Offre',
		        'joins'      => array('INNER JOIN publieOffre PublieOffre ON PublieOffre.offre_id=Offre.offre_id
										INNER JOIN appartenances Appartenance ON Appartenance.appartenance_id=PublieOffre.appartenance_id
										INNER JOIN users User ON Appartenance.user_id=User.user_id
										LEFT JOIN categories_offres ON categories_offres.offre_id=Offre.offre_id
										INNER JOIN categories ON categories_offres.categorie_id=categories.categorie_id'),
		        'conditions' => $conditionsQuery,
		        'order'      => null,
		        'group'      => 'Offre.offre_id'
		    ),
		    'Offre'
		);
		
		$QueryExpression = $db->expression($Query);

		$offres=$db->fetchAll($Query);
		return $offres ;
	}

	public function find_particular($id){

		$db = $this->getDataSource();
		$offres=$db->fetchAll(
		    'SELECT Offre.*, Appartenance.communaute_id, Appartenance.user_id
		    FROM offres Offre 
		    INNER JOIN publieOffre PublieOffre ON PublieOffre.offre_id=Offre.offre_id
		    INNER JOIN appartenances Appartenance ON Appartenance.appartenance_id=PublieOffre.appartenance_id
		    WHERE Offre.id=?',
		    array($id)
		);

		return $offres ;
	}

}
