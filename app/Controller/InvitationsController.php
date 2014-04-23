
<?php

class InvitationsController extends AppController {

	public function beforeFilter(){
	parent::beforeFilter();

	}	

	public function add()
	{		
		if ($this->request->is('post')) 
		{
			if(isset($this->request->data['email']))
			{
			$search=$this->request->data['email'];

			//On recherche un utilisateur possédant ce mail
			$this->Invitation->User->unbindModel(
				array('hasMany'=>array('Appartenance','AbusProfil'),
					  'belongsTo'=>array('Role')));
			$user=$this->Invitation->User->find('first', array('recursive'=>1,'conditions'=>array('email'=>$search)));
			$this->set('user',$user);
			//On indique à la vue qu'il y a eu une recherche
			$this->set('searched',1);
			}

			if(isset($this->request->data['Invitation']))
			{
				//On vérifie que le mail correspond bien à un user, et on remplace par son id
				$user=$this->Invitation->User->find('first', array('conditions'=>array('email'=>$this->request->data['Invitation']['email'])));
				if(isset($user)&&$user!=null)
				{
					unset($this->request->data['Invitation']['email']);
					$this->request->data['Invitation']['user_id']=$user['User']['user_id'];

					//Vérification qu'il appartient bien à la communauté dans laquelle il l'invite
					$appartient=$this->Invitation->Appartenance->find('first', array('conditions'=>array('Appartenance.appartenance_id'=>$this->request->data['Invitation']['appartenance_id'], 'Appartenance.user_id'=>$this->Auth->user('user_id'))));
					if($appartient!=null)
					{
						//On vérifie que l'utilisateur ne l'a pas déjà invité
						if(0==$this->Invitation->find('count',array('conditions'=>array('Invitation.appartenance_id'=>$appartient['Appartenance']['appartenance_id'],'Invitation.user_id'=>$this->request->data['Invitation']['user_id']))))
						{
							if($this->Invitation->save($this->request->data))
							{
								$this->Session->setFlash('Invitation envoyée','success');
								return $this->redirect(array('controller'=>'appartenances','action'=>'index'));
							}
							else
							{
								$this->Session->setFlash("Désolé, une erreur a été rencontrée lors de l'enregistrement de l'invitation",'error');
								return $this->redirect(array('controller'=>'appartenances','action'=>'index'));
							}
						}
						else
						{
							$this->Session->setFlash("Vous avez déjà invité cette personne, attendez sa réponse",'error');
						}
						
					}
					else
					{
						$this->session->setFlash("Vous n'êtes pas autorisé",'error');
						return $this->redirect(array('controller'=>'acceuils',"action"=>"index"));
					}
				}
				else
				{
					$this->Session->setFlash("Désole, nous n'avons pas trouvé d'utilisateur correspondant à cette adresse mail",'error');
				}
			}

		}

		$appartenances = $this->Invitation->Appartenance->find('list',array('recursive'=>1,'fields'=>'Communaute.nom','conditions'=>array('Appartenance.user_id'=>$this->Auth->user('user_id'))));
		$this->set('appartenances',$appartenances);
	}

	public function mesInvitations(){
		//On récupère les appartenances de l'utilisateur
		$appartenances=$this->Invitation->Appartenance->find('all', array('conditions' => array('Appartenance.user_id' => $this->Auth->User("user_id")), 'recursive'=> 2));
		//On les affiche
		$this->set('appartenances', $appartenances);

		//On regarde si l'utilisateur a envoyé des invitations, on les lui affiches si besoin
		$appartenance_id=array();
		foreach($appartenances as $appartenance)
		{
			array_push($appartenance_id, $appartenance['Appartenance']['appartenance_id']);
		}
		$this->Invitation->User->unbindModel(
				array('hasMany'=>array('Appartenance','AbusProfil'),
					  'belongsTo'=>array('Role')));
		$this->Invitation->Appartenance->unbindModel(
			array('hasMany' => array('Commentaire','Post','Annonce','PublieOffre','Demande','Emprunt','Invitation'),
           	 	  'belongsTo'=>array('User')));

		$this->set('invitationsEnvoyees', $this->Invitation->find('all', array('recursive'=> 2,'conditions'=>array('Invitation.appartenance_id'=>$appartenance_id))));		
	}	

