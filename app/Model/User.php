<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {


	public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $passwordHasher = new SimplePasswordHasher();
	        $this->data[$this->alias]['password'] = $passwordHasher->hash(
	            $this->data[$this->alias]['password']
	        );
	    }
	    return true;
	}



	public $validate = array(
        'prenom' => array(
            'alphaNumeric' => array(
                'rule'     => 'alphaNumeric',
                'required' => true,
                'message'  => 'Utilisez seulement des caractères alphanumériques'
            ),
            'between' => array(
                'rule'    => array('between', 1, 50),
                'message' => 'Doit être compris entre 1 et 50 caractères'
            ),
            'nonEmpty'=> array(
            	'rule'    => 'notEmpty',
        		'message' => 'Ce champ ne peut pas être vide'
	        ),
        ),
        'nom' => array(
            'alphaNumeric' => array(
                'rule'     => 'alphaNumeric',
                'required' => true,
                'message'  => 'Utilisez seulement des caractères alphanumériques'
            ),
            'between' => array(
                'rule'    => array('between', 1, 50),
                'message' => 'Doit être compris entre 1 et 50 caractères'
            ),
            'nonEmpty'=> array(
            	'rule'    => 'notEmpty',
        		'message' => 'Ce champ ne peut pas être vide'
	        ),
        ),
        'email' => array(
            'mailform'=> array(
	            'rule'    => array('email', true),
	        	'message' => 'Adresse mail non valide'
    		),
    		'nonEmpty'=> array(
            	'rule'    => 'notEmpty',
        		'message' => 'Ce champ ne peut pas être vide'
	        ),
	        'unique'=> array(
	        	'rule'    => 'isUnique',
     	 		'message' => 'Cet email est déjà enregistré'
	        ),
        ),
        'password' => array(
        	'length'=> array(
	            'rule'    => array('minLength', '6'),
	            'message' => 'Minimum 6 caractères'
	        ),
	        'nonEmpty'=> array(
            	'rule'    => 'notEmpty',
        		'message' => 'Ce champ ne peut pas être vide'
	        ),
        )
    );        
	
}