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
## Mode maintenance (pour effectuer mise à jour).


#
##
###################################### ADMIN OPTIONS ######################################
##
#

define("_MAX_NB_USER", "0");
## Nombre maximum d'utilisateurs ('0' : illimité).

define("_MAX_NB_SESSION", "200");
## Nombre maximum de sessions (utilisateurs en ligne en même temps) (plus petit ou égal à _MAX_NB_USER) ('0' : illimité).

define("_MAX_NB_CONTACT_BY_USER", "40");
## Nombre maximum de contacts par utilisateurs ('0' : illimité).

define("_MAX_NB_IP", "0");
## Nombre maxi d'adresses IP simultanées (0 : illimité).

define("_DISPLAY_USER_FLAG_COUNTRY", "");
## affichage du drapeau de l'adresse IP (utilisation sur internet) dans la liste des sessions 
##     (voir /admin/geoip/index.html pour les mises à jour mensuelles).

define("_OUTOFDATE_AFTER_X_DAYS_NOT_USE", "90");
## Supprimer (depuis la liste des utilisateurs, par l'admin) les utilisateurs inactifs depuis plus de X jours ('0' : illimité).

define("_CHECK_NEW_MSG_EVERY", "20");
## Les postes clients vérifient toutes les ... (10 à 60) secondes l'arrivée de nouveaux messages (provenant de n'importe qui).
## En discussion, la vérification se fait toutes les 3 secondes.

define("_FULL_CHECK", "X");
## Toutes les _CHECK_NEW_MSG_EVERY secondes, vérifie si des contact sont en attente, des "messages privés" depuis un forum (si authentification externe)...
## Si vide, ne vérifie que toutes les 3 minutes.

define("_STATISTICS", "X");
## Pour compter/afficher les statistiques (dans l'interface d'admin).

define("_PUBLIC_FOLDER", "public");
## Dossier visible par les utilisateurs (à renommer et indiquer ici).

define("_PUBLIC_OPTIONS_LIST" , "X");
## La liste des principales options est consultable par tous.

define("_PUBLIC_USERS_LIST" , "X");
## La liste des utilisateurs inscrits (et validés) est consultable par tous.

define("_PUBLIC_POST_AVATAR" , "X");
## Tout le monde peut proposer des avatars.


#
##
######################################## OPTIONS DE RESTRICTIONS UTILISATEURS ######################################################
##
#


define("_FORCE_USERNAME_TO_PC_SESSION_NAME", "");
## si non vide, le login est forcé au "nom d'utilisateur" de la session Windows ouverte (%USERNAME%) (pratique en LDAP), sinon, l'utilisateur peut choisir son pseudo.

define("_ALLOW_CONFERENCE", "X");
## si non vide, autorise les utilisateurs à se créer des conférences à plusieurs.

define("_ALLOW_INVISIBLE", "X");
## si non vide, autorise à être invisible (caché si en ligne) (voir VIP). 
##     (ralentit légèrement l'affichage (requete sql) de la liste des contacts en ligne).

define("_ALLOW_SMILEYS", "X");
## autorise l'envoi de smileys (émoticones) qui seront affichés en images.

define("_ALLOW_CHANGE_CONTACT_NICKNAME", "X");
## si non vide, autorise à renommer le pseudo d'un contact (dans sa liste).

define("_ALLOW_CHANGE_EMAIL_PHONE", "X");
##  si non vide, autorise à changer son numéro de téléphone ainsi que son adresse email.

define("_ALLOW_CHANGE_FUNCTION_NAME", "X");
##  si non vide, autorise à changer son nom/fonction (affiché après le login/pseudo).

define("_ALLOW_CHANGE_AVATAR", "X");
##  si non vide, autorise à changer son avatar (photo).

define("_ALLOW_SEND_TO_OFFLINE_USER", "X");
## si non vide, autorise à envoyer des messages à des contacts hors ligne (non connectés).

define("_ALLOW_USER_TO_HISTORY_MESSAGES", "X");
## Empêche l'utilisateur d'archiver les messages échangés.

define("_ALLOW_USE_PROXY", "X");
## si non vide, autorise l'utilisation de serveur proxy.

define("_ALLOW_USER_RATING", "");
## si non vide, autorise les utilisateurs à noter leurs contacts (mais pas de consulter la moyenne).
## Si "PUBLIC" les utilisateurs peuvent voir les moyennes (notes) de leurs contacts.

