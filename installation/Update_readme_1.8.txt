

VERSION 1.8 
_____________




Non PATCHE
---------------

DROP TABLE IF EXISTS `PREFIXEstatUtilisateur`;
DROP TABLE IF EXISTS `PREFIXEstatutilisateur`; 
CREATE TABLE IF NOT EXISTS `PREFIXEstatutilisateur` (`date_entree` date NOT NULL,  `nom` varchar(30) NOT NULL,  `prenom` varchar(30) NOT NULL,  `idpers` int(11) NOT NULL,  `type_membre` varchar(15) NOT NULL,  `id_session` text,  `nb_conx` int(11) DEFAULT NULL,  `der_conx` varchar(30) DEFAULT NULL,  UNIQUE KEY `nom` (`nom`,`prenom`,`idpers`,`type_membre`),  KEY `idpers` (`idpers`,`type_membre`)) ENGINE=TYPETABLE;




patch 009-36
------------

ALTER TABLE `PREFIXEcalendrier_dst` ADD `idsalle` INT NOT NULL; 
ALTER TABLE `PREFIXEmessageries` ADD `alerte` BOOLEAN NOT NULL DEFAULT FALSE;



patch 009-30
------------

UPDATE parametres SET valeur_param='' WHERE id_param='104' AND valeur_param='Bibliothèque PMB Services'; 
UPDATE parametres SET valeur_param='' WHERE id_param='105' AND valeur_param='www.sigb.net'; 
UPDATE parametres SET valeur_param='' WHERE id_param='106' AND valeur_param='24 & 26, place des Halles'; 
UPDATE parametres SET valeur_param='' WHERE id_param='107' AND valeur_param='CHATEAU DU LOIR'; 
UPDATE parametres SET valeur_param='' WHERE id_param='108' AND valeur_param='72500'; 
UPDATE parametres SET valeur_param='' WHERE id_param='109' AND valeur_param='France';
UPDATE parametres SET valeur_param='' WHERE id_param='110' AND valeur_param='02 43 440 660';
UPDATE parametres SET valeur_param='' WHERE id_param='111' AND valeur_param='37';
UPDATE parametres SET valeur_param='' WHERE id_param='112' AND valeur_param='pmb@sigb.net';



patch 009-28
------------

ALTER TABLE `PREFIXEmatieres` ADD `code_matiere` VARCHAR(20) NOT NULL; 

patch 009-27
------------

CREATE TABLE IF NOT EXISTS `PREFIXEbulletin_com_classe` (`idclasse` int(11) NOT NULL,`commentaire` text NOT NULL,`idmatiere` int(11) NOT NULL,`trimestre` varchar(30) NOT NULL) ENGINE=TYPETABLE;
ALTER TABLE `PREFIXEcentralstageattribution` ADD `vialacentral` BOOLEAN NOT NULL DEFAULT FALSE;


patch 009-26
------------

CREATE TABLE IF NOT EXISTS `PREFIXEbulletin_profp_ue` (`ideleve` int(11) NOT NULL,`id_ue` int(11) NOT NULL,`tri` varchar(50) NOT NULL,`com` text NOT NULL,`idclasse` int(11) NOT NULL ) ENGINE=TYPETABLE;
CREATE TABLE IF NOT EXISTS `PREFIXEstockage_partage` (`id` int(11) NOT NULL AUTO_INCREMENT,`fichier` varchar(255) NOT NULL,  `chemin` text NOT NULL,  `membreIdProprio` varchar(250) NOT NULL,  `membreIdAutorise` varchar(250) NOT NULL,  `idclasse` int(11) NOT NULL,  `membresource` varchar(50) NOT NULL,  `idsource` int(11) NOT NULL,  PRIMARY KEY (`id`)) ENGINE=TYPETABLE;
ALTER TABLE `PREFIXEcentralstageattribution` ADD `emailenvoye` BOOLEAN NOT NULL DEFAULT FALSE; 
ALTER TABLE `PREFIXEcentralstageattribution` ADD `confirmer` BOOLEAN NOT NULL DEFAULT FALSE; 
ALTER TABLE `PREFIXEstage_entreprise` ADD `qualite` TEXT NOT NULL;
ALTER TABLE `PREFIXEue` ADD `idpers_profp` INT NOT NULL;


patch 009-25
------------

ALTER TABLE `PREFIXEstage_eleve` ADD `autre_responsable` VARCHAR(200) NOT NULL; 


patch 009-24
------------


DROP TABLE IF EXISTS `PREFIXEeleves_archive`;
CREATE TABLE IF NOT EXISTS `PREFIXEeleves_archive` (`elev_id` int(11) NOT NULL AUTO_INCREMENT,`nom` varchar(30) NOT NULL,`prenom` varchar(50) NOT NULL,`classe` int(11) NOT NULL,`lv1` varchar(90) DEFAULT NULL,`lv2` varchar(90) DEFAULT NULL,`option` varchar(90) DEFAULT NULL,`regime` varchar(25) DEFAULT NULL,`date_naissance` date DEFAULT NULL,`lieu_naissance` varchar(40) DEFAULT '',`nationalite` varchar(20) DEFAULT NULL,`civ_1` smallint(6) DEFAULT NULL,`nomtuteur` varchar(30) DEFAULT NULL,`prenomtuteur` varchar(30) DEFAULT NULL,`adr1` varchar(100) DEFAULT NULL,`code_post_adr1` varchar(15) DEFAULT NULL,`commune_adr1` varchar(40) DEFAULT NULL,`tel_port_1` varchar(25) DEFAULT NULL,`civ_2` smallint(6) DEFAULT NULL,`nom_resp_2` varchar(50) DEFAULT NULL,`prenom_resp_2` varchar(50) DEFAULT NULL,`adr2` varchar(100) DEFAULT NULL,`code_post_adr2` varchar(15) DEFAULT NULL,`commune_adr2` varchar(40) DEFAULT NULL,`tel_port_2` varchar(25) DEFAULT NULL,`telephone` varchar(18) DEFAULT NULL,`profession_pere` varchar(30) DEFAULT   NULL,`tel_prof_pere` varchar(18) DEFAULT NULL,`profession_mere` varchar(30) DEFAULT NULL,`tel_prof_mere` varchar(18) DEFAULT NULL,`nom_etablissement` varchar(30) DEFAULT NULL,`numero_etablissement` varchar(30) DEFAULT NULL,`code_postal_etablissement` varchar(6) DEFAULT NULL,`commune_etablissement` varchar(30) DEFAULT NULL,`numero_eleve` varchar(30) DEFAULT NULL,`photo` varchar(40) DEFAULT NULL,`email` varchar(150) DEFAULT NULL,`email_eleve` varchar(150) DEFAULT NULL,`email_resp_2` varchar(150) DEFAULT NULL,`class_ant` varchar(30) DEFAULT NULL,`annee_ant` varchar(20) DEFAULT NULL,`numero_gep` int(11) DEFAULT NULL,`valid_forward_mail_eleve` tinyint(4) DEFAULT NULL,`valid_forward_mail_parent` tinyint(4) DEFAULT NULL,`tel_eleve` varchar(25) DEFAULT NULL,`code_compta` varchar(30) DEFAULT NULL,`sexe` varchar(1) DEFAULT NULL,`annee_scolaire` int(11) DEFAULT NULL,`information` text NOT NULL,`adr_eleve` varchar(100) DEFAULT NULL,`ccp_eleve` varchar(15) DEFAULT NULL,`commune_eleve` varchar(40) DEFAULT NULL,`tel_fixe_eleve` varchar(25) DEFAULT NULL,`pays_eleve` varchar(50) DEFAULT NULL,`compte_inactif` tinyint(4) NOT NULL DEFAULT '0',`boursier` tinyint(4) NOT NULL DEFAULT '0',`montant_bourse` decimal(50,5) NOT NULL,`indemnite_stage` decimal(50,5) NOT NULL,`nbmoisindemnite` int(11) NOT NULL DEFAULT '0',`mdp_moodle` varchar(50) NOT NULL DEFAULT ' ',`emailpro_eleve` varchar(250) NOT NULL,`rangement` varchar(250) NOT NULL,`cdi` tinyint(1) NOT NULL,`bde` tinyint(1) NOT NULL,`situation_familiale` varchar(40) NOT NULL,PRIMARY KEY (`elev_id`,`classe`,`nom`,`prenom`),UNIQUE KEY `elev_id` (`elev_id`)) ENGINE=TYPETABLE;


patch 009-22
------------

CREATE TABLE IF NOT EXISTS `PREFIXEhistoeleve` (`ideleve` int(11) NOT NULL,`date` date NOT NULL,`action` varchar(250) NOT NULL,`info` varchar(250) NOT NULL)ENGINE=TYPETABLE;
DROP TABLE tria_histoeleve;
CREATE TABLE IF NOT EXISTS `PREFIXEhistory_eleve` (`ideleve` int(11) NOT NULL,`date` date NOT NULL,`action` varchar(250) NOT NULL,`info` varchar(250) NOT NULL)ENGINE=TYPETABLE;
CREATE TABLE IF NOT EXISTS `PREFIXEbulletin_archivage` (`ideleve` int(11) NOT NULL,`anneescolaire` varchar(30) NOT NULL,`trimestre` varchar(30) NOT NULL,`date` date NOT NULL,`classe` varchar(50) NOT NULL,`fichier` varchar(255) NOT NULL)ENGINE=TYPETABLE;
ALTER TABLE `PREFIXEeleves` ADD `situation_familiale` VARCHAR(40) NOT NULL; 


