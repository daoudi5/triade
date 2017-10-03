<?php
/*******************************************************
 **                  IntraMessenger - server          **
 **                                                   **
 **  Copyright:      (C) 2006 - 2009 THeUDS           **
 **  Web:            http://www.theuds.com            **
 **                  http://www.intramessenger.net    **
 **  Licence :       GPL (GNU Public License)         **
 **  http://opensource.org/licenses/gpl-license.php   **
 *******************************************************/

/*******************************************************
 **       This file is part of IntraMessenger-server  **
 **                                                   **
 **  IntraMessenger is a free software.               **
 **  IntraMessenger is distributed in the hope that   **
 **  it will be useful, but WITHOUT ANY WARRANTY.     **
 *******************************************************/


#
#  #  #  #  # # # #### --->>>> Renommer ce fichier config.FR.inc.php EN config.inc.php <<<<--- #### # # #  #  #  #  #
#


define("_LANG", "FR");
## Langue du serveur (FR ou EN ou PT ou IT or RO).


define("_MAINTENANCE_MODE", "X");
## Mode maintenance (pour effectuer mise � jour).


#
##
###################################### ADMIN OPTIONS ######################################
##
#

define("_MAX_NB_USER", "0");
## Nombre maximum d'utilisateurs ('0' : illimit�).

define("_MAX_NB_SESSION", "200");
## Nombre maximum de sessions (utilisateurs en ligne en m�me temps) (plus petit ou �gal � _MAX_NB_USER) ('0' : illimit�).

define("_MAX_NB_CONTACT_BY_USER", "40");
## Nombre maximum de contacts par utilisateurs ('0' : illimit�).

define("_MAX_NB_IP", "0");
## Nombre maxi d'adresses IP simultan�es (0 : illimit�).

define("_DISPLAY_USER_FLAG_COUNTRY", "");
## affichage du drapeau de l'adresse IP (utilisation sur internet) dans la liste des sessions 
##     (voir /admin/geoip/index.html pour les mises � jour mensuelles).

define("_OUTOFDATE_AFTER_X_DAYS_NOT_USE", "90");
## Supprimer (depuis la liste des utilisateurs, par l'admin) les utilisateurs inactifs depuis plus de X jours ('0' : illimit�).

define("_CHECK_NEW_MSG_EVERY", "20");
## Les postes clients v�rifient toutes les ... (10 � 60) secondes l'arriv�e de nouveaux messages (provenant de n'importe qui).
## En discussion, la v�rification se fait toutes les 3 secondes.

define("_FULL_CHECK", "X");
## Toutes les _CHECK_NEW_MSG_EVERY secondes, v�rifie si des contact sont en attente, des "messages priv�s" depuis un forum (si authentification externe)...
## Si vide, ne v�rifie que toutes les 3 minutes.

define("_STATISTICS", "X");
## Pour compter/afficher les statistiques (dans l'interface d'admin).

define("_PUBLIC_FOLDER", "public");
## Dossier visible par les utilisateurs (� renommer et indiquer ici).

define("_PUBLIC_OPTIONS_LIST" , "X");
## La liste des principales options est consultable par tous.

define("_PUBLIC_USERS_LIST" , "X");
## La liste des utilisateurs inscrits (et valid�s) est consultable par tous.

define("_PUBLIC_POST_AVATAR" , "X");
## Tout le monde peut proposer des avatars.


#
##
######################################## OPTIONS DE RESTRICTIONS UTILISATEURS ######################################################
##
#


define("_FORCE_USERNAME_TO_PC_SESSION_NAME", "");
## si non vide, le login est forc� au "nom d'utilisateur" de la session Windows ouverte (%USERNAME%) (pratique en LDAP), sinon, l'utilisateur peut choisir son pseudo.

define("_ALLOW_CONFERENCE", "X");
## si non vide, autorise les utilisateurs � se cr�er des conf�rences � plusieurs.

define("_ALLOW_INVISIBLE", "X");
## si non vide, autorise � �tre invisible (cach� si en ligne) (voir VIP). 
##     (ralentit l�g�rement l'affichage (requete sql) de la liste des contacts en ligne).

define("_ALLOW_SMILEYS", "X");
## autorise l'envoi de smileys (�moticones) qui seront affich�s en images.

define("_ALLOW_CHANGE_CONTACT_NICKNAME", "X");
## si non vide, autorise � renommer le pseudo d'un contact (dans sa liste).

define("_ALLOW_CHANGE_EMAIL_PHONE", "X");
##  si non vide, autorise � changer son num�ro de t�l�phone ainsi que son adresse email.

define("_ALLOW_CHANGE_FUNCTION_NAME", "X");
##  si non vide, autorise � changer son nom/fonction (affich� apr�s le login/pseudo).

define("_ALLOW_CHANGE_AVATAR", "X");
##  si non vide, autorise � changer son avatar (photo).