define("_ALLOW_EMAIL_NOTIFIER", "X");
## si non vide, autorise l'utilisation du notifieur d'email intégré.

define("_INCOMING_EMAIL_SERVER_ADDRESS", "");
## Force l'adresse du serveur de courrier entrant (pour le notifieur).

define("_FORCE_AWAY_ON_SCREENSAVER", "X");
## si non vide,  force l'état 'absent' lorsque l'économiseur d'écran est actif (force  et masque l'option 'Absent si disponible' sur les postes clients).

define("_HIDE_COL_FUNCTION_NAME", "");
## si non vide,  masque la colonne 'nom/fonction' (service).

define("_USER_HIEARCHIC_MANAGEMENT_BY_ADMIN", "");
## si non vide,  affiche la colonne 'niveau', et active la gestion hiéarchique des utilisateurs.

define("_LOCK_USER_CONTACT_LIST", "");
## si non vide, interdit la modification des contacts (seul l'admin peut le faire) et les réglages de l'alarme (pour les écoles, cyber-cafés...).

define("_LOCK_USER_OPTIONS", "");
## si non vide, interdit l'accès à l'écran des options et celui de réglage de l'alarme (pour les écoles, cyber-cafés...).

define("_FORCE_STATUS_LIST_FROM_SERVER", "");
## si non vide, force (envoi) la liste des status (Absent, occupé...) depuis le serveur (suivant la langue configurée).

define("_AWAY_REASONS_LIST", ""); // exemple : "Au téléphone;Réunion;Pas devant l'écran;De retour dans 5 minutes;Repas"
## Liste des raisons d'absence pour l'état "absent".


#
##
######################################## OPTIONS DE SECURITE ######################################################
##
#


define("_MINIMUM_USERNAME_LENGTH", "4");
## Taille minimum du pseudo    >= 3

define("_USER_NEED_PASSWORD", "X");
## si non vide, mot de passe nécessaire (obligatoire) pour chaque utilisateur (à activer surtout si l'utilisateur peut choisir son pseudo !  donc peut utile si _FORCE_USERNAME_TO_PC_SESSION_NAME).

define("_MINIMUM_PASSWORD_LENGTH", "4");
## Taille minimum du mot de passe des utilisateurs (si _USER_NEED_PASSWORD non vide), supérieur ou égal à 4.

define("_MAX_PASSWORD_ERRORS_BEFORE_LOCK_USER", "5");
## Maximum d'erreurs consécutives du mot de passe avant verrouillage du compte utilisateur (de 2 à 20).

define("_ALLOW_AUTO_ADD_NEW_USER_ON_SERVER", "X");
## si non vide, tous les nouveaux utilisateurs sont automatiquement ajoutés dans la liste.

define("_PENDING_NEW_AUTO_ADDED_USER", "");
## si non vide,  les utilisateurs automatiquement ajoutés sont à valider par l'admin (vider 'WAIT' dans la colonne 'USR_CHECK' de la table 'T_USR_USER').

define("_PENDING_USER_ON_COMPUTER_CHANGE", "");
## si non vide,  les utilisateurs qui changent de PC sont à valider par l'admin (vider 'USR_CHECK' de la table 'T_USR_USER').

define("_CRYPT_MESSAGES", "");
## si non vide, crypter les messages.

define("_LOG_MESSAGES", "");
## si non vide, les messages sont sauvegardés/archivés dans un fichier sur le serveur  (/distant/log/log_messages.txt).
##     (ex: pour vérifier l'usage des élèves) (_CRYPT_MESSAGES ne doit pas être actif).

define("_LOG_SESSION_OPEN", "");
## si non vide,  écrit dans un journal (log) les ouvertures de sessions. Nécessite droits écritures sur /distant/log/log_open_session.txt !!!

define("_PASSWORD_FOR_PRIVATE_SERVER", "");
## si non vide, contient le mot de passe pour que les clients s'authentifient au serveur. Si vide, le serveur est publique.
## Utilisez un long mot de passe pour sécuriser les transmissions (doit faire plus de 5 caracters !).

define("_FORCE_UPDATE_BY_SERVER", "");
## Force les mises à jour des postes clients depuis le serveur uniquement.
## L'utilisateur ne peut pas désactiver, ni choisir 'par internet' (téléchargement depuis le site officiel).