patch 009-21
------------

ALTER TABLE `PREFIXEfin_reglement` ADD `numero` INT(32) NOT NULL;
ALTER TABLE `PREFIXEcomptaconfig` ADD `anneescolaire` VARCHAR(20) NOT NULL DEFAULT ' ';



patch 009-20
------------
ALTER TABLE `PREFIXEelevessansclasse` ADD `boursier` BOOLEAN NOT NULL DEFAULT '0';


patch 009-19
------------
ALTER TABLE `PREFIXEstage_entreprise` ADD `idcs` INT NOT NULL DEFAULT '0';


patch 009-16
------------

ALTER TABLE `PREFIXEcirculaire` ADD `categorie` VARCHAR(200) NOT NULL;



Patch 009-15
------------
ALTER TABLE `PREFIXEcomptaconfig` ADD `modedepaiement` VARCHAR(100) NOT NULL;


Patch 009-13
-------------

ALTER TABLE `PREFIXEeleves` ADD `mailing_el` BOOLEAN NOT NULL DEFAULT FALSE, ADD `mailing_tu1` BOOLEAN NOT NULL DEFAULT FALSE, ADD `mailing_tu2` BOOLEAN NOT NULL DEFAULT FALSE; 
ALTER TABLE `PREFIXEpersonnel` ADD `mailing_pers` BOOLEAN NOT NULL DEFAULT FALSE; 
ALTER TABLE  PREFIXEfin_reglement  ADD `date_remise_bordereau` DATE;   


Patch 009-12
-------------

ALTER TABLE `PREFIXEue_detail` ADD `code_idgroupe` INT NOT NULL;
ALTER TABLE `PREFIXEaffectations` ADD `id_ue_detail` INT NOT NULL; 


Patch 009-11
-------------

ALTER TABLE `PREFIXEeleves` ADD `cdi` BOOLEAN NOT NULL;
ALTER TABLE `PREFIXEeleves` ADD `bde` BOOLEAN NOT NULL; 
 

Patch 009-09
-------------

ALTER TABLE `PREFIXEue_detail` ADD `code_enseignant` INT NOT NULL; 
ALTER TABLE `PREFIXEalerteabsrtd` ADD `matiereabs` INT NOT NULL; 

Patch 009-05
-------------

ALTER TABLE `PREFIXEmatieres` ADD `libelle_long` VARCHAR(250) NOT NULL; 
CREATE TABLE IF NOT EXISTS `orga_membre` (  `id_membre` int(10) NOT NULL AUTO_INCREMENT,  `id_service` int(10) NOT NULL DEFAULT '-1',  `nom_membre` varchar(250) COLLATE latin1_general_cs NOT NULL,  `prenom_membre` varchar(250) COLLATE latin1_general_cs DEFAULT NULL,  `fonction_membre` varchar(25) COLLATE latin1_general_cs DEFAULT NULL,  `telephone_membre` varchar(20) COLLATE latin1_general_cs DEFAULT NULL,  `adresse_membre` varchar(250) COLLATE latin1_general_cs DEFAULT NULL,  `cp_membre` varchar(5) COLLATE latin1_general_cs DEFAULT NULL,  `ville_membre` varchar(250) COLLATE latin1_general_cs DEFAULT NULL,  `photo_membre` varchar(250) COLLATE latin1_general_cs DEFAULT NULL,  `actif_membre` enum('O','N') COLLATE latin1_general_cs NOT NULL DEFAULT 'O',  `id_organigramme` int(10) NOT NULL DEFAULT '1',  PRIMARY KEY (`id_membre`),  KEY `id_service` (`id_service`),  KEY `id_organigramme` (`id_organigramme`)) ENGINE=TYPETABLE;
CREATE TABLE IF NOT EXISTS `orga_organigramme` (  `id_organigramme` int(10) NOT NULL AUTO_INCREMENT,  `title_organigramme` varchar(250) COLLATE latin1_general_cs NOT NULL,  `id_membre_dg` int(10) NOT NULL DEFAULT '0',  `id_service_dg` int(10) NOT NULL DEFAULT '0',  PRIMARY KEY (`id_organigramme`)) ENGINE=TYPETABLE;
CREATE TABLE IF NOT EXISTS `orga_phporg_config` (  `phporg_version` varchar(10) COLLATE latin1_general_cs NOT NULL) ENGINE=TYPETABLE;
CREATE TABLE IF NOT EXISTS `orga_service` (`id_service` int(10) NOT NULL AUTO_INCREMENT,  `nom_service` varchar(250) COLLATE latin1_general_cs NOT NULL,  `lib_service` longtext COLLATE latin1_general_cs,  `id_responsable` int(10) NOT NULL DEFAULT '-1',  `id_organigramme` int(10) NOT NULL DEFAULT '1',  `id_service_parent` int(10) NOT NULL DEFAULT '-1',  `color_service` varchar(7) COLLATE latin1_general_cs NOT NULL DEFAULT '#000000',  `bgcolor_service` varchar(7) COLLATE latin1_general_cs NOT NULL DEFAULT '#9D9DCE',  `opened_service` tinyint(1) NOT NULL DEFAULT '1',  `display_vertical_service` tinyint(1) NOT NULL DEFAULT '0',  PRIMARY KEY (`id_service`),  KEY `id_responsable` (`id_responsable`),  KEY `id_organigramme` (`id_organigramme`),  KEY `id_service_parent` (`id_service_parent`)) ENGINE=TYPETABLE;
INSERT INTO `orga_organigramme` (`id_organigramme`, `title_organigramme`, `id_membre_dg`, `id_service_dg`) VALUES (1, 'Organigramme', 0, 0);
INSERT INTO `orga_phporg_config` (`phporg_version`) VALUES ('1.0.6');


Patch 009-04
-------------
ALTER TABLE `PREFIXEabsrtdrattrapage` ADD `valider` BOOLEAN NOT NULL DEFAULT FALSE;



Patch 009-02
-------------

ALTER TABLE `PREFIXEabsences` ADD `idrattrapage` VARCHAR(250) NOT NULL DEFAULT '';
ALTER TABLE `PREFIXEretards` ADD `idrattrapage` VARCHAR(250) NOT NULL DEFAULT '';
CREATE TABLE IF NOT EXISTS `PREFIXEabsrtdrattrapage` (`id` int(11) NOT NULL AUTO_INCREMENT,`date` date NOT NULL,`heure_depart` time NOT NULL,`duree` time NOT NULL,`ref_id_absrtd` VARCHAR(250) NOT NULL DEFAULT '',PRIMARY KEY (`id`)) ENGINE=TYPETABLE;




VERSION 1.7.a 
_____________

Patch 000-0A
----------------


