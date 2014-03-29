
CREATE TABLE droits (
                id_droits INT AUTO_INCREMENT NOT NULL,
                exemple_droit_1 BOOLEAN,
                exemple_droit_2 BOOLEAN,
                PRIMARY KEY (id_droits)
);


CREATE TABLE profils (
                id_profil INT AUTO_INCREMENT NOT NULL,
                nom VARCHAR(50),
                id_droits INT NOT NULL,
                PRIMARY KEY (id_profil)
);


CREATE TABLE commentaires (
                id_commentaire INT AUTO_INCREMENT NOT NULL,
                contenu TEXT NOT NULL,
                date DATETIME NOT NULL,
                PRIMARY KEY (id_commentaire)
);


CREATE TABLE titres (
                id_titre INT AUTO_INCREMENT NOT NULL,
                nom VARCHAR(50) NOT NULL,
                description TEXT,
                PRIMARY KEY (id_titre)
);


CREATE TABLE offres (
                id_offre INT AUTO_INCREMENT NOT NULL,
                titre VARCHAR(50) NOT NULL,
                description TEXT,
                image VARCHAR(50),
                etat INT NOT NULL,
                date DATETIME NOT NULL,
                PRIMARY KEY (id_offre)
);


CREATE TABLE categories (
                id_categorie INT AUTO_INCREMENT NOT NULL,
                nom VARCHAR(50) NOT NULL,
                PRIMARY KEY (id_categorie)
);


CREATE TABLE offre_possede_categorie (
                id_offre INT NOT NULL,
                id_categorie INT NOT NULL,
                PRIMARY KEY (id_offre, id_categorie)
);


CREATE TABLE annonces (
                id_annonce INT AUTO_INCREMENT NOT NULL,
                titre VARCHAR(50) NOT NULL,
                description TEXT,
                image VARCHAR(50),
                etat INT NOT NULL,
                date DATETIME NOT NULL,
                PRIMARY KEY (id_annonce)
);


CREATE TABLE annonce_possede_categorie (
                id_annonce INT NOT NULL,
                id_categorie INT NOT NULL,
                PRIMARY KEY (id_annonce, id_categorie)
);


CREATE TABLE canal (
                id_canal INT AUTO_INCREMENT NOT NULL,
                nom VARCHAR(50) NOT NULL,
                description TEXT,
                PRIMARY KEY (id_canal)
);


CREATE TABLE posts (
                id_post INT AUTO_INCREMENT NOT NULL,
                titre VARCHAR(50) NOT NULL,
                contenu TEXT NOT NULL,
                document_joint VARCHAR(50),
                date DATETIME NOT NULL,
                id_canal INT NOT NULL,
                PRIMARY KEY (id_post)
);


CREATE TABLE adresses (
                id_adresse INT AUTO_INCREMENT NOT NULL,
                numero INT,
                rue VARCHAR(50),
                code_postal INT,
                ville VARCHAR(50),
                numero_appartement INT,
                etage INT,
                PRIMARY KEY (id_adresse)
);


CREATE TABLE communautes (
                id_communaute INT AUTO_INCREMENT NOT NULL,
                nom VARCHAR(50) NOT NULL,
                description TEXT,
                parametres VARCHAR(20) NOT NULL,
                date DATETIME NOT NULL,
                id_adresse INT NOT NULL,
                PRIMARY KEY (id_communaute)
);


CREATE TABLE users (
                id_user INT AUTO_INCREMENT NOT NULL,
                prenom VARCHAR(50) NOT NULL,
                nom VARCHAR(50) NOT NULL,
                email VARCHAR(50) NOT NULL,
                password VARCHAR(50) NOT NULL,
                image_profil VARCHAR(50),
                telephone_1 INT,
                telephone_2 INT,
                telephone_3 INT,
                date DATETIME NOT NULL,
                id_adresse INT,
                id_profil INT,
                PRIMARY KEY (id_user)
);


CREATE TABLE possede_titre (
                id_user INT NOT NULL,
                id_titre INT NOT NULL,
                PRIMARY KEY (id_user, id_titre)
);


CREATE TABLE appartient (
                id_appartient INT AUTO_INCREMENT NOT NULL,
                id_communaute INT NOT NULL,
                id_user INT NOT NULL,
                valide INT NOT NULL,
                PRIMARY KEY (id_appartient)
);


CREATE TABLE demandes (
                id_demande INT AUTO_INCREMENT NOT NULL,
                id_appartient INT NOT NULL,
                id_offre INT NOT NULL,
                date_emprunt DATETIME NOT NULL,
                date_retour DATETIME NOT NULL,
                date_demande INT NOT NULL,
                etat INT NOT NULL,
                PRIMARY KEY (id_demande)
);


CREATE TABLE emprunts (
                id_emprune INT AUTO_INCREMENT NOT NULL,
                id_appartient INT NOT NULL,
                id_offre INT NOT NULL,
                date_emprunt DATETIME NOT NULL,
                date_retour DATETIME NOT NULL,
                qualite_retour INT NOT NULL,
                commentaire TEXT NOT NULL,
                PRIMARY KEY (id_emprune)
);