define("_FORCE_UPDATE_BY_INTERNET", "");
## Force les mises à jour des postes clients depuis le serveur internet officiel.
## L'utilisateur ne peut pas désactiver, ni choisir 'par le serveur'.

define("_SEND_ADMIN_ALERT", "X");
## si non vide, envoi aux 'administrateurs' les alertes (ceux qui ont la case cochée "Reçoit les messages d'alerte").
## Exemple : utilisateur en attente de validation (verrouillé erreurs de mot de passe), les avatars en attente...

define("_PROXY_ADDRESS", "");
## Défini/force l'adresse du serveur proxy

define("_PROXY_PORT_NUMBER", "");
## Défini/force le numéro de port du serveur proxy


#
##
###################################### ADMIN OPTIONS ######################################
##
#


define("_SITE_URL_TO_SHOW", "");
## (pour internet) Si vous souhaitez afficher l'adresse de votre site internet (pas l'url d'intramessenger ! ex: http://www.instanttimezone.com).

define("_SITE_TITLE_TO_SHOW", "");
## Si vous souhaitez afficher un titre (publicité) pour votre serveur internet.

define("_SCROLL_TEXT", "");
## Texte d'information défilant.

define("_ADMIN_EMAIL", "");
## Adresse email de l'administrateur (pour afficher dans l'écran "A propos" des utilisateurs).

define("_ADMIN_PHONE", "");
## Numéro de téléphone de l'administrateur (pour afficher dans l'écran "A propos" des utilisateurs).

define("_ENTERPRISE_SERVER", "");
## Mode entreprise : remonté versions des logiciels installé, et possibilité d'arrêt/redémarrage des PC à distance

define("_IM_ADDRESS_BOOK_PASSWORD", "");
## Mot de passe à fournir lors de l'inscription sur l'annuaire des serveurs internet (sans espace !) :
##
##            http://www.intramessenger.net/list/servers/

define("_GROUP_FOR_ADMIN_MESSAGES", "");
## Permet la gestion des groupes, uniquement pour envoyer des messages administrateurs (à utiliser seulement si _SPECIAL_MODE_GROUP_COMMUNITY est vide).


#
##
###################################### SPECIALS OPTIONS ######################################
##
#


#  Si vous voulez un mode spécial, vous pouvez activer une (SEULEMENT) de ces 2 options :

define("_SPECIAL_MODE_OPEN_COMMUNITY", "");
## tout le monde voit tout le monde, sans s'ajouter à la liste des contacts (ex: écoles, cyber café...). 
##     Ajouter aux contacts ceux à masquer. Activez _ALLOW_INVISIBLE, 
##     et désactivez : _ALLOW_SEND_TO_OFFLINE_USER, _ALLOW_CHANGE_CONTACT_NICKNAME et _USER_HIEARCHIC_MANAGEMENT_BY_ADMIN).

define("_SPECIAL_MODE_GROUP_COMMUNITY", "");
## tout le monde peut voir les personnes de son (ses mêmes) groupe(s), sans les avoir dans ses contacts.
##     La liste des contacts est désactivée ainsi que les options associées : _LOCK_USER_CONTACT_LIST 
##     _ALLOW_CHANGE_CONTACT_NICKNAME  _ALLOW_SEND_TO_OFFLINE_USER  _MAX_NB_CONTACT_BY_USER  _ALLOW_INVISIBLE
##     et désactive l'option : _USER_HIEARCHIC_MANAGEMENT_BY_ADMIN


#
##
############################### AUTHENTIFICATION OPTIONS #####################################
##
#

define('_EXTERNAL_AUTHENTICATION', ''); 

define("_EXTERN_URL_TO_REGISTER", "");
## Adresse pour s'incrire (phpBB, VBulletin, Joomla, Phenix Agenda, Dolibarr, dotProject, eGroupWare, Ovidentia...).

define("_EXTERN_URL_FORGET_PASSWORD", "");
## Adresse pour récupérer son mot de passe (via l'authentification externe)

define("_EXTERN_URL_CHANGE_PASSWORD", "");
## Adresse pour changer son mot de passe (via l'authentification externe) : remplace le bouton dans le profil (client).



#
##############################################################################################
#

define("_STOP_USE_THIS_SERVER_ADDRESS_NOW_USE_THIS_URL", "");
## SEULEMENT pour rediriger les utilisateurs vers une nouvelle URL (adresse de serveur) !!!

?>