ALTER TABLE `PREFIXEclasses`    ADD `offline` BOOLEAN NOT NULL; 
ALTER TABLE `PREFIXEinfo_ecole` ADD `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY; 
ALTER TABLE `PREFIXEclasses`    ADD `idsite` INT NOT NULL DEFAULT '1';


Patch 008-67
----------------
ALTER TABLE `PREFIXEue` ADD `coef_ue` DECIMAL NOT NULL;
ALTER TABLE `PREFIXEue` ADD `ects_ue` DECIMAL NOT NULL;
ALTER TABLE `PREFIXEeleves` ADD `rangement` VARCHAR(250) NOT NULL;
ALTER TABLE `PREFIXEstage_entreprise`  ADD `registrecommerce` VARCHAR(100) NOT NULL,  ADD `siren` VARCHAR(100) NOT NULL,  ADD `siret` VARCHAR(100) NOT NULL,  ADD `formejuridique` VARCHAR(50) NOT NULL,  ADD `secteureconomique` VARCHAR(50) NOT NULL,  ADD `INSEE` VARCHAR(100)  NOT NULL,  ADD `NAFAPE` VARCHAR(100) NOT NULL,  ADD `NACE` VARCHAR(100) NOT NULL,  ADD `typeorganisation` VARCHAR(50) NOT NULL;  



Patch 008-66
----------------

ALTER TABLE `PREFIXEresa_matos` CHANGE `libelle` `libelle` VARCHAR(200);

Patch 008-65
----------------

ALTER TABLE `PREFIXEmatieres` CHANGE `libelle` `libelle` VARCHAR(250);
ALTER TABLE `PREFIXEmatieres` ADD `couleur` VARCHAR(7) NOT NULL;


Patch 008-63
----------------

ALTER TABLE `PREFIXEeleves` ADD `emailpro_eleve` VARCHAR(250) NOT NULL;
ALTER TABLE `PREFIXEbrevetconfig` ADD `coefbrevet` DECIMAL(10,2) NOT NULL DEFAULT '1';

Patch 008-62
----------------

ALTER TABLE `PREFIXEeleves` CHANGE `option` `option` VARCHAR(90)  NULL DEFAULT NULL; 

Patch 008-58
----------------

ALTER TABLE `PREFIXEdroitmodule` ADD `idpersperm` TEXT NOT NULL;
ALTER TABLE `PREFIXEcahiertexte` ADD `visadirecteur` TINYINT NOT NULL DEFAULT '0';
ALTER TABLE `PREFIXEdevoir_scolaire` ADD `visadirecteur` TINYINT NOT NULL DEFAULT '0';
ALTER TABLE `PREFIXEfin_type_frais` ADD `groupe_id` INT(11) NOT NULL;
ALTER TABLE `PREFIXEfin_reglement` ADD `rib_id_utilise` INT(11) NULL DEFAULT '0',ADD `code_banque_utilise` VARCHAR(5) NULL ,ADD `code_guichet_utilise` VARCHAR(11) NULL ,ADD `numero_compte_utilise` VARCHAR(11) NULL ,ADD `cle_rib_utilise` VARCHAR(2) NULL ,ADD `titulaire_utilise` VARCHAR(32) NULL ,ADD `banque_utilise` VARCHAR(24) NULL ,ADD `numero_serie_utilise` VARCHAR(24) NULL ,ADD `reste_a_payer` DOUBLE NOT NULL DEFAULT '0';
CREATE TABLE IF NOT EXISTS `PREFIXEfin_groupe_frais` (`groupe_id` int(11) NOT NULL auto_increment,`libelle` varchar(64) NOT NULL,PRIMARY KEY  (`groupe_id`))TYPE=TYPETABLE;
CREATE TABLE IF NOT EXISTS `PREFIXEfin_echeancier_groupe` (`inscription_id` int(11) NOT NULL ,`echeancier_id` int(11) NOT NULL ,`groupe_id` int(11) NOT NULL ,`montant` double NOT NULL ,PRIMARY KEY ( `inscription_id` , `echeancier_id` , `groupe_id` ))TYPE=TYPETABLE; 
CREATE TABLE IF NOT EXISTS `PREFIXEfin_config_ecole` (`nom_fichier` varchar(32) NOT NULL,`numemet` varchar(6) NOT NULL,`icb` varchar(24) NOT NULL,`dom` varchar(24) NOT NULL,`cg` varchar(5) NOT NULL,`compt` varchar(11) NOT NULL,`libelle` varchar(31) NOT NULL,`cb` varchar(5) NOT NULL,`ref` varchar(7) NOT NULL)TYPE=TYPETABLE; 
INSERT INTO `PREFIXEfin_groupe_frais` (`groupe_id`, `libelle`) VALUES (1, 'Inscription'),(2, 'Scolarité'),(3, 'Restauration'),(4, 'Hébergement'),(5, 'Divers');
DROP TABLE `PREFIXEwebradioconfiguration`, `PREFIXEwebradioemissions`, `PREFIXEwebradiohistorique`;
INSERT INTO `PREFIXEfin_type_echeancier` (`type_echeancier_id`, `libelle`, `ordre`, `echeances`, `intervale_mois`) VALUES (1, 'Comptant', 1, 1, 0),(2, 'Mensuel (sur 12 mois)', 8, 12, 1),(3, 'En 2 fois', 2, 2, 6),(4, 'Trimestriel (4 trimestre)', 3, 4, 3),(5, 'Mensuel (sur 10 mois)', 7, 10, 1),(6, 'Mensuel (sur 8 mois)', 6, 8, 1),(7,'Mensuel (sur 5 mois)', 4, 5, 1),(8, 'Mensuel (sur 6 mois)', 5, 6, 1);



Patch 008-55
----------------
ALTER TABLE `PREFIXEabsences` ADD `courrierenvoyer` TINYINT NOT NULL DEFAULT '0';
ALTER TABLE `PREFIXEretards` ADD `courrierenvoyer` TINYINT NOT NULL DEFAULT '0';


Patch 008-53
----------------
ALTER TABLE `PREFIXEcahiertexte` ADD `number_obj` VARCHAR(50) NOT NULL , ADD `fichier_obj` VARCHAR(250) NOT NULL ;
ALTER TABLE `PREFIXEcahiertexte` ADD `blocnote` TEXT NOT NULL;
ALTER TABLE `PREFIXEregime` ADD UNIQUE (`libelle`);



Patch 008-51
----------------
ALTER TABLE `PREFIXEvacation_commande` ADD `nbforfait` INT NOT NULL DEFAULT '1';
ALTER TABLE `PREFIXEabsences` ADD `smsenvoye` TINYINT NOT NULL DEFAULT '0';
ALTER TABLE `PREFIXEretards` ADD `smsenvoye` TINYINT NOT NULL DEFAULT '0';
CREATE TABLE IF NOT EXISTS `PREFIXEregime` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,`libelle` VARCHAR( 25 ) NOT NULL ,`lundi_m` TINYINT NOT NULL DEFAULT '0',`lundi_s` TINYINT NOT NULL DEFAULT '0',`mardi_m` TINYINT NOT NULL DEFAULT '0',`mardi_s` TINYINT NOT NULL DEFAULT '0',`mercredi_m` TINYINT NOT NULL DEFAULT '0',`mercredi_s` TINYINT NOT NULL DEFAULT '0',`jeudi_m` TINYINT NOT NULL DEFAULT '0',`jeudi_s` TINYINT NOT NULL DEFAULT '0',`vendredi_m` TINYINT NOT NULL DEFAULT '0',`vendredi_s` TINYINT NOT NULL DEFAULT '0',`samedi_m` TINYINT NOT NULL DEFAULT '0',`samedi_s` TINYINT NOT NULL DEFAULT '0',`dimanche_m` TINYINT NOT NULL DEFAULT '0',`dimanche_s` TINYINT NOT NULL DEFAULT '0');



Patch 008-50
----------------

ALTER TABLE `PREFIXEeleves` ADD `mdp_moodle` VARCHAR(50) NOT NULL DEFAULT ' ';
ALTER TABLE `PREFIXEcomptaversement` ADD `libellevershistory` VARCHAR(30) NOT NULL;
CREATE TABLE IF NOT EXISTS `PREFIXEwebradiohistorique` (`ID` varchar(20) NOT NULL,`TITRE` varchar(20) NOT NULL,`HEURE` varchar(20) NOT NULL, `DATE` varchar(20) NOT NULL);
CREATE TABLE IF NOT EXISTS `PREFIXEwebradioconfiguration` (`ipserveur` varchar(20) NOT NULL,`portserveur` varchar(20) NOT NULL,  `liveserveur` varchar(20) NOT NULL);
CREATE TABLE IF NOT EXISTS `PREFIXEwebradioemissions` (  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,  `jour` decimal(1,0) NOT NULL,  `heure` decimal(2,0) NOT NULL,  `numero` decimal(3,0) NOT NULL,  `photo` varchar(50) NOT NULL,  `description` text NOT NULL,  `animateur` varchar(20) NOT NULL,  `avec` varchar(20) NOT NULL,  `rea` varchar(20) NOT NULL,  `stand` varchar(20) NOT NULL,  `hfin` varchar(20) NOT NULL,  `Minutes` decimal(2,0) NOT NULL,  `invite` text NOT NULL,  `Style` varchar(20) NOT NULL,  `siteweb` varchar(20) NOT NULL,  `Dur` varchar(20) NOT NULL,  `nom` varchar(50) NOT NULL,  PRIMARY KEY (`id`));
CREATE TABLE IF NOT EXISTS `PREFIXEentretiendureeprof` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,`idprof` INT NOT NULL ,`duree` TIME NOT NULL ,`idclasse` INT NOT NULL ,`date_saisie` DATE NOT NULL ,`ideleve` INT NOT NULL ,`reference` VARCHAR(250) NOT NULL);
TRUNCATE TABLE `PREFIXEcha_etage` ;
INSERT INTO `PREFIXEcha_etage` (`etage_id`, `libelle`, `exposant`, `ordre`) VALUES (1, 'Rdc', '', 1),(2, '1', 'er', 2),(3, '2', 'ème', 3),(4, '3', 'ème', 4),
(5, '4', 'ème', 5),(6, '5', 'ème', 6),(7, '6', 'ème', 7),(8, '7', 'ème', 8),(9, '8', 'ème', 9),(10, '9', 'ème', 10),(11, '10', 'ème', 11),(12, '11', 'ème', 12),(13, '12', 'ème', 13),(14, '13', 'ème', 14),(15, '14', 'ème', 15);
TRUNCATE TABLE `PREFIXEcha_type_chambre` ;
INSERT INTO `PREFIXEcha_type_chambre` (`type_chambre_id`, `libelle`, `ordre`, `nombre_lits`) VALUES (1, 'Simple', 1, 1),(2, 'Double', 2, 2),(3, 'Triple', 3, 3),(4, 'Quadruple', 4, 4);
ALTER TABLE `PREFIXEstage_history` ADD `ideleve` INT NOT NULL DEFAULT '0';




Patch 008-49
----------------

CREATE TABLE IF NOT EXISTS  `PREFIXEbrevetcom` (`ideleve` INT NOT NULL ,`annee` VARCHAR(5) NOT NULL ,`codematiere` INT NOT NULL , `commentaire` TEXT NOT NULL ) TYPE=TYPETABLE;
ALTER TABLE `PREFIXEbrevetcom` ADD UNIQUE (`ideleve`,`annee`,`codematiere`);


Patch 008-44
----------------
ALTER TABLE `PREFIXEpreinscription_eleves` ADD `boursier` TINYINT NOT NULL DEFAULT '0', ADD `boursier_montant` DECIMAL(50,6) NOT NULL;
ALTER TABLE `PREFIXEaffectations` ADD `ects` VARCHAR(10) NOT NULL DEFAULT '0';


Patch 008-44
----------------
ALTER TABLE `PREFIXEeleves` ADD `nbmoisindemnite` INT NOT NULL DEFAULT '0';

Patch 008-43
----------------
ALTER TABLE `PREFIXEeleves` ADD `boursier` TINYINT NOT NULL DEFAULT '0', ADD `montant_bourse` DECIMAL(50,5) NOT NULL , ADD `indemnite_stage` DECIMAL(50,5) NOT NULL;

Patch 008-41
----------------
CREATE TABLE  IF NOT EXISTS `PREFIXEvacation_commande` (`id` int(11) NOT NULL AUTO_INCREMENT ,`idmatiere` int(11) NOT NULL ,`nbheure` int(11) NOT NULL ,`type_prestation` varchar(20) default NULL ,idclasse int(11),id_pers int(11) ,PRIMARY KEY (`id`) )TYPE=TYPETABLE;
ALTER TABLE `PREFIXEmatieres` ADD `offline` TINYINT NOT NULL DEFAULT '0';


Patch 008-38
----------------
ALTER TABLE `PREFIXEstage_eleve` ADD `pays_stage` VARCHAR(200) NOT NULL;
ALTER TABLE `PREFIXEpiecejointe` DROP PRIMARY KEY; 
ALTER TABLE `PREFIXEpiecejointe` ADD UNIQUE (`md5`);
ALTER TABLE `PREFIXEstage_eleve` ADD `fax` VARCHAR(30) NOT NULL;



Patch 008-37
----------------
CREATE TABLE IF NOT EXISTS `PREFIXEentretienpedagogue` (`id_entretieneleve` INT NOT NULL ,`id_entretienpedagogue` INT NOT NULL )TYPE=TYPETABLE;
ALTER TABLE `PREFIXEentretienpedagogue` ADD UNIQUE (`id_entretieneleve`,`id_entretienpedagogue`);
ALTER TABLE `PREFIXEstage_eleve` ADD `service` VARCHAR(200) NOT NULL ,ADD `indemnitestage` VARCHAR(200) NOT NULL;


Patch 008-36a
----------------

ALTER TABLE `PREFIXEstage_entreprise` CHANGE `nbchambre` `nbchambre` VARCHAR(250) NOT NULL DEFAULT '0';
ALTER TABLE `PREFIXEstage_entreprise` CHANGE `nbetoile` `nbetoile` VARCHAR(250) NOT NULL DEFAULT '0';

Patch 008-36
----------------

CREATE TABLE IF NOT EXISTS  `PREFIXEstage_history` (`identreprise` INT NOT NULL ,`nomprenomeleve` VARCHAR(200) NOT NULL ,`classeeleve` VARCHAR(50) NOT NULL ,`periodestage` VARCHAR(50) NOT NULL) TYPE=TYPETABLE;
ALTER TABLE `PREFIXEcentralstagesouhait` ADD `logement` TINYINT NOT NULL DEFAULT '0';
ALTER TABLE `PREFIXEstage_entreprise` ADD `nbchambre` INT NOT NULL DEFAULT '0',ADD `siteweb` VARCHAR(250) NOT NULL ,ADD `grphotelier` VARCHAR(250) NOT NULL ,ADD `nbetoile` INT NOT NULL DEFAULT '0';
ALTER TABLE `PREFIXEpersonnel` ADD `qualite` VARCHAR(100) NOT NULL DEFAULT ' ';


Patch 008-35.a
----------------


ALTER TABLE `PREFIXEcentralstageattribution` ADD `productid` VARCHAR(250) NOT NULL;
ALTER TABLE `PREFIXEcentralstagesouhait` DROP `reservation`;
ALTER TABLE `PREFIXEcentralstagesouhait` DROP `idproductreserv`; 
ALTER TABLE `PREFIXEcentralstageattribution` DROP INDEX `id`;
ALTER TABLE `PREFIXEcentralstageattribution` ADD UNIQUE (`id`,`idcentralstage`,`productid`);



Patch 008-35
----------------
DELETE FROM users WHERE userid='1';

Patch 008-34
----------------
CREATE TABLE IF NOT EXISTS  `PREFIXEabs_rtd_info` (`id` int(11) NOT NULL auto_increment,`classe` varchar(30) NOT NULL,`date` date NOT NULL,`heure` time default NULL,`matiere` varchar(50) NOT NULL,`enseignant` varchar(80) NOT NULL,`nbabs` int(11) NOT NULL,`nbrtd` int(11) NOT NULL,PRIMARY KEY  (`id`),KEY `id` (`id`)) TYPE=TYPETABLE;



Patch 008-33
----------------
CREATE TABLE  IF NOT EXISTS `PREFIXEcentralstageattribution` (`id` INT NOT NULL ,`idcentralstage` INT NOT NULL ,`attribution` TEXT NOT NULL ,UNIQUE (`id` ,`idcentralstage` )) TYPE=TYPETABLE;
ALTER TABLE `PREFIXEdiscipline_retenue` ADD `repport_du` DATE NOT NULL;
ALTER TABLE `PREFIXEcentralstagesouhait` DROP `attribution`; 
ALTER TABLE `PREFIXEcentralstagesouhait` ADD `salaire` VARCHAR(250) NOT NULL;




supprimer  ./pmb/trables/ à faire dans vérifie



// ne pas patché !!! 

ALTER TABLE `tria_im_USR_USER` ADD `USR_NICKNAME` VARCHAR(20) NOT NULL AFTER `USR_USERNAME`;
ALTER TABLE `tria_im_USR_USER` CHANGE `USR_USERNAME` `USR_USERNAME` VARCHAR(50) NOT NULL , CHANGE `USR_NICKNAME` `USR_NICKNAME` VARCHAR( 50 ) NOT NULL;
INSERT INTO `tria_patch` (`idpatch` ,`date` ,`heure` ,`info` )VALUES ('008-29', '2010-11-24', '00:00:00', 'installation support');




Patch 008-30
----------------
ALTER TABLE `PREFIXEaffectations` ADD `nb_heure` VARCHAR(30) NOT NULL DEFAULT ' ', ADD `trim` VARCHAR(30) NOT NULL DEFAULT 'tous';
ALTER TABLE `PREFIXEnews_admin` ADD `type` VARCHAR(10) NOT NULL DEFAULT 'text';
ALTER TABLE `PREFIXEnews_admin` ADD `config_video` VARCHAR(30) NOT NULL DEFAULT ' ';
ALTER TABLE `PREFIXEbulletin_direction_com` ADD `leap_encouragement` TINYINT NOT NULL DEFAULT '0', ADD `leap_felicitation` TINYINT NOT NULL DEFAULT '0',ADD `leap_meg_comp` TINYINT NOT NULL DEFAULT '0',ADD `leap_meg_trav` TINYINT NOT NULL DEFAULT '0';
ALTER TABLE `PREFIXEaffectations` DROP PRIMARY KEY,ADD PRIMARY KEY (`code_classe`,`code_matiere`,`code_prof`,`ordre_affichage`,`trim`);


Patch 008-29
----------------
ALTER TABLE `PREFIXEstage_entreprise` CHANGE `nom` `nom` VARCHAR(50);
ALTER TABLE `PREFIXEcentralstagesouhait` ADD `reservation` VARCHAR(90) NOT NULL;
ALTER TABLE `PREFIXEcentralstagesouhait` ADD `idproductreserv` VARCHAR(90) NOT NULL;
CREATE TABLE IF NOT EXISTS `PREFIXEhistoeleve` (`ideleve` int(11) NOT NULL,`date` date NOT NULL,`action` varchar(250) NOT NULL,`info` varchar(250) NOT NULL)TYPE=TYPETABLE;


Patch 008-27
----------------
CREATE TABLE IF NOT EXISTS `PREFIXEbulletin_visible` (`idclasse` INT NOT NULL ,`bulletin` VARCHAR( 90 ) NOT NULL ,UNIQUE (`idclasse` ))TYPE=TYPETABLE;


Patch 008-26
----------------
CREATE TABLE IF NOT EXISTS `PREFIXEcha_batiment` (  `batiment_id` int(11) NOT NULL auto_increment,  `libelle` varchar(64) NOT NULL,  `adresse_1` varchar(64) default NULL,  `adresse_2` varchar(64) default NULL,  `adresse_3` varchar(64) default NULL,  `code_postal` varchar(5) default NULL,  `ville` varchar(64) default NULL,  PRIMARY KEY  (`batiment_id`))TYPE=TYPETABLE;
CREATE TABLE IF NOT EXISTS `PREFIXEcha_chambre` (  `chambre_id` int(11) NOT NULL auto_increment,  `batiment_id` int(11) NOT NULL default '0',  `numero` varchar(5) default NULL,  `libelle` varchar(64) NOT NULL,  `type_chambre_id` int(11) NOT NULL default '1',  `etage_id` int(11) NOT NULL default '0',  PRIMARY KEY  (`chambre_id`))TYPE=TYPETABLE;
CREATE TABLE IF NOT EXISTS `PREFIXEcha_reservation` (  `reservation_id` int(11) NOT NULL auto_increment,  `elev_id` int(11) NOT NULL default '0',  `chambre_id` int(11) NOT NULL default '0',  `date_debut` date default NULL,  `date_fin` date default NULL,  `commentaire` text collate latin1_general_ci,  `date_reservation` datetime default NULL,  PRIMARY KEY  (`reservation_id`))TYPE=TYPETABLE;
CREATE TABLE IF NOT EXISTS `PREFIXEcha_type_chambre` (  `type_chambre_id` int(11) NOT NULL auto_increment,  `libelle` varchar(64) collate latin1_general_ci NOT NULL,  `ordre` tinyint(1) NOT NULL default '0',  `nombre_lits` int(1) NOT NULL default '1',  PRIMARY KEY  (`type_chambre_id`))TYPE=TYPETABLE;
CREATE TABLE IF NOT EXISTS `PREFIXEcha_etage` (  `etage_id` int(11) NOT NULL auto_increment,  `libelle` varchar(64) collate latin1_general_ci NOT NULL,  `exposant` varchar(8) collate latin1_general_ci default NULL,  `ordre` tinyint(1) NOT NULL default '0',  PRIMARY KEY  (`etage_id`))TYPE=TYPETABLE;



SPECIF VATEL
----------------
INSERT INTO `PREFIXEfin_type_frais` (`type_frais_id`, `libelle`, `lisse`, `caution`) VALUES (1, 'Frais d''inscription', 0, 0),(2, 'Frais de scolarité par prél', 1, 0),(3, 'Caution logement', 0, 1),(4, 'Securité sociale', 0, 0),(5, 'Uniforme (fille ou garcon)', 0, 1),(7, 'Logement 330 euros', 1, 0),(8, 'Self DP', 1, 0),(9, 'Trousseau', 0, 0),(10, 'BDE', 0, 0),(11, 'Abonnement', 0, 0),(12, 'Assurances', 0, 0),(13, 'Examen Européen', 0, 0),(14, 'Examen DU', 0, 0),(15, 'Bibliothéque', 0, 0),(16, 'Frais de scolarité au comptant', 0, 0),(17, 'Logement 350 euros', 0, 0),(18, 'SELF PC', 1, 0),(19, 'SCOLARITE 3 ANS', 0, 0),(20, 'SCOLARITE 5 ANS', 0, 0),(21, 'Frais d''inscription nouveau', 0, 0),(22, 'Remise exceptionnelle', 0, 0),(23, 'Ménage CH', 0, 0),(24, 'livres et photocopies', 0, 0),(25, 'Logement', 0, 0),(26, 'Sport', 0, 0),(27, 'Transfert', 0, 0),(28, 'parking', 0, 0),(29, 'frais carte de séjour', 0, 0);
INSERT INTO `PREFIXEfin_type_reglement` (`type_reglement_id`, `libelle`, `modifiable`) VALUES (1, 'Carte bancaire', 1),(2, 'Chêque', 0),(3, 'Espéce', 0),(4, 'Prélèvement', 0),(7, 'Virement', 1);
INSERT INTO `PREFIXEfin_type_echeancier` (`type_echeancier_id`, `libelle`, `ordre`, `echeances`, `intervale_mois`) VALUES (1, 'Comptant', 1, 1, 0),(2, 'Mensuel (sur 12 mois)', 8, 12, 1),(3, 'En 2 fois', 2, 2, 6),(4, 'Trimestriel (4 trimestre)', 3, 4, 3),(5, 'Mensuel (sur 10 mois)', 7, 10, 1),(6, 'Mensuel (sur 8 mois)', 6, 8, 1),(7, 'Mensuel (sur 5 mois)', 4, 5, 1),(8, 'Mensuel (sur 6 mois)', 5, 6, 1);


Patch 008-25
----------------
CREATE TABLE IF NOT EXISTS `PREFIXEim_BAN_BANNED` (  `BAN_TYPE` char(1) NOT NULL,  `BAN_VALUE` varchar(50) default NULL,  KEY `BAN_TYPE` (`BAN_TYPE`,`BAN_VALUE`));
CREATE TABLE IF NOT EXISTS `PREFIXEim_CNF_CONFERENCE` (  `ID_CONFERENCE` int(11) NOT NULL auto_increment,  `ID_USER` int(11) NOT NULL,  `CNF_DATE_CREAT` date NOT NULL default '0000-00-00',  `CNF_TIME_CREAT` time NOT NULL default '00:00:00',  PRIMARY KEY  (`ID_CONFERENCE`),  KEY `ID_USER` (`ID_USER`));
CREATE TABLE IF NOT EXISTS `PREFIXEim_CNT_CONTACT` (  `ID_CONTACT` int(11) NOT NULL auto_increment,  `ID_USER_1` int(11) NOT NULL default '0',  `ID_USER_2` int(11) NOT NULL default '0',  `CNT_STATUS` tinyint(4) NOT NULL default '0',  `CNT_NEW_USERNAME` varchar(20) NOT NULL default '',  `CNT_USER_GROUP` varchar(20) NOT NULL default '',  `CNT_RATING` tinyint(4) NOT NULL default '0',  `CNT_SOUND` tinyint(3) unsigned NOT NULL default '0',  PRIMARY KEY  (`ID_CONTACT`),  KEY `ID_USER_1` (`ID_USER_1`),  KEY `ID_USER_2` (`ID_USER_2`));
CREATE TABLE IF NOT EXISTS `PREFIXEim_GRP_GROUP` (  `ID_GROUP` int(11) NOT NULL auto_increment,  `GRP_NAME` varchar(20) NOT NULL,  `GRP_PRIVATE` tinyint(4) NOT NULL default '0',  `GRP_SHOUTBOX` tinyint(4) unsigned NOT NULL default '0',  `GRP_SBX_NEED_APPROVAL` tinyint(4) unsigned NOT NULL default '0',  PRIMARY KEY  (`ID_GROUP`),  UNIQUE KEY `GRP_NAME` (`GRP_NAME`));
CREATE TABLE IF NOT EXISTS `PREFIXEim_MSG_MESSAGE` (  `ID_MESSAGE` int(11) NOT NULL auto_increment,  `ID_USER_AUT` int(11) NOT NULL default '0',  `ID_USER_DEST` int(11) NOT NULL default '0',  `MSG_TEXT` text NOT NULL,  `MSG_CR` char(2) NOT NULL default '',  `MSG_ETAT` tinyint(4) NOT NULL default '0',  `MSG_TIME` time NOT NULL default '00:00:00',  `MSG_DATE` date NOT NULL default '0000-00-00',  `ID_CONFERENCE` int(11) NOT NULL default '0',  PRIMARY KEY  (`ID_MESSAGE`),  KEY `ID_USER_AUT` (`ID_USER_AUT`),  KEY `ID_USER_DEST` (`ID_USER_DEST`),  KEY `ID_CONFERENCE` (`ID_CONFERENCE`));
CREATE TABLE IF NOT EXISTS `PREFIXEim_SBS_SHOUTSTATS` (  `ID_USER_AUT` mediumint(9) NOT NULL,  `SBS_NB` smallint(5) unsigned NOT NULL default '1',  `SBS_NB_REJECT` tinyint(3) unsigned NOT NULL default '0',  `SBS_NB_VOTE_M` smallint(5) unsigned NOT NULL default '0',  `SBS_NB_VOTE_L` smallint(5) unsigned NOT NULL default '0',  `SBS_MAX_VOTE_M` smallint(5) unsigned NOT NULL default '0',  `SBS_MAX_VOTE_L` smallint(5) unsigned NOT NULL default '0',  `SBS_NB_LAST_DATE` smallint(5) unsigned NOT NULL default '1',  `SBS_LAST_DATE` date NOT NULL,  `SBS_NB_LAST_WEEK` smallint(5) unsigned NOT NULL default '1',  `SBS_LAST_WEEK` tinyint(3) unsigned NOT NULL,  PRIMARY KEY  (`ID_USER_AUT`));
CREATE TABLE IF NOT EXISTS `PREFIXEim_SBV_SHOUTVOTE` (  `ID_SHOUT` mediumint(8) unsigned NOT NULL,  `ID_USER_VOTE` mediumint(9) NOT NULL,  `ID_USER_AUT` mediumint(9) NOT NULL COMMENT 'For stats',  `SBV_DATE` date NOT NULL,  `SBV_VOTE_M` tinyint(4) NOT NULL,  `SBV_VOTE_L` tinyint(4) NOT NULL,  PRIMARY KEY  (`ID_SHOUT`,`ID_USER_VOTE`),  KEY `SBV_IND_1` (`ID_USER_AUT`));
CREATE TABLE IF NOT EXISTS `PREFIXEim_SBX_SHOUTBOX` (  `ID_SHOUT` mediumint(8) unsigned NOT NULL auto_increment,  `ID_GROUP_DEST` smallint(5) unsigned NOT NULL default '0',  `ID_USER_AUT` mediumint(9) NOT NULL,  `SBX_TEXT` varchar(250) NOT NULL,  `SBX_TIME` time NOT NULL,  `SBX_DATE` date NOT NULL,  `SBX_DISPLAY` tinyint(4) NOT NULL default '1',  `SBX_RATING` tinyint(4) NOT NULL default '0',  PRIMARY KEY  (`ID_SHOUT`),  KEY `SBX_IND_1` (`SBX_DATE`,`SBX_TIME`),  KEY `SBX_IND_2` (`ID_SHOUT`,`ID_GROUP_DEST`));
CREATE TABLE IF NOT EXISTS `PREFIXEim_SES_SESSION` (  `ID_SESSION` int(11) NOT NULL auto_increment,  `ID_USER` int(11) NOT NULL default '0',  `SES_STATUS` tinyint(4) NOT NULL default '0',  `SES_STARTDATE` date NOT NULL default '0000-00-00',  `SES_STARTTIME` time NOT NULL default '00:00:00',  `SES_LASTTIME` time NOT NULL default '00:00:00',  `SES_IP_ADDRESS` varchar(23) NOT NULL default '',  `SES_AWAY_REASON` tinyint(4) NOT NULL default '0',  PRIMARY KEY  (`ID_SESSION`),  UNIQUE KEY `ID_USER` (`ID_USER`),  KEY `SES_STATUS` (`SES_STATUS`));
CREATE TABLE IF NOT EXISTS `PREFIXEim_SRV_SERVERSTATE` (  `ID_SERVER` smallint(5) unsigned NOT NULL auto_increment,  `SRV_NAME` varchar(60) NOT NULL,  `SRV_IP_ADDRESS` varchar(23) NOT NULL default '',  `SRV_STATE` tinyint(3) unsigned NOT NULL default '0',  `SRV_STATE_DATE` date NOT NULL default '0000-00-00',  `SRV_STATE_TIME` time NOT NULL default '00:00:00',  `SRV_STATE_COMMENT` varchar(150) NOT NULL default '',  PRIMARY KEY  (`ID_SERVER`),  UNIQUE KEY `SRV_NAME` (`SRV_NAME`));
CREATE TABLE IF NOT EXISTS `PREFIXEim_STA_STATS` (  `STA_DATE` date NOT NULL,  `STA_NB_MSG` int(11) NOT NULL default '0',  `STA_NB_CREAT` int(11) NOT NULL default '0',  `STA_NB_SESSION` int(11) NOT NULL default '0',  `STA_NB_USR` int(11) NOT NULL default '0',  `STA_SBX_NB_MSG` int(11) unsigned NOT NULL default '0',  PRIMARY KEY  (`STA_DATE`));
CREATE TABLE IF NOT EXISTS `PREFIXEim_USC_USERCONF` (  `ID_CONFERENCE` int(11) NOT NULL,  `ID_USER` int(11) NOT NULL,  `USC_ACTIVE` tinyint(4) NOT NULL default '0',  KEY `ID_CONFERENCE` (`ID_CONFERENCE`,`ID_USER`));
CREATE TABLE IF NOT EXISTS `PREFIXEim_USG_USERGRP` (  `ID_GROUP` int(11) NOT NULL,  `ID_USER` int(11) NOT NULL,  `USG_PENDING` tinyint(4) NOT NULL default '0',  KEY `ID_GROUP` (`ID_GROUP`,`ID_USER`));
CREATE TABLE IF NOT EXISTS `PREFIXEim_USR_USER` (  `ID_USER` int(11) NOT NULL auto_increment,  `USR_USERNAME` varchar(20) NOT NULL default '',  `USR_NICKNAME` varchar(20) NOT NULL,  `USR_NAME` varchar(50) NOT NULL default '',  `USR_LEVEL` tinyint(4) NOT NULL default '0',  `USR_STATUS` tinyint(4) NOT NULL default '0',  `USR_PASSWORD` varchar(40) NOT NULL default '',  `USR_CHECK` varchar(15) NOT NULL default '',  `USR_DATE_CREAT` date NOT NULL default '0000-00-00',  `USR_DATE_LAST` date NOT NULL default '0000-00-00',  `USR_DATE_PASSWORD` date NOT NULL,  `USR_DATE_ACTIVITY` date NOT NULL,  `USR_VERSION` varchar(6) NOT NULL default '',  `USR_COUNTRY_CODE` char(2) NOT NULL default '',  `USR_LANGUAGE_CODE` char(2) NOT NULL default '',  `USR_IP_ADDRESS` varchar(23) NOT NULL default '',  `USR_AVATAR` varchar(20) NOT NULL default '',  `USR_TIME_SHIFT` smallint(6) NOT NULL default '0',  `USR_OS` varchar(5) NOT NULL default '',  `USR_EMAIL` varchar(80) NOT NULL default '',  `USR_PHONE` varchar(20) NOT NULL default '',  `USR_PWD_ERRORS` smallint(6) NOT NULL default '0',  `USR_GENDER` char(1) NOT NULL default '',  `USR_NB_CONNECT` smallint(6) NOT NULL default '0',  `USR_GET_ADMIN_ALERT` tinyint(4) NOT NULL default '0',  `USR_TRIADE_PHENIX` varchar(80) NOT NULL,  `USR_GET_OFFLINE_MSG` tinyint(4) NOT NULL default '2',  `USR_MAC_ADR` char(12) NOT NULL default '',  `USR_COMPUTERNAME` varchar(20) NOT NULL default '',  `USR_SCREEN_SIZE` varchar(10) NOT NULL default '',  `USR_EMAIL_CLIENT` varchar(40) NOT NULL default '',  `USR_BROWSER` varchar(40) NOT NULL default '',  `USR_OOO` varchar(5) NOT NULL default '',  `USR_RATING` tinyint(4) NOT NULL default '0',  `USR_ONLINE` tinyint(4) NOT NULL default '0',  `USR_TIME_LOCK` time NOT NULL default '00:00:00',  `USR_REG` varchar(30) NOT NULL default '',  PRIMARY KEY  (`ID_USER`),  UNIQUE KEY `USR_USERNAME` (`USR_USERNAME`),  KEY `USR_NAME` (`USR_NAME`),  KEY `USR_LEVEL` (`USR_LEVEL`),  KEY `USR_DATE_CREAT` (`USR_DATE_CREAT`),  KEY `USR_DATE_LAST` (`USR_DATE_LAST`),  KEY `USR_GET_ADMIN_ALERT` (`USR_GET_ADMIN_ALERT`));
INSERT INTO `PREFIXEim_BAN_BANNED` (`BAN_TYPE`, `BAN_VALUE`) VALUES('I', '128.0.0.2'),('I', '128.0.0.3'),('U', 'administrador'),('U', 'anonime'),('U', 'anonyme'),('U', 'anonymous'),('U', 'azerty'),('U', 'banned'),('U', 'crotte'),('U', 'delete'),('U', 'distinct'),('U', 'fucked'),('U', 'fucker'),('U', 'guest'),('U', 'handler'),('U', 'having'),('U', 'inconnu'),('U', 'insert'),('U', 'invite'),('U', 'merde'),('U', 'moderateur'),('U', 'moderator'),('U', 'password'),('U', 'porno'),('U', 'procedure'),('U', 'putain'),('U', 'putin'),('U', 'qwerty'),('U', 'raped'),('U', 'raper'),('U', 'replace'),('U', 'salope'),('U', 'select'),('U', 'server'),('U', 'serveur'),('U', 'sexe'),('U', 'truncate'),('U', 'unknown'),('U', 'unknowned'),('U', 'update'),('U', 'username'),('U', 'viagra'),('U', 'webmaster'),('U', 'webmestre');



Patch 008-24
----------------
ALTER TABLE `PREFIXEIM_CNT_CONTACT` ADD `CNT_SOUND` TINYINT( 3 ) UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE `PREFIXEIM_GRP_GROUP` ADD `GRP_SHOUTBOX` TINYINT( 4 ) UNSIGNED  NOT NULL DEFAULT '0', ADD `GRP_SBX_NEED_APPROVAL` TINYINT( 4 ) UNSIGNED  NOT NULL DEFAULT '0';
ALTER TABLE `PREFIXEIM_STA_STATS` ADD `STA_SBX_NB_MSG` INT( 11 ) UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE `PREFIXEIM_USR_USER` ADD `USR_DATE_PASSWORD` DATE NOT NULL AFTER `USR_DATE_LAST` ,ADD `USR_DATE_ACTIVITY` DATE NOT NULL AFTER `USR_DATE_PASSWORD` ;
ALTER TABLE `PREFIXEIM_USR_USER` ADD `USR_NICKNAME` VARCHAR( 20 ) NOT NULL AFTER `USR_USERNAME`;
ALTER TABLE `PREFIXEIM_USG_USERGRP` ADD `USG_PENDING` TINYINT( 4 ) NOT NULL DEFAULT '0';
CREATE TABLE IF NOT EXISTS `PREFIXEIM_SBS_SHOUTSTATS` ( `ID_USER_AUT` mediumint(9) NOT NULL,  `SBS_NB` smallint(5) unsigned NOT NULL default '1',  `SBS_NB_REJECT` tinyint(3) unsigned NOT NULL default '0',  `SBS_NB_VOTE_M` smallint(5) unsigned NOT NULL default '0',  `SBS_NB_VOTE_L` smallint(5) unsigned NOT NULL default '0',  `SBS_MAX_VOTE_M` smallint(5) unsigned NOT NULL default '0',  `SBS_MAX_VOTE_L` smallint(5) unsigned NOT NULL default '0',  `SBS_NB_LAST_DATE` smallint(5) unsigned NOT NULL default '1',  `SBS_LAST_DATE` date NOT NULL,  `SBS_NB_LAST_WEEK` smallint(5) unsigned NOT NULL default '1',  `SBS_LAST_WEEK` tinyint(3) unsigned NOT NULL,PRIMARY KEY  (`ID_USER_AUT`));
CREATE TABLE IF NOT EXISTS `PREFIXEIM_SBV_SHOUTVOTE` (  `ID_SHOUT` mediumint(8) unsigned NOT NULL,  `ID_USER_VOTE` mediumint(9) NOT NULL,  `ID_USER_AUT` mediumint(9) NOT NULL COMMENT 'For stats',  `SBV_DATE` date NOT NULL,  `SBV_VOTE_M` tinyint(4) NOT NULL,  `SBV_VOTE_L` tinyint(4) NOT NULL,  PRIMARY KEY  (`ID_SHOUT`,`ID_USER_VOTE`),  KEY `SBV_IND_1` (`ID_USER_AUT`));
CREATE TABLE IF NOT EXISTS `PREFIXEIM_SBX_SHOUTBOX` (  `ID_SHOUT` mediumint(8) unsigned NOT NULL auto_increment,  `ID_GROUP_DEST` smallint(5) unsigned NOT NULL default '0',  `ID_USER_AUT` mediumint(9) NOT NULL,  `SBX_TEXT` varchar(250) NOT NULL,  `SBX_TIME` time NOT NULL,  `SBX_DATE` date NOT NULL,  `SBX_DISPLAY` tinyint(4) NOT NULL default '1',  `SBX_RATING` tinyint(4) NOT NULL default '0',  PRIMARY KEY  (`ID_SHOUT`),  KEY `SBX_IND_1` (`SBX_DATE`,`SBX_TIME`),  KEY `SBX_IND_2` (`ID_SHOUT`,`ID_GROUP_DEST`));
CREATE TABLE IF NOT EXISTS `PREFIXEIM_SRV_SERVERSTATE` (`ID_SERVER` smallint(5) unsigned NOT NULL auto_increment,`SRV_NAME` varchar(60) NOT NULL,`SRV_IP_ADDRESS` varchar(23) NOT NULL default '',`SRV_STATE` tinyint(3) unsigned NOT NULL default '0',`SRV_STATE_DATE` date NOT NULL default '0000-00-00',`SRV_STATE_TIME` time NOT NULL default '00:00:00',`SRV_STATE_COMMENT` varchar(150) NOT NULL default '',PRIMARY KEY  (`ID_SERVER`),UNIQUE KEY `SRV_NAME` (`SRV_NAME`));
CREATE TABLE IF NOT EXISTS `PREFIXEfin_bareme` (`bareme_id` int(11) NOT NULL auto_increment,`code_class` int(11) NOT NULL default '0',`libelle` varchar(64) NOT NULL,`annee_scolaire` varchar(11) NOT NULL, PRIMARY KEY  (`bareme_id`));
CREATE TABLE IF NOT EXISTS `PREFIXEfin_echeancier` (`echeancier_id` int(11) NOT NULL auto_increment,`inscription_id` int(11) NOT NULL default '0',`date_echeance` date NOT NULL,`montant` double NOT NULL,`impaye` tinyint(1) NOT NULL default '0',`type_reglement_id` int(11) NOT NULL default '0',`libelle` varchar(64)  NOT NULL,`type` tinyint(1) NOT NULL default '0',`numero_rib` tinyint(1) NOT NULL default '0',`lisse` tinyint(1) NOT NULL default '1', PRIMARY KEY  (`echeancier_id`));
CREATE TABLE IF NOT EXISTS `PREFIXEfin_frais_bareme` (`frais_bareme_id` int(11) NOT NULL auto_increment,`bareme_id` int(11) NOT NULL default '0',`type_frais_id` int(11) NOT NULL default '0',`montant` double NOT NULL default '0',`optionnel` tinyint(1) NOT NULL default '0',`lisse` tinyint(1) NOT NULL default '1', PRIMARY KEY  (`frais_bareme_id`));
CREATE TABLE IF NOT EXISTS `PREFIXEfin_frais_inscription` (`frais_inscription_id` int(11) NOT NULL auto_increment,`inscription_id` int(11) NOT NULL default '0',`type_frais_id` int(11) NOT NULL default '0',`montant` double NOT NULL default '0',`optionnel` tinyint(1) NOT NULL default '0',`selectionne` tinyint(1) NOT NULL default '0',`lisse` tinyint(1) NOT NULL default '1',`caution_remboursee` tinyint(1) NOT NULL default '0', PRIMARY KEY  (`frais_inscription_id`));
CREATE TABLE IF NOT EXISTS `PREFIXEfin_inscriptions` (`inscription_id` int(11) NOT NULL auto_increment,`elev_id` int(11) NOT NULL default '0',`code_class` int(11) NOT NULL default '0',`annee_scolaire` varchar(11) character set utf8 NOT NULL,`date_inscription` datetime NOT NULL,`type_echeancier_id` int(11) NOT NULL default '0',`date_depart` date default NULL,`commentaire` text character set utf8 NOT NULL,`id_bareme_initial` int(11) NOT NULL default '0', PRIMARY KEY  (`inscription_id`));
CREATE TABLE IF NOT EXISTS `PREFIXEfin_reglement` (`reglement_id` int(11) NOT NULL auto_increment,`echeancier_id` int(11) NOT NULL default '0',`libelle` varchar(64) character set utf8 NOT NULL,  `date_reglement` date NOT NULL,  `montant` double NOT NULL default '0',  `type_reglement_id` int(11) NOT NULL,  `realise` tinyint(1) NOT NULL default '0',  `commentaire` text collate latin1_general_ci NOT NULL,  `date_enregistrement` datetime NOT NULL,  `numero_bordereau` varchar(32) collate latin1_general_ci NOT NULL,  `numero_cheque` varchar(10) collate latin1_general_ci NOT NULL,  PRIMARY KEY  (`reglement_id`));
CREATE TABLE IF NOT EXISTS `PREFIXEfin_rib` (`rib_id` int(11) NOT NULL auto_increment,`elev_id` int(11) NOT NULL,`numero_rib` tinyint(1) NOT NULL default '0',`code_banque` varchar(5) NOT NULL,`code_guichet` varchar(5) NOT NULL,`numero_compte` varchar(11) NOT NULL,`cle_rib` varchar(2) NOT NULL,`libelle` varchar(32) NOT NULL,`titulaire` varchar(24) NOT NULL,`banque` varchar(24) NOT NULL,`iban` varchar(27) NOT NULL,`bic` varchar(11) NOT NULL,`swift` varchar(16) NOT NULL, PRIMARY KEY  (`rib_id`));
CREATE TABLE IF NOT EXISTS `PREFIXEfin_type_echeancier` (`type_echeancier_id` int(11) NOT NULL auto_increment,`libelle` varchar(64) character set utf8 NOT NULL,`ordre` tinyint(3) NOT NULL,`echeances` tinyint(2) NOT NULL,`intervale_mois` tinyint(99) NOT NULL, PRIMARY KEY  (`type_echeancier_id`));
CREATE TABLE IF NOT EXISTS `PREFIXEfin_type_frais` (`type_frais_id` int(11) NOT NULL auto_increment,`libelle` varchar(64) NOT NULL,`lisse` tinyint(1) NOT NULL default '0',`caution` tinyint(1) NOT NULL default '0',PRIMARY KEY  (`type_frais_id`));
CREATE TABLE IF NOT EXISTS `PREFIXEfin_type_reglement` (`type_reglement_id` int(11) NOT NULL auto_increment,`libelle` varchar(64) NOT NULL,`modifiable` tinyint(1) NOT NULL default '1',PRIMARY KEY  (`type_reglement_id`));

supprimer : patch 008-28
-----------
./messenger/distant/avatar_list.php   
./messenger/distant/avatar_update.php   
./messenger/distant/chang_pass_user.php   
./messenger/distant/chang_pseudo_user.php   
./messenger/distant/conference_accept.php   
./messenger/distant/conference_invite.php   
./messenger/distant/conference_list_user.php   
./messenger/distant/conference_msg_send.php   
./messenger/distant/conference_quit.php   
./messenger/distant/contact_user_ask_add.php   
./messenger/distant/contact_user_confirme.php   
./messenger/distant/contact_user_delete.php   
./messenger/distant/contact_user_delete_wait.php   
./messenger/distant/contact_user_group.php   
./messenger/distant/contact_user_infos.php   
./messenger/distant/contact_user_mask.php   
./messenger/distant/contact_user_privilege.php   
./messenger/distant/contact_user_pseudo.php   
./messenger/distant/contact_user_reject.php   
./messenger/distant/leave_server.php   
./messenger/distant/list_contact_of_user.php   
./messenger/distant/list_contact_online_offline.php   
./messenger/distant/list_contact_online_only.php   
./messenger/distant/list_contact_user_to_confirm.php   
./messenger/distant/list_users.php   
./messenger/distant/msg_get.php   
./messenger/distant/msg_list_contact.php   
./messenger/distant/msg_nb.php   
./messenger/distant/msg_send.php   
./messenger/distant/phenix_today.php   
./messenger/distant/phenix_triade_today.php   
./messenger/distant/stop.php   
./messenger/distant/user_infos_list.php   
./messenger/distant/user_infos_update.php   
./messenger/distant/im_annu.php   
./messenger/distant/status.php   
./messenger/distant/get_options_2.php   
./messenger/distant/sql_test.php   
./messenger/distant/start.php  





Patch 008-20
----------------
ALTER TABLE `PREFIXEcentralstagesouhait` ADD `idperiode` INT NOT NULL;
ALTER TABLE `PREFIXEcentralstagesouhait` DROP `debut_periode`; 
ALTER TABLE `PREFIXEcentralstagesouhait` DROP `fin_periode`; 
CREATE TABLE `PREFIXEcentralstagedate` (`nomstage` VARCHAR( 100 ) NOT NULL ,`datedebut` DATE NOT NULL ,`datefin` DATE NOT NULL ,`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY )TYPE=TYPETABLE;
ALTER TABLE `PREFIXEcentralstageaffiliation` ADD `password` VARCHAR( 100 ) NOT NULL;
CREATE TABLE `PREFIXEcentralstageaffiliation` (`productid` VARCHAR( 250 ) NOT NULL ,`etablissement` VARCHAR( 250 ) NOT NULL ,`nom` VARCHAR( 100 ) NOT NULL ,`email` VARCHAR( 250 ) NOT NULL ,`pays` VARCHAR( 100 ) NOT NULL ,`ville` VARCHAR( 100 ) NOT NULL ,`datedemande` DATE NOT NULL ,`autorise` TINYINT NOT NULL DEFAULT '0',PRIMARY KEY ( `productid` ) )TYPE=TYPETABLE;
ALTER TABLE `PREFIXEedt_seances` ADD `affichehoraire` TINYINT NOT NULL DEFAULT '1';
ALTER TABLE `PREFIXEparametrage` DROP INDEX `libelle`;
ALTER TABLE `PREFIXEmessageries` ADD `brouillon` TINYINT NOT NULL DEFAULT '0';
ALTER TABLE `PREFIXEmessageries` ADD `impression` TINYINT NOT NULL DEFAULT '0';