define("_ALLOW_SEND_TO_OFFLINE_USER", "X");
## si non vide, autorise � envoyer des messages � des contacts hors ligne (non connect�s).

define("_ALLOW_USER_TO_HISTORY_MESSAGES", "X");
## Emp�che l'utilisateur d'archiver les messages �chang�s.

define("_ALLOW_USE_PROXY", "X");
## si non vide, autorise l'utilisation de serveur proxy.

define("_ALLOW_USER_RATING", "");
## si non vide, autorise les utilisateurs � noter leurs contacts (mais pas de consulter la moyenne).
## Si "PUBLIC" les utilisateurs peuvent voir les moyennes (notes) de leurs contacts.

define("_ALLOW_EMAIL_NOTIFIER", "X");
## si non vide, autorise l'utilisation du notifieur d'email int�gr�.

define("_INCOMING_EMAIL_SERVER_ADDRESS", "");
## Force l'adresse du serveur de courrier entrant (pour le notifieur).

define("_FORCE_AWAY_ON_SCREENSAVER", "X");
## si non vide,  force l'�tat 'absent' lorsque l'�conomiseur d'�cran est actif (force  et masque l'option 'Absent si disponible' sur les postes clients).

define("_HIDE_COL_FUNCTION_NAME", "");
## si non vide,  masque la colonne 'nom/fonction' (service).

define("_USER_HIEARCHIC_MANAGEMENT_BY_ADMIN", "");
## si non vide,  affiche la colonne 'niveau', et active la gestion hi�archique des utilisateurs.

define("_LOCK_USER_CONTACT_LIST", "");
## si non vide, interdit la modification des contacts (seul l'admin peut le faire) et les r�glages de l'alarme (pour les �coles, cyber-caf�s...).

define("_LOCK_USER_OPTIONS", "");
## si non vide, interdit l'acc�s � l'�cran des options et celui de r�glage de l'alarme (pour les �coles, cyber-caf�s...).

define("_FORCE_STATUS_LIST_FROM_SERVER", "");
## si non vide, force (envoi) la liste des status (Absent, occup�...) depuis le serveur (suivant la langue configur�e).

define("_AWAY_REASONS_LIST", ""); // exemple : "Au t�l�phone;R�union;Pas devant l'�cran;De retour dans 5 minutes;Repas"
## Liste des raisons d'absence pour l'�tat "absent".


#
##
######################################## OPTIONS DE SECURITE ######################################################
##
#


define("_MINIMUM_USERNAME_LENGTH", "4");
## Taille minimum du pseudo    >= 3

define("_USER_NEED_PASSWORD", "X");
## si non vide, mot de passe n�cessaire (obligatoire) pour chaque utilisateur (� activer surtout si l'utilisateur peut choisir son pseudo !  donc peut utile si _FORCE_USERNAME_TO_PC_SESSION_NAME).

define("_MINIMUM_PASSWORD_LENGTH", "4");
## Taille minimum du mot de passe des utilisateurs (si _USER_NEED_PASSWORD non vide), sup�rieur ou �gal � 4.

define("_MAX_PASSWORD_ERRORS_BEFORE_LOCK_USER", "5");
## Maximum d'erreurs cons�cutives du mot de passe avant verrouillage du compte utilisateur (de 2 � 20).

define("_ALLOW_AUTO_ADD_NEW_USER_ON_SERVER", "X");
## si non vide, tous les nouveaux utilisateurs sont automatiquement ajout�s dans la liste.

define("_PENDING_NEW_AUTO_ADDED_USER", "");
## si non vide,  les utilisateurs automatiquement ajout�s sont � valider par l'admin (vider 'WAIT' dans la colonne 'USR_CHECK' de la table 'T_USR_USER').

define("_PENDING_USER_ON_COMPUTER_CHANGE", "");
## si non vide,  les utilisateurs qui changent de PC sont � valider par l'admin (vider 'USR_CHECK' de la table 'T_USR_USER').

define("_CRYPT_MESSAGES", "");
## si non vide, crypter les messages.

define("_LOG_MESSAGES", "");
## si non vide, les messages sont sauvegard�s/archiv�s dans un fichier sur le serveur  (/distant/log/log_messages.txt).
##     (ex: pour v�rifier l'usage des �l�ves) (_CRYPT_MESSAGES ne doit pas �tre actif).

define("_LOG_SESSION_OPEN", "");
## si non vide,  �crit dans un journal (log) les ouvertures de sessions. N�cessite droits �critures sur /distant/log/log_open_session.txt !!!

define("_PASSWORD_FOR_PRIVATE_SERVER", "");
## si non vide, contient le mot de passe pour que les clients s'authentifient au serveur. Si vide, le serveur est publique.
## Utilisez un long mot de passe pour s�curiser les transmissions (doit faire plus de 5 caracters !).

