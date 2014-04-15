<?php

class UsersController extends AppController {

	/* Liste des actions du controller
	 * 
	 * 1. beforeFilter()
	 * 2. login()
	 * 3. logout()
	 * 4. add()
	 * 5. monCompte()
	 *
	 * Assez logiquement, ce controller gère l'authentification et l'inscription. Rien de bien sorcier.
	 */

	 /* ------------------------------------------
	 * beforeFilter()
	 * ------------------------------------------
	 * Parce qu'un utilisateur non authentifié a quand même le droit de s'inscrire, se login ou se logout!
	 * ------------------------------------------ */
	 
	public function beforeFilter() {
	    parent::beforeFilter();
	    // Allow users to register and logout.
	    $this->Auth->allow('add', 'logout');
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
	
	public function add($id = null)
	{

		
		
		/* On envoie une variable à la vue s'il s'agit d'un ajout de membre (= s'il n'y a pas de paramètres $id) */
		if(isset($id) == false)
		{
			$this->layout='unauthentified';
			$this->set('ajout', 1);
		}
		else
		{
			/* Il s'agit d'une modification*/
			$this->layout='default';
		}
		
		/* On regarde si le formulaire a été validé */
		if (empty($this->data) == false)
		{
			/* On liste les formats de fichiers acceptés pour les photos de profil. */
			$formats = array('jpg', 'jpeg', 'png', 'gif');
			
			/* On regarde si une photo de profil a été soumise, si oui on met tout en forme */
			if ($this->data['User']['upload_profil']['name'] != null)
			{
				$go =0;
				if(isset($this->data['User']['user_id']))
				{
					/* Il s'agit d'une modification */
					$photo = $this->User->findByUserId($id)['User']['image_profil'];
					$newphoto = $this->data['User']['upload_profil']['name'];
					
					if($photo != $newphoto)
					{
						/* La photo de profil a changé, on modifie la base de données. (Si la photo de profil ne change pas, on ne fait rien) */
						$go = 1;
						/* On crée dès maintenant le chemin vers là où sera stocké l'image */
						$cheminFichier = 'img/user/'.$id.'/';
					}
				}
				else
				{
					$go = 1;
				}
				
				if($go == 1)
				{
					$format = strtolower(substr(strrchr($this->data['User']['upload_profil']['name'],'.'),1));
						
					/* On vérifie si le format du fichier est valide */
					if(in_array($format, $formats))
					{
						
						// /* On défini le nom du fichier PRENOM-NOM.FORMAT*/
						// $nom = $this->data['User']['prenom'].'-'.$this->data['User']['nom'].'.'.$format;
						
						// /* On préfixe le nom du fichier */
						// if($this->User->findByUserId($id)['User']['image_profil'] != null || !isset($id))
						// {
							// $nom = 'profil-' . (substr($this->User->findByUserId($id)['User']['image_profil'], 7, 1) + 1) . '-' . $nom;
						// }
						// else
						// {
							// $nom = 'profil-1-' . $nom;
						//}
						
						
						/* On va maintenant entamer le processus de redimmensionnement de l'image */
						if($format == 'jpg' || $format == 'jpeg')
						{
							$imageChoisie = imagecreatefromjpeg($this->data['User']['upload_profil']['tmp_name']);
							$tailleImageChoisie = getimagesize($this->data['User']['upload_profil']['tmp_name']);
							
							/* On définit les nouvelles dimensions de l'image */
							$nouvelleLargeur = 80;
							$nouvelleLargeurMiniature = 40;
							
							$reduction = ($nouvelleLargeur/$tailleImageChoisie[0]);
							$reductionMiniature = ($nouvelleLargeurMiniature/$tailleImageChoisie[0]);
							
							$nouvelleHauteur = ($tailleImageChoisie[1] * $reduction);
							$nouvelleHauteurMiniature = ($tailleImageChoisie[1] * $reductionMiniature);
							
							/* On crée l'image dans laquelle sera enregistrée l'image redimensionnée */
							$nouvelleImage = imagecreatetruecolor($nouvelleLargeur, $nouvelleHauteur);
							$nouvelleMiniature = imagecreatetruecolor($nouvelleLargeurMiniature, $nouvelleHauteurMiniature);
							
							/* On redimensionne l'image */
							imagecopyresampled($nouvelleImage, $imageChoisie, 0, 0, 0, 0, $nouvelleLargeur, $nouvelleHauteur, $tailleImageChoisie[0], $tailleImageChoisie[1]);
							imagecopyresampled($nouvelleMiniature, $imageChoisie, 0, 0, 0, 0, $nouvelleLargeurMiniature, $nouvelleHauteurMiniature, $tailleImageChoisie[0], $tailleImageChoisie[1]);
							
							/* On supprime la copie locale de l'image */
							imagedestroy($imageChoisie);
							
							/* On upload et on regarde si ça se passe bien /!\ L'upload n'est possible que pour un utilisateur existant à ce stade, pour une création c'est plus loin /!\*/
							if(isset($this->data['User']['user_id']))
							{
								if(imagejpeg($nouvelleImage, $cheminFichier.'profil.'.$format, 80) && imagejpeg($nouvelleMiniature, $cheminFichier.'miniature.'.$format, 80))
								{
									$upload = 1;
								}
								else
								{
									$this->Session->setFlash('Erreur lors de l\'upload de la photo de profil...','error');
									$this->redirect($this->referer());
								}
							}
							else
							{
								$goUpload = 1;
							}
						}
						elseif($format == 'png')
						{
							$imageChoisie = imagecreatefrompng($this->data['User']['upload_profil']['tmp_name']);
							$tailleImageChoisie = getimagesize($this->data['User']['upload_profil']['tmp_name']);
							
							/* On définit les nouvelles dimensions de l'image */
							$nouvelleLargeur = 80;
							$nouvelleLargeurMiniature = 40;
							
							$reduction = ($nouvelleLargeur/$tailleImageChoisie[0]);
							$reductionMiniature = ($nouvelleLargeurMiniature/$tailleImageChoisie[0]);
							
							$nouvelleHauteur = ($tailleImageChoisie[1] * $reduction);
							$nouvelleHauteurMiniature = ($tailleImageChoisie[1] * $reductionMiniature);
							
							/* On crée l'image dans laquelle sera enregistrée l'image redimensionnée */
							$nouvelleImage = imagecreatetruecolor($nouvelleLargeur, $nouvelleHauteur);
							$nouvelleMiniature = imagecreatetruecolor($nouvelleLargeurMiniature, $nouvelleHauteurMiniature);
							
							/* On redimensionne l'image */
							imagecopyresampled($nouvelleImage, $imageChoisie, 0, 0, 0, 0, $nouvelleLargeur, $nouvelleHauteur, $tailleImageChoisie[0], $tailleImageChoisie[1]);
							imagecopyresampled($nouvelleMiniature, $imageChoisie, 0, 0, 0, 0, $nouvelleLargeurMiniature, $nouvelleHauteurMiniature, $tailleImageChoisie[0], $tailleImageChoisie[1]);
							
							/* On supprime la copie locale de l'image */
							imagedestroy($imageChoisie);
							
							/* On upload et on regarde si ça se passe bien /!\ L'upload n'est possible que pour un utilisateur existant à ce stade, pour une création c'est plus loin /!\*/
							if(isset($this->data['User']['user_id']))
							{
								if(imagepng($nouvelleImage, $cheminFichier.'profil.png', 80) && imagepng($nouvelleMiniature, $cheminFichier.'miniature.png', 80))
								{
									$upload = 1;
								}
								else
								{
									$this->Session->setFlash('Erreur lors de l\'upload de la photo de profil...','error');
									$this->redirect($this->referer());
								}
							}
							else
							{
								$goUpload = 1;
							}
						}
						elseif($format == 'gif')
						{
							$imageChoisie = imagecreatefromgif($this->data['User']['upload_profil']['tmp_name']);
							$tailleImageChoisie = getimagesize($this->data['User']['upload_profil']['tmp_name']);
							
							/* On définit les nouvelles dimensions de l'image */
							$nouvelleLargeur = 80;
							$nouvelleLargeurMiniature = 40;
							
							$reduction = ($nouvelleLargeur/$tailleImageChoisie[0]);
							$reductionMiniature = ($nouvelleLargeurMiniature/$tailleImageChoisie[0]);
							
							$nouvelleHauteur = ($tailleImageChoisie[1] * $reduction);
							$nouvelleHauteurMiniature = ($tailleImageChoisie[1] * $reductionMiniature);
							
							/* On crée l'image dans laquelle sera enregistrée l'image redimensionnée */
							$nouvelleImage = imagecreatetruecolor($nouvelleLargeur, $nouvelleHauteur);
							$nouvelleMiniature = imagecreatetruecolor($nouvelleLargeurMiniature, $nouvelleHauteurMiniature);
							
							/* On joue avec l'alpha et l'omega pour garder la transparence des gifs */
							imageAlphaBlending($nouvelleImage, false);
							imageAlphaBlending($nouvelleMiniature, false);
							imageSaveAlpha($nouvelleImage, true);
							imageSaveAlpha($nouvelleMiniature, true);
							
							/* On redimensionne l'image */
							imagecopyresampled($nouvelleImage, $imageChoisie, 0, 0, 0, 0, $nouvelleLargeur, $nouvelleHauteur, $tailleImageChoisie[0], $tailleImageChoisie[1]);
							imagecopyresampled($nouvelleMiniature, $imageChoisie, 0, 0, 0, 0, $nouvelleLargeurMiniature, $nouvelleHauteurMiniature, $tailleImageChoisie[0], $tailleImageChoisie[1]);
							
							/* On supprime la copie locale de l'image */
							imagedestroy($imageChoisie);
							
							/* On upload et on regarde si ça se passe bien /!\ L'upload n'est possible que pour un utilisateur existant à ce stade, pour une création c'est plus loin /!\*/
							if(isset($this->data['User']['user_id']))
							{
								if(imagegif($nouvelleImage, $cheminFichier.'profil.gif', 80) && imagegif($nouvelleMiniature, $cheminFichier.'miniature.gif', 80))
								{
									$upload = 1;
								}
								else
								{
									$this->Session->setFlash('Erreur lors de l\'upload de la photo de profil...','error');
									$this->redirect($this->referer());
								}
							}
							else
							{
								$goUpload = 1;
							}
						}
							
						/* On regarde si l'upload s'est bien passé */
						/*
						if(move_uploaded_file($this->data['User']['upload_profil']['tmp_name'],$cheminFichier))
						{
							$upload = 1;
						}
						else
						{
							$this->Session->setFlash('Erreur lors de l\'upload de la photo de profil...','error');
							$this->redirect($this->referer());
						}*/
					}
					else
					{
						$this->Session->setFlash('Le format du fichier n\'est pas valide','error');
						$this->redirect($this->referer());
					}
				}
			}
				
			if(isset($id))
			{
				/* Il s'agit d'une modification , on vérifie si le mail n'est pas déjà utilisé s'il a été modifié*/
				$email = $this->User->findByUserId($id)['User']['email'];
				$newEmail = $this->data['User']['email'];
				
				if($email == $newEmail)
				{
					/* L'email n'a pas changé */
					$this->User->save($this->data);
					if($upload==1)
					{
						$this->User->saveField('image_profil',$format);
					}
					$this->Session->setFlash('Vos données ont été modifiées', 'success');
					$this->redirect(array('controller' => 'users', 'action' => 'monCompte'));
				}
				else
				{
					$requete = $this->User->find('count', array('conditions' => array('email' => $newEmail)));
					
					if($requete == 0)
					{
						/* L'email n'est pas déjà utilisé */
						$this->User->save($this->data);
						if($upload==1)
						{
							$this->User->saveField('image_profil',$format);
						}
						$this->Session->setFlash('Vos données ont été modifiées', 'success');
						$this->redirect(array('controller' => 'users', 'action' => 'monCompte'));
					}
					else
					{
					/* L'email est déjà pris */
					$this->Session->setFlash('Cet email est déjà utilisé, désolé', 'error');
					$this->redirect($this->referer());
					}
				}
			}
			
			else
			{
				/*Il s'agit d'un ajout, on vérifie si le mail n'est pas déjà utilisé */
				$email = $this->data['User']['email'];
				$requete = $this->User->find('count', array('conditions' => array('email' => $email)));
				
				if($requete == 0)
				{
					$this->User->create();
					$temporaryUser=array();
					$temporaryUser=$this->request->data;
					$temporaryUser["User"]["role_id"]='3';
				

					if ($id = $this->User->save($temporaryUser))
					{   
						/* On crée le dossier pour l'utilisateur */
						new Folder('img/user/'.$id);
					
						if($goUpload==1)
						{
							$cheminFichier = 'img/user/'.$id.'/';
							$this->User->saveField('image_profil',$format);
							
							/* On upload et on regarde si ça se passe bien /!\ L'upload n'est possible que pour un utilisateur existant à ce stade, pour une création c'est plus loin /!\*/
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
								if(imagepng($nouvelleImage, $cheminFichier.'profil.png', 80) && imagepng($nouvelleMiniature, $cheminFichier.'miniature.png', 80))
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
						$this->Auth->login($this->data);
						return $this->redirect( array('controller' => 'acceuils', 'action' => 'index'));
					}
				}
				
				else
				{
					/* L'email est déjà pris */
					$this->Session->setFlash('Cet email est déjà utilisé, désolé', 'error');
					$this->redirect($this->referer());
				}
			}
			
		}
		elseif($id != null)
		{
			/* Formulaire vide, mais il y a un paramètre (c'est une modification, on charge ce qui est déjà écrit)*/
			$this->User->user_id;
			$this->request->data = $this->User->findByUserId($id);
		}
		else
		{
			$this->Session->setFlash(('Erreur'));
			$this->redirect($this->referer());
		}

    }

	
	/* ------------------------------------------
	 * monCompte
	 * ------------------------------------------
	 * Accès à son compte et possibilité de le modifier
	 * ------------------------------------------ */
	 
	 public function monCompte() {
		$this->set('user',$this->User->find('all', array('conditions' => array('user_id' => $this->Auth->User("user_id")), 'recursive'=> 1)));
	 }
	

}