	public function invitationsRecues(){

		$this->Invitation->User->unbindModel(
				array('hasMany'=>array('Appartenance','AbusProfil'),
					  'belongsTo'=>array('Role')));
		$this->Invitation->Appartenance->unbindModel(
			array('hasMany' => array('Commentaire','Post','Annonce','PublieOffre','Demande','Emprunt','Invitation')));

		//On récupère et on affiche les appartenances reçues
		$this->set('invitationsRecues',$this->Invitation->find('all', array('recursive'=>2,'conditions'=>array('Invitation.user_id'=>$this->Auth->user('user_id')))));
	}

	public function delete($id=null){
		$invitation=$this->Invitation->findByInvitationId($id);
		if (isset($invitation) && $invitation!=null)
		{
			//Vérification qu'il a bien le droit de supprimer l'invitation
			$verif=false;
			if($invitation['Invitation']['user_id']==$this->Auth->user('user_id') || 1==$this->Invitation->Appartenance->find('count',array('conditions'=>array('Appartenance.user_id'=>$this->Auth->user('user_id'), 'Appartenance.appartenance_id'=>$invitation['Invitation']['appartenance_id']))))
			{
				$verif=true;
			}
			if($verif==true)
			{
				if($this->Invitation->delete($invitation['Invitation']['invitation_id']))
				{
					$this->Session->setFlash("Invitation supprimée",'success');
					return $this->redirect($this->referer());
				}
				else
				{
					$this->Session->setFlash("Erreur lors de la suppression",'error');
					return $this->redirect($this->referer());
				}
			}
			else
			{
				$this->Session->setFlash("Vous n'etes pas autorisé",'error');
				return $this->redirect($this->referer());
			}
		}
		else
		{
			$this->Session->setFlash("Invitation non-trouvée",'error');
			return $this->redirect($this->referer());
		}
	}

	public function accepter($id=null)
	{
		$invitation=$this->Invitation->find('first',array('recursive' => 1, 'conditions'=>array('Invitation.invitation_id'=>$id)));
		if (isset($invitation) && $invitation!=null)
		{
			//Vérification qu'il a bien le droit d'avoir l'invitation
			if($invitation['Invitation']['user_id']==$this->Auth->user('user_id'))
			{
				$this->Invitation->Appartenance->create();
				$appartenancetemp=array();
				$appartenancetemp['Appartenance']['user_id']=$this->Auth->user('user_id');
				$appartenancetemp['Appartenance']['communaute_id']=$invitation['Appartenance']['communaute_id'];
				$appartenancetemp['Appartenance']['role']=1;
				$appartenancetemp['Appartenance']['valide']=1;

				if($this->Invitation->Appartenance->save($appartenancetemp))
				{
					if($this->Invitation->delete($invitation['Invitation']['invitation_id']))
					{
						$this->Session->setFlash("Félicitation, vous avez une nouvelle communauté",'success');
						return $this->redirect($this->referer());
					}
					else
					{
						$this->Session->setFlash("Erreur lors de la suppression",'error');
						return $this->redirect($this->referer());
					}
				}
				else
				{
					$this->Session->setFlash("Erreur lors de l'enregistrement",'error');
					return $this->redirect($this->referer());
				}
				
			}
			else
			{
				$this->Session->setFlash("Vous n'etes pas autorisé",'error');
				return $this->redirect($this->referer());
			}
		}
		else
		{
			$this->Session->setFlash("Invitation non-trouvée",'error');
			return $this->redirect($this->referer());
		}

	}	

		
	public function getall(){
		

		$this->Paginator->settings = array('recursive'=>0);
		$this->set('communautes', $this->Paginator->paginate());
	}

}

?>