CREATE TABLE publie_post (
                id_post INT NOT NULL,
                id_appartient INT NOT NULL,
                PRIMARY KEY (id_post, id_appartient)
);


CREATE TABLE commente (
                id_commentaire INT NOT NULL,
                id_appartient INT NOT NULL,
                id_post INT NOT NULL,
                PRIMARY KEY (id_commentaire, id_appartient, id_post)
);


CREATE TABLE publie_offre (
                id_appartient INT NOT NULL,
                id_offre INT NOT NULL,
                PRIMARY KEY (id_appartient, id_offre)
);


CREATE TABLE publie_annonce (
                id_appartient INT NOT NULL,
                id_annonce INT NOT NULL,
                PRIMARY KEY (id_appartient, id_annonce)
);


ALTER TABLE profils ADD CONSTRAINT droits_profil_fk
FOREIGN KEY (id_droits)
REFERENCES droits (id_droits)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE users ADD CONSTRAINT profil_user_fk
FOREIGN KEY (id_profil)
REFERENCES profils (id_profil)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE commente ADD CONSTRAINT commentaire_commente_fk
FOREIGN KEY (id_commentaire)
REFERENCES commentaires (id_commentaire)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE possede_titre ADD CONSTRAINT titre_possede_titre_fk
FOREIGN KEY (id_titre)
REFERENCES titres (id_titre)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE publie_offre ADD CONSTRAINT offre_publie_offre_fk
FOREIGN KEY (id_offre)
REFERENCES offres (id_offre)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE offre_possede_categorie ADD CONSTRAINT offre_offre_possede_categorie_fk
FOREIGN KEY (id_offre)
REFERENCES offres (id_offre)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE emprunts ADD CONSTRAINT offre_emprunt_fk
FOREIGN KEY (id_offre)
REFERENCES offres (id_offre)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE demandes ADD CONSTRAINT offre_demande_fk
FOREIGN KEY (id_offre)
REFERENCES offres (id_offre)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE annonce_possede_categorie ADD CONSTRAINT categorie_annonce_possede_categorie_fk
FOREIGN KEY (id_categorie)
REFERENCES categories (id_categorie)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE offre_possede_categorie ADD CONSTRAINT categorie_offre_possede_categorie_fk
FOREIGN KEY (id_categorie)
REFERENCES categories (id_categorie)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE publie_annonce ADD CONSTRAINT annonce_publie_annonce_fk
FOREIGN KEY (id_annonce)
REFERENCES annonces (id_annonce)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE annonce_possede_categorie ADD CONSTRAINT annonce_annonce_possede_categorie_fk
FOREIGN KEY (id_annonce)
REFERENCES annonces (id_annonce)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE posts ADD CONSTRAINT canal_post_fk
FOREIGN KEY (id_canal)
REFERENCES canal (id_canal)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE publie_post ADD CONSTRAINT post_publie_post_fk
FOREIGN KEY (id_post)
REFERENCES posts (id_post)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE commente ADD CONSTRAINT post_commente_fk
FOREIGN KEY (id_post)
REFERENCES posts (id_post)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE users ADD CONSTRAINT adresse_user_fk
FOREIGN KEY (id_adresse)
REFERENCES adresses (id_adresse)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE communautes ADD CONSTRAINT adresse_communaute_fk
FOREIGN KEY (id_adresse)
REFERENCES adresses (id_adresse)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE appartient ADD CONSTRAINT communaute_appartient_fk
FOREIGN KEY (id_communaute)
REFERENCES communautes (id_communaute)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE appartient ADD CONSTRAINT user_appartient_fk
FOREIGN KEY (id_user)
REFERENCES users (id_user)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE possede_titre ADD CONSTRAINT user_possede_titre_fk
FOREIGN KEY (id_user)
REFERENCES users (id_user)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE publie_annonce ADD CONSTRAINT appartient_publie_annonce_fk
FOREIGN KEY (id_appartient)
REFERENCES appartient (id_appartient)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE publie_offre ADD CONSTRAINT appartient_publie_offre_fk
FOREIGN KEY (id_appartient)
REFERENCES appartient (id_appartient)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE commente ADD CONSTRAINT appartient_commente_fk
FOREIGN KEY (id_appartient)
REFERENCES appartient (id_appartient)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE publie_post ADD CONSTRAINT appartient_publie_post_fk
FOREIGN KEY (id_appartient)
REFERENCES appartient (id_appartient)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE emprunts ADD CONSTRAINT appartient_emprunt_fk
FOREIGN KEY (id_appartient)
REFERENCES appartient (id_appartient)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE demandes ADD CONSTRAINT appartient_demande_fk
FOREIGN KEY (id_appartient)
REFERENCES appartient (id_appartient)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

INSERT INTO `canal` (`id_canal`, `nom`, `description`) VALUES (NULL, 'Test', 'test canal');
INSERT INTO `posts` (`id_post`, `titre`, `contenu`, `document_joint`, `date`, `id_canal`) VALUES (NULL, 'Salut', 'post test', NULL, '2014-03-01 00:00:00.000000', '1');