define("_FORCE_UPDATE_BY_SERVER", "");
## Force les mises � jour des postes clients depuis le serveur uniquement.
## L'utilisateur ne peut pas d�sactiver, ni choisir 'par internet' (t�l�chargement depuis le site officiel).

define("_FORCE_UPDATE_BY_INTERNET", "");
## Force les mises � jour des postes clients depuis le serveur internet officiel.
## L'utilisateur ne peut pas d�sactiver, ni choisir 'par le serveur'.

define("_SEND_ADMIN_ALERT", "X");
## si non vide, envoi aux 'administrateurs' les alertes (ceux qui ont la case coch�e "Re�oit les messages d'alerte").
## Exemple : utilisateur en attente de validation (verrouill� erreurs de mot de passe), les avatars en attente...

define("_PROXY_ADDRESS", "");
## D�fini/force l'adresse du serveur proxy

define("_PROXY_PORT_NUMBER", "");
## D�fini/force le num�ro de port du serveur proxy


#
##
###################################### ADMIN OPTIONS ######################################
##
#


define("_SITE_URL_TO_SHOW", "");
## (pour internet) Si vous souhaitez afficher l'adresse de votre site internet (pas l'url d'intramessenger ! ex: http://www.instanttimezone.com).

define("_SITE_TITLE_TO_SHOW", "");
## Si vous souhaitez afficher un titre (publicit�) pour votre serveur internet.

define("_SCROLL_TEXT", "");
## Texte d'information d�filant.

define("_ADMIN_EMAIL", "");
## Adresse email de l'administrateur (pour afficher dans l'�cran "A propos" des utilisateurs).

define("_ADMIN_PHONE", "");
## Num�ro de t�l�phone de l'administrateur (pour afficher dans l'�cran "A propos" des utilisateurs).

define("_ENTERPRISE_SERVER", "");
## Mode entreprise : remont� versions des logiciels install�, et possibilit� d'arr�t/red�marrage des PC � distance

define("_IM_ADDRESS_BOOK_PASSWORD", "");
## Mot de passe � fournir lors de l'inscription sur l'annuaire des serveurs internet (sans espace !) :
##
##            http://www.intramessenger.net/list/servers/

define("_GROUP_FOR_ADMIN_MESSAGES", "");
## Permet la gestion des groupes, uniquement pour envoyer des messages administrateurs (� utiliser seulement si _SPECIAL_MODE_GROUP_COMMUNITY est vide).


#
##
###################################### SPECIALS OPTIONS ######################################
##
#


#  Si vous voulez un mode sp�cial, vous pouvez activer une (SEULEMENT) de ces 2 options :

define("_SPECIAL_MODE_OPEN_COMMUNITY", "");
## tout le monde voit tout le monde, sans s'ajouter � la liste des contacts (ex: �coles, cyber caf�...). 
##     Ajouter aux contacts ceux � masquer. Activez _ALLOW_INVISIBLE, 
##     et d�sactivez : _ALLOW_SEND_TO_OFFLINE_USER, _ALLOW_CHANGE_CONTACT_NICKNAME et _USER_HIEARCHIC_MANAGEMENT_BY_ADMIN).

define("_SPECIAL_MODE_GROUP_COMMUNITY", "");
## tout le monde peut voir les personnes de son (ses m�mes) groupe(s), sans les avoir dans ses contacts.
##     La liste des contacts est d�sactiv�e ainsi que les options associ�es : _LOCK_USER_CONTACT_LIST 
##     _ALLOW_CHANGE_CONTACT_NICKNAME  _ALLOW_SEND_TO_OFFLINE_USER  _MAX_NB_CONTACT_BY_USER  _ALLOW_INVISIBLE
##     et d�sactive l'option : _USER_HIEARCHIC_MANAGEMENT_BY_ADMIN


#
##
############################### AUTHENTIFICATION OPTIONS #####################################
##
#

define('_EXTERNAL_AUTHENTICATION', ''); 

define("_EXTERN_URL_TO_REGISTER", "");
## Adresse pour s'incrire (phpBB, VBulletin, Joomla, Phenix Agenda, Dolibarr, dotProject, eGroupWare, Ovidentia...).

define("_EXTERN_URL_FORGET_PASSWORD", "");
## Adresse pour r�cup�rer son mot de passe (via l'authentification externe)

define("_EXTERN_URL_CHANGE_PASSWORD", "");
## Adresse pour changer son mot de passe (via l'authentification externe) : remplace le bouton dans le profil (client).



#
##############################################################################################
#

define("_STOP_USE_THIS_SERVER_ADDRESS_NOW_USE_THIS_URL", "");
## SEULEMENT pour rediriger les utilisateurs vers une nouvelle URL (adresse de serveur) !!!

?>
