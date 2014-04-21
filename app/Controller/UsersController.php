<?php

class UsersController extends AppController {

	/* Liste des actions du controller
	 * 
	 * 1. beforeFilter()
	 * 2. login()
	 * 3. logout()
	 * 4. add()
	 * 5. monCompte()
	 * 6. changerMotDePasse()
	 * 7. modificationAdresse()
	 * 8. profil()
	 *
	 * Assez logiquement, ce controller gère l'authentification et l'inscription. Rien de bien sorcier.
	 */

	public function beforeFilter(){
	parent::beforeFilter();

	}

	

	/* ------------------------------------------
	 * login
	 * ------------------------------------------
	 * Fonction standard de Cake
	 * ------------------------------------------ */
	 
	public function login() {
		$this->layout='unauthentified';
	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	            return $this->redirect($this->Auth->redirect());
	        }
	        $this->Session->setFlash(__('Identifiant ou mot de passe invalide'));
	    }
	}

	
	/* ------------------------------------------
	 * logout
	 * ------------------------------------------
	 * Fonction standard de Cake
	 * ------------------------------------------ */
	
	public function logout() {
	    return $this->redirect($this->Auth->logout());
	}

	
	/* ------------------------------------------
	 * add
	 * ------------------------------------------
	 * Gestion d'inscription et d'édition des informations d'un utilisateur
	 * ------------------------------------------ */
	
	public function add()
	{
	
		App::uses('Folder', 'Utility');
		
		$erreur = 0;
		
		/* On envoie une variable à la vue s'il s'agit d'un ajout de membre (= s'il n'y a pas de paramètres $id) */
		if(null==$this->Auth->user('user_id'))
		{
			$this->layout='unauthentified';
			$this->set('ajout', 1);
		}
		else
		{
			/* Il s'agit d'une modification*/
			$id = $this->Auth->user('user_id');
			$this->layout='default';
		}
		
		/* On regarde si le formulaire a été validé */
		if (!empty($this->request->data))
		{
			// On regarde si une photo de profil a été soumise, si oui on met tout en forme 
			if ($this->request->data['User']['upload_profil']['name'] != null)
			{
				$go =0;
				if(isset($id))
				{
					
					// Il s'agit d'une modification 
					$photo = $this->User->findByUserId($id)['User']['image_profil'];
					$newphoto = $this->request->data['User']['upload_profil']['name'];
					
					if($photo != $newphoto)
					{
						// La photo de profil a changé, on modifie la base de données. (Si la photo de profil ne change pas, on ne fait rien) 
						$go = 1;
						// On crée dès maintenant le chemin vers là où sera stocké l'image 
						$cheminFichier = 'img/user/'.$id.'/';
					}
				}
				else
				{
					$go = 1;
				}
				
				if($go == 1)
				{
					// On liste les formats de fichiers acceptés pour les photos de profil.
					$formats = array('jpg', 'jpeg', 'png', 'gif');
					
					$format = strtolower(substr(strrchr($this->request->data['User']['upload_profil']['name'],'.'),1));
						
					// On vérifie si le format du fichier est valide 
					if(in_array($format, $formats))
					{						
						// On vérifie si le dossier pour stocker les images existe, sinon on le crée 
						$dir = 'img/user/'.$id;
						if(! file_exists($dir))
						{
							mkdir($dir,0777);
						}
						
						// On va maintenant entamer le processus de redimmensionnement de l'image 
						if($format == 'jpg' || $format == 'jpeg')
						{
							$imageChoisie = imagecreatefromjpeg($this->request->data['User']['upload_profil']['tmp_name']);
							$tailleImageChoisie = getimagesize($this->request->data['User']['upload_profil']['tmp_name']);
							
							// On définit les nouvelles dimensions de l'image 
							if($tailleImageChoisie[0] >= $tailleImageChoisie[1])
							{
								$nouvelleLargeur = 80;
								$nouvelleLargeurMiniature = 40;
								
								$reduction = ($nouvelleLargeur/$tailleImageChoisie[0]);
								$reductionMiniature = ($nouvelleLargeurMiniature/$tailleImageChoisie[0]);
								
								$nouvelleHauteur = ($tailleImageChoisie[1] * $reduction);
								$nouvelleHauteurMiniature = ($tailleImageChoisie[1] * $reductionMiniature);
								
							}
							else
							{
								$nouvelleHauteur = 80;
								$nouvelleHauteurMiniature = 40;
								
								$reduction = ($nouvelleHauteur/$tailleImageChoisie[1]);
								$reductionMiniature = ($nouvelleHauteurMiniature/$tailleImageChoisie[1]);
								
								$nouvelleLargeur = ($tailleImageChoisie[0] * $reduction);
								$nouvelleLargeurMiniature = ($tailleImageChoisie[0] * $reductionMiniature);
							}
							
							// On crée l'image dans laquelle sera enregistrée l'image redimensionnée 
							$nouvelleImage = imagecreatetruecolor($nouvelleLargeur, $nouvelleHauteur);
							$nouvelleMiniature = imagecreatetruecolor($nouvelleLargeurMiniature, $nouvelleHauteurMiniature);
							
							// On redimensionne l'image 
							imagecopyresampled($nouvelleImage, $imageChoisie, 0, 0, 0, 0, $nouvelleLargeur, $nouvelleHauteur, $tailleImageChoisie[0], $tailleImageChoisie[1]);
							imagecopyresampled($nouvelleMiniature, $imageChoisie, 0, 0, 0, 0, $nouvelleLargeurMiniature, $nouvelleHauteurMiniature, $tailleImageChoisie[0], $tailleImageChoisie[1]);
							
							// On supprime la copie locale de l'image 
							imagedestroy($imageChoisie);
							
							// On upload et on regarde si ça se passe bien /!\ L'upload n'est possible que pour un utilisateur existant à ce stade, pour une création c'est plus loin /!\
							if(isset($id))
							{
								if(imagejpeg($nouvelleImage, $cheminFichier.'profil.'.$format, 80) && imagejpeg($nouvelleMiniature, $cheminFichier.'miniature.'.$format, 80))
								{
									$upload = 1;
								}
								else
								{
									$this->Session->setFlash('Erreur lors de l\'upload de la photo de profil...','error');
									$erreur = 1;
								}
							}
							else
							{
								$goUpload = 1;
							}
						}
						elseif($format == 'png')
						{
							$imageChoisie = imagecreatefrompng($this->request->data['User']['upload_profil']['tmp_name']);
							$tailleImageChoisie = getimagesize($this->request->data['User']['upload_profil']['tmp_name']);
							
							// On définit les nouvelles dimensions de l'image 
							if($tailleImageChoisie[0] >= $tailleImageChoisie[1])
							{
								$nouvelleLargeur = 80;
								$nouvelleLargeurMiniature = 40;
								
								$reduction = ($nouvelleLargeur/$tailleImageChoisie[0]);
								$reductionMiniature = ($nouvelleLargeurMiniature/$tailleImageChoisie[0]);
								
								$nouvelleHauteur = ($tailleImageChoisie[1] * $reduction);
								$nouvelleHauteurMiniature = ($tailleImageChoisie[1] * $reductionMiniature);
								
							}
							else
							{
								$nouvelleHauteur = 80;
								$nouvelleHauteurMiniature = 40;
								
								$reduction = ($nouvelleHauteur/$tailleImageChoisie[1]);
								$reductionMiniature = ($nouvelleHauteurMiniature/$tailleImageChoisie[1]);
								
								$nouvelleLargeur = ($tailleImageChoisie[0] * $reduction);
								$nouvelleLargeurMiniature = ($tailleImageChoisie[0] * $reductionMiniature);
							}
							
							// On crée l'image dans laquelle sera enregistrée l'image redimensionnée 
							$nouvelleImage = imagecreatetruecolor($nouvelleLargeur, $nouvelleHauteur);
							$nouvelleMiniature = imagecreatetruecolor($nouvelleLargeurMiniature, $nouvelleHauteurMiniature);
							
							// On redimensionne l'image 
							imagecopyresampled($nouvelleImage, $imageChoisie, 0, 0, 0, 0, $nouvelleLargeur, $nouvelleHauteur, $tailleImageChoisie[0], $tailleImageChoisie[1]);
							imagecopyresampled($nouvelleMiniature, $imageChoisie, 0, 0, 0, 0, $nouvelleLargeurMiniature, $nouvelleHauteurMiniature, $tailleImageChoisie[0], $tailleImageChoisie[1]);
							
							// On supprime la copie locale de l'image 
							imagedestroy($imageChoisie);
							
							// On upload et on regarde si ça se passe bien /!\ L'upload n'est possible que pour un utilisateur existant à ce stade, pour une création c'est plus loin /!\
							if(isset($id))
							{
								if(imagepng($nouvelleImage, $cheminFichier.'profil.png', 8) && imagepng($nouvelleMiniature, $cheminFichier.'miniature.png', 8))
								{
									$upload = 1;
								}
								else
								{
									$this->Session->setFlash('Erreur lors de l\'upload de la photo de profil...','error');
									$erreur = 1;
								}
							}
							else
							{
								$goUpload = 1;
							}
						}
						elseif($format == 'gif')
						{
							$imageChoisie = imagecreatefromgif($this->request->data['User']['upload_profil']['tmp_name']);
							$tailleImageChoisie = getimagesize($this->request->data['User']['upload_profil']['tmp_name']);
							
							// On définit les nouvelles dimensions de l'image 
							if($tailleImageChoisie[0] >= $tailleImageChoisie[1])
							{
								$nouvelleLargeur = 80;
								$nouvelleLargeurMiniature = 40;
								
								$reduction = ($nouvelleLargeur/$tailleImageChoisie[0]);
								$reductionMiniature = ($nouvelleLargeurMiniature/$tailleImageChoisie[0]);
								
								$nouvelleHauteur = ($tailleImageChoisie[1] * $reduction);
								$nouvelleHauteurMiniature = ($tailleImageChoisie[1] * $reductionMiniature);
								
							}
							else
							{
								$nouvelleHauteur = 80;
								$nouvelleHauteurMiniature = 40;
								
								$reduction = ($nouvelleHauteur/$tailleImageChoisie[1]);
								$reductionMiniature = ($nouvelleHauteurMiniature/$tailleImageChoisie[1]);
								
								$nouvelleLargeur = ($tailleImageChoisie[0] * $reduction);
								$nouvelleLargeurMiniature = ($tailleImageChoisie[0] * $reductionMiniature);
							}
							
							// On crée l'image dans laquelle sera enregistrée l'image redimensionnée 
							$nouvelleImage = imagecreatetruecolor($nouvelleLargeur, $nouvelleHauteur);
							$nouvelleMiniature = imagecreatetruecolor($nouvelleLargeurMiniature, $nouvelleHauteurMiniature);
							
							// On joue avec l'alpha et l'omega pour garder la transparence des gifs 
							imageAlphaBlending($nouvelleImage, false);
							imageAlphaBlending($nouvelleMiniature, false);
							imageSaveAlpha($nouvelleImage, true);
							imageSaveAlpha($nouvelleMiniature, true);
							
							// On redimensionne l'image 
							imagecopyresampled($nouvelleImage, $imageChoisie, 0, 0, 0, 0, $nouvelleLargeur, $nouvelleHauteur, $tailleImageChoisie[0], $tailleImageChoisie[1]);
							imagecopyresampled($nouvelleMiniature, $imageChoisie, 0, 0, 0, 0, $nouvelleLargeurMiniature, $nouvelleHauteurMiniature, $tailleImageChoisie[0], $tailleImageChoisie[1]);
							
							// On supprime la copie locale de l'image 
							imagedestroy($imageChoisie);
							
							// On upload et on regarde si ça se passe bien /!\ L'upload n'est possible que pour un utilisateur existant à ce stade, pour une création c'est plus loin /!\
							if(isset($id))
							{
								if(imagegif($nouvelleImage, $cheminFichier.'profil.gif', 80) && imagegif($nouvelleMiniature, $cheminFichier.'miniature.gif', 80))
								{
									$upload = 1;
								}
								else
								{
									$this->Session->setFlash('Erreur lors de l\'upload de la photo de profil...','error');
									$erreur = 1;
								}
							}
							else
							{
								$goUpload = 1;
							}
						}
					}
					else
					{
						$this->Session->setFlash('Le format du fichier n\'est pas valide','error');
						$erreur = 1;
					}
				}
			}
			else
			{
				$upload = 0;
			}
				
			if(isset($id) && $erreur == 0)
			{
				// Il s'agit d'une modification , on vérifie si le mail n'est pas déjà utilisé s'il a été modifié
				$currentuser=$this->User->findByUserId($id);
				$newEmail = $this->request->data['User']['email'];
				
				if($upload == 1)
				{
					$currentuser['User']['image_profil'] = $format;
					$this->request->data['User']['image_profil'] = $currentuser['User']['image_profil'];
				}
				
				if($currentuser['User']['email'] == $newEmail)
				{
					/*L'email n'a pas changé */				
					
					$this->request->data['User']['user_id']=$currentuser['User']['user_id'];
					$this->request->data['User']['role_id']=$currentuser['User']['role_id'];
					
					
					if($this->User->save($this->request->data))
					 {
						unset($currentuser);
						
						$this->Session->setFlash('Vos données ont été modifiées', 'success');
						$this->redirect(array('controller' => 'users', 'action' => 'monCompte'));
					}
					else
					{
						debug($currentuser);
						debug($this->request->data);
						$this->Session->setFlash('Erreur lors de l\'enregistrement mais tes arrivé jusque la', 'error');
						
					}

					$this->set('currentuser',$currentuser);
				}
				else
				{
					$requete = $this->User->find('count', array('conditions' => array('email' => $newEmail)));
					
					if($requete == 0)
					{
						/* L'email n'est pas déjà utilisé */
						
						$this->request->data['User']['user_id']=$currentuser['User']['user_id'];
						$this->request->data['User']['role_id']=$currentuser['User']['role_id'];	

						
						
						if(!$this->User->save($this->request->data))
						{
							debug($this->request->data);
						}
						else
						{
						
							unset($this->request->data);
							
							$this->Session->setFlash('Vos données ont été modifiées', 'success');
							$this->redirect(array('controller' => 'users', 'action' => 'monCompte'));
						}
					}
					else
					{
					/* L'email est déjà pris */
					$this->Session->setFlash('Cet email est déjà utilisé, désolé', 'error');
					}
				}
			}
			else
			{
				if($erreur == 0)
				{
					/*Il s'agit d'un ajout, on vérifie si le mail n'est pas déjà utilisé */
					$email = $this->request->data['User']['email'];
					$requete = $this->User->find('count', array('conditions' => array('email' => $email)));
					
					/* On vérifie que les 2 mots de passes tapés sont les mêmes */
					if($this->request->data['User']['password_1'] == $this->request->data['User']['password_2'])
					{
						/* On vérifie la longueur du mot de passe */
						if(strlen($this->request->data['User']['password_1']) >= 6)
						{
							$password = 1;
						}
						else
						{
							$this->Session->setFlash('Le mot de passe doit faire au minimum 6 caractères', 'error');
							$password = 0;
						}
					}
					else
					{
						/* Pas 2 fois le même mot de passe */
						$this->Session->setFlash('Veuillez entrer deux fois le même mot de passe', 'error');
						$password = 0;
					}
					
					if($requete == 0 && $password == 1)
					{
						$this->User->create();
						$temporaryUser=array();
						$temporaryUser=$this->request->data;
						$temporaryUser["User"]["role_id"]=3;
						$temporaryUser['User']['password'] = $this->request->data['User']['password_1'];
						

						if ($this->User->save($temporaryUser))
						{   
							/* On crée le dossier pour l'utilisateur */
							$id = $this->User->id;
							mkdir('img/user/'.$id,0777);

							
							
							if($goUpload==1)
							{
								$cheminFichier = 'img/user/'.$id.'/';
								$this->User->saveField('image_profil',$format);
								
								/* On upload et on regarde si ça se passe bien */
								if($format == 'jpg' || $format == 'jpeg')
								{
									if(imagejpeg($nouvelleImage, $cheminFichier.'profil.'.$format, 80) && imagejpeg($nouvelleMiniature, $cheminFichier.'miniature.'.$format, 80))
									{
										$upload = 1;
									}
									else
									{
										$this->Session->setFlash('Erreur lors de l\'upload de la photo de profil...','error');
									}
								}
								elseif($format == 'png')
								{
									if(imagepng($nouvelleImage, $cheminFichier.'profil.png', 8) && imagepng($nouvelleMiniature, $cheminFichier.'miniature.png', 8))
									{
										$upload = 1;
									}
									else
									{
										$this->Session->setFlash('Erreur lors de l\'upload de la photo de profil...','error');
									}
								}
								elseif($format == 'gif')
								{
									if(imagegif($nouvelleImage, $cheminFichier.'profil.gif', 80) && imagegif($nouvelleMiniature, $cheminFichier.'miniature.gif', 80))
									{
										$upload = 1;
									}
									else
									{
										$this->Session->setFlash('Erreur lors de l\'upload de la photo de profil...','error');
									}
								}
								
							}
							
							unset($temporaryUser);
							
							$this->Session->setFlash(__('Bienvenue sur TocTroc !'));
							
							$this->Auth->login($this->request->data);
							if ($this->Auth->login())
							{
								return $this->redirect($this->Auth->redirect());
							}
						}
						else
						{
							$this->Session->setFlash('Il y a eu une erreur lors de l\'enregistrement', 'error');
						}
					}

					else
					{
						if($requete != 0)
						{
							/* L'email est déjà pris */
							$this->Session->setFlash('Cet email est déjà utilisé, désolé', 'error');
						}
					}
				}
			}
		}
		elseif(isset($id)&&($id != null))
		{
			/* Formulaire vide, mais il y a un paramètre (c'est une modification, on charge ce qui est déjà écrit)*/
			$this->User->user_id;
			$this->request->data = $this->User->findByUserId($id);
		}
    }

	
	/* ------------------------------------------
	 * monCompte
	 * ------------------------------------------
	 * Accès à son compte et possibilité de le modifier
	 * ------------------------------------------ */
	 
	 public function monCompte()
	 {
		$this->set('user',$this->User->find('all', array('conditions' => array('user_id' => $this->Auth->User("user_id")), 'recursive'=> 1)));
	 }
	
	
	/* ------------------------------------------
	 * changerMotDePasse
	 * ------------------------------------------
	 * Permet aux utilisateurs de modifier leur mot de passe
	 * ------------------------------------------ */
	 
	 public function changerMotDePasse()
	 {
		/* On regarde si le formulaire a été validé */
		if(!empty($this->request->data))
		{
			if($this->request->data['User']['password_1'] == $this->request->data['User']['password_2'])
			{
				
				/* On vérifie la longueur du mot de passe */
				if(strlen($this->request->data['User']['password_1']) >= 6)
				{
					$data = array('user_id' => $this->Auth->user('user_id'), 'password' => $this->request->data['User']['password_1']);
				
					/* On essaye de sauvegarder l'utilisateur */
					if($this->User->save($data))
					{
						$this->Session->setFlash('Votre mot de passe a bien été changé', 'success');
						$this->redirect(array('controller' => 'users', 'action' => 'monCompte'));
					}
					else
					{

						$this->Session->setFlash('Erreur lors de l\'enregistrement du mot de passe', 'error');
					}
				}
				else
				{
					$this->Session->setFlash('Le mot de passe doit faire au minimum 6 caractères', 'error');
				}
			}
			else
			{
				/* Pas 2 fois le même mot de passe */
				$this->Session->setFlash('Veuillez entrer deux fois le même mot de passe', 'error');
			}
		}
	}


	/* ------------------------------------------
	 * modificationAdresse
	 * ------------------------------------------
	 * Pour modifier son adresse dans son profil
	 * ------------------------------------------ */
	 
	// public function modificationAdresse() {

		// /* Il s'agit d'une modification*/
		// $id = $this->Auth->user('user_id');
		// $this->layout='default';
		
		// /* On regarde si le formulaire a été validé */
		// if (!empty($this->request->data))
		// {
		
		
		
	/* ------------------------------------------
	 * profil
	 * ------------------------------------------
	 * Fonction pour afficher le profil
	 * ------------------------------------------ */
	 public function profil($id = null) {
	 
		 if($id == null)
		 {
			$this->Session->setFlash('Cet utilisateur n\'existe pas', 'error');
			$this->redirect(referer());
		}
		else
		{
			$this->set('user', $this->User->find('first', array('conditions' => array('User.user_id' => $id), 'recursive'=> 1)));
		}
	}

	public function getall(){
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

	public function addAbus($id=null){

		//Vérification 
		$this->User->Appartenance->unbindModel(
			array('hasMany' => array('Commentaires','Posts','Annonces','PublieOffres','Demandes','Emprunts'),
        	 	 'belongsTo'=>array('Commentaire')));

		$user=$this->User->find('first',array('conditions'=>array('user_id'=>$id),'recursive'=>1));

		$communautes=array();

		foreach($user['Appartenance'] as $appartenance)
		{
			array_push($communautes, $appartenance['communaute_id']);
		}
		$appartenance=$this->User->Appartenance->find('first',array('conditions'=>array('Appartenance.user_id'=>$this->Auth->user('user_id'),'Appartenance.communaute_id'=>$communautes)));

		//Une personne ne peut signaler qu'une fois le meme user comme étant abusif!
		$nbAbus=$this->User->AbusProfil->find('count',array('conditions'=>array('AbusProfil.appartenance_id'=>$appartenance['Appartenance']['appartenance_id'],'AbusProfil.user_id'=>$id)));
		
		if($appartenance!=null && $nbAbus==0) //Utilisateur autorisé
		{

			if($this->request->is('post'))
			{
				$this->User->AbusProfil->create();
				$addAbus=$this->request->data;
				$addAbus["AbusProfil"]["appartenance_id"]=$appartenance['Appartenance']['appartenance_id'];
				if($this->User->AbusProfil->save($addAbus))
				{
					$this->Session->setFlash('Votre signalement a bien été pris en compte. Il sera transmis aux modérateurs');
				}
				else
				{
					$this->Session->setFlash("Désolé, un problème est survenu et votre signalement n'a pas pu être enregistré");
				}
				return $this->redirect(array('controller'=>'users','action'=>'profil',$user['User']['user_id']));
				
			}

			// On prépare les informations pour les envoyer à la vue			
			$this->set('user',$user);
		}
		else if ($nbAbus==0) //Pas autorisé (User pas de ses communautés)
		{
			$this->Session->setFlash("Vous n'êtes pas autorisé");
			return $this->redirect(array('controller'=>'acceuils','action'=>'index'));
		}
		else //Déjà signalé
		{
			$this->Session->setFlash("Vous avez déjà signalé ce profil comme abusif");
			return $this->redirect(array('controller'=>'users','action'=>'profil',$user['User']['user_id']));
		}

	}
	public function retirerAbus($id=null)
	{
		$user=$this->User->find('first',array('recursive'=>1,'conditions'=>array('user_id'=>$id)));
		$communaute_id=array();
		
		foreach ($user['Appartenance'] as $appartient) 
		{
			array_push($communaute_id, $appartient['communaute_id']);
		}
		$appartenance=$this->User->Appartenance->find('first',array('recursive'=>0,'conditions'=>array('Appartenance.user_id'=>$this->Auth->user('user_id'), 'Appartenance.communaute_id'=>$communaute_id, 'Appartenance.role'=>2)));

		if(isset($appartenance)&&$appartenance!=null)
		{
			foreach($user['AbusProfil'] as $abususer)
			{
				if(!$this->User->AbusProfil->delete($abususer))
				{
					$this->Session->setFlash("Problème rencontré lors de la suppression d'un abus");
					return $this->redirect($this->referer());
				}
			}
			$this->Session->setFlash('Abus retiré correctement');
			return $this->redirect($this->referer());
		}
		else
		{
			$this->Session->setFlash("Vous n'avez pas l'autorisation");
			return $this->redirect($this->referer());
		}
	}
	

	public function confirmerAbus($id=null)
	{
		$user=$this->User->find('first',array('recursive'=>1,'conditions'=>array('user_id'=>$id)));
		$communaute_id=array();
		
		foreach ($user['Appartenance'] as $appartient) 
		{
			array_push($communaute_id, $appartient['communaute_id']);
		}
		$appartenance=$this->User->Appartenance->find('first',array('recursive'=>0,'conditions'=>array('Appartenance.user_id'=>$this->Auth->user('user_id'), 'Appartenance.communaute_id'=>$communaute_id, 'Appartenance.role'=>2)));

		if(isset($appartenance)&&$appartenance!=null)
		{
			foreach($user['AbusProfil'] as $abususer)
			{
				if(!$this->User->AbusProfil->delete($abususer))
				{
					$this->Session->setFlash("Problème rencontré lors de la suppression d'un abus");
					return $this->redirect($this->referer());
				}
			}
			$this->Session->setFlash('Abus retiré correctement');
			$data=array();
			$data['User']['etat']=2;
			$data['User']['user_id']=$user['User']['user_id'];
			if($this->User->save($data))
			{
				$this->Session->setFlash('Abus confirmé, profil retiré');
				return $this->redirect($this->referer());
			}
			else
			{
				$this->Session->setFlash("Problème rencontré lors de la modification de l'etat");
				return $this->redirect($this->referer());
				debug($data);
			}

		}
		else
		{
			$this->Session->setFlash("Vous n'avez pas l'autorisation");
			return $this->redirect($this->referer());
		}
	}
	
	
}