Patch 008-21
----------------
ALTER TABLE `PREFIXEcirculaire` ADD `comptetuteurdestage` TINYINT NOT NULL DEFAULT '0';


Patch 008-19
----------------
ALTER TABLE `PREFIXEpreinscription_eleves` ADD `information` TEXT NOT NULL ,ADD `adr_eleve` VARCHAR( 100 ) NOT NULL ,ADD `ccp_eleve` VARCHAR( 15 ) NOT NULL ,ADD `commune_eleve` VARCHAR( 40 ) NOT NULL ,ADD `tel_fixe_eleve` VARCHAR( 25 ) NOT NULL ,ADD `pays_eleve` VARCHAR( 50 ) NOT NULL;


Patch 008-17
--------------
CREATE TABLE  PREFIXEcentralstagesouhait (`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,`datedemande` DATE NOT NULL ,`identreprise` INT NOT NULL ,`sexe` VARCHAR( 250 ) NOT NULL ,`service` VARCHAR( 250 ) NOT NULL ,`observation` VARCHAR( 250 ) NOT NULL ,`debut_periode` DATE NOT NULL ,`fin_periode` DATE NOT NULL ,`nbdemande` INT NOT NULL DEFAULT '1',`attribution` VARCHAR(250) NOT NULL ) TYPE=TYPETABLE;


Patch 008-16
--------------
ALTER TABLE PREFIXEparametrage ADD idclasse INT NOT NULL DEFAULT '0';
ALTER TABLE PREFIXEparametrage ADD info TEXT NOT NULL ;


Patch 008-13
--------------
ALTER TABLE PREFIXEdiscipline_retenue ADD `courrier_env` TINYINT NOT NULL DEFAULT '0';


Patch 008-12
--------------
CREATE TABLE  PREFIXEabsences_sconet (`ideleve` INT NOT NULL ,`nb_abs` INT NOT NULL ,`nb_abs_no_just` INT NOT NULL ,`nb_rtd` INT NOT NULL ,`trimestre` VARCHAR(25) NOT NULL) TYPE=TYPETABLE ;
ALTER TABLE  PREFIXEstage_contrerendu ADD `fichier_md5` VARCHAR(50) NOT NULL DEFAULT ' ', ADD `fichier_name` VARCHAR(250) NOT NULL DEFAULT ' ';
ALTER TABLE  PREFIXEstage_contrerendu ADD `id_prof_visite` INT NOT NULL ;


Patch 008-11
--------------

ALTER TABLE  PREFIXEstage_contrerendu ADD `identreprise`  INT NOT NULL;
* INSERT INTO PREFIXEpatch (idpatch,date,heure,info) VALUES ('008-10', '2010-02-04', '00:00:00', 'Installation support');


Patch 008-10
--------------

ALTER TABLE  PREFIXEstage_contrerendu ADD `idstage` INT NOT NULL;


Patch 008-09
--------------


ALTER TABLE  PREFIXEcantine_menu ADD `platdefault` TINYINT NOT NULL DEFAULT '0';

Patch 008-08
--------------

ALTER TABLE PREFIXEpersonnel ADD `indice_salaire` INT NOT NULL;
ALTER TABLE PREFIXEcantine_menu ADD `indice_salaire` INT NOT NULL DEFAULT '0';

Patch 008-07
--------------

CREATE TABLE PREFIXEcantine_compte (`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,`idpers` INT NOT NULL ,`membre` VARCHAR(30) NOT NULL ,`date` DATE NOT NULL ,`prix` DECIMAL(10, 5) NOT NULL,`plateau` VARCHAR(250) NOT NULL )TYPE=TYPETABLE;
CREATE TABLE PREFIXEcantine_menu (`id` INT NOT NULL   AUTO_INCREMENT,`libelle` VARCHAR(250) NOT NULL ,`prix` DECIMAL(50,5) NOT NULL ,`attribue` VARCHAR(50) NOT NULL ,PRIMARY KEY (id))TYPE=TYPETABLE;
CREATE TABLE PREFIXEdroitmodule (`idpers` INT NOT NULL ,`module` VARCHAR(50) NOT NULL ,`permission` TINYINT NOT NULL)TYPE=TYPETABLE;


* INSERT INTO PREFIXEpatch (idpatch,date,heure,info) VALUES ('008-05', '2009-12-27', '00:00:00', 'Installation support');



Patch 008-06
--------------

ALTER TABLE PREFIXEcodebar CHANGE `membre`  `membre`  VARCHAR(30)  NOT NULL;
ALTER TABLE PREFIXEeleves ADD compte_inactif  TINYINT NOT NULL DEFAULT '0';

Patch 008-05
------------

CREATE TABLE PREFIXEstage_contrerendu (`id` int(11) NOT NULL AUTO_INCREMENT ,`ideleve` int(11) NOT NULL ,`numStage` varchar(30) NOT NULL ,`dateVisite` date NOT NULL ,`heureVisite` time NOT NULL ,`idsociete` int(11) NOT NULL ,`contrerendu` text, `visiteur` VARCHAR(250) NOT NULL DEFAULT ' ', `datesaisie` DATE NOT NULL,  PRIMARY KEY (`id`) ,KEY `ideleve` (`ideleve`))TYPE=TYPETABLE;
CREATE TABLE PREFIXEcodebar (`id` VARCHAR( 100 ) NOT NULL ,`id_pers` INT NOT NULL ,`membre` VARCHAR(10) NOT NULL ,`valide` TINYINT NOT NULL DEFAULT '1', UNIQUE (`id`))TYPE=TYPETABLE;


Patch 008-04
------------
ALTER TABLE PREFIXEstage_eleve ADD id_prof_visite2 INT NOT NULL;
ALTER TABLE PREFIXEcirculaire ADD comptedirection TINYINT NOT NULL DEFAULT '1';



Patch 008-02
------------
ALTER TABLE PREFIXEstage_eleve ADD `horairedebutjournalier` TIME NOT NULL, ADD `horairefinjournalier` TIME NOT NULL, ADD `date_visite_prof2` DATE NOT NULL;
ALTER TABLE PREFIXEcirculaire ADD `comptepersonnel` TINYINT NOT NULL DEFAULT '0';
ALTER TABLE PREFIXEcirculaire ADD `compteviescolaire` TINYINT NOT NULL DEFAULT '0';

