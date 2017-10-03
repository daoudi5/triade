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

define('_LANG', 'FR'); 
## EN / FR / IT / PT / RO 

if (file_exists("../../common/config-messenger.php")) {
        define("_MAINTENANCE_MODE", "");
}else{
        define("_MAINTENANCE_MODE", "X");
}

include_once("../../common/config2.inc.php");

## To apply updates (pour effectuer les mises à jour).

# 
## 
###################################### ADMIN OPTIONS ###################################### 
## 
# 
 
define('_MAX_NB_USER', '0'); 
define('_MAX_NB_SESSION', '200'); 
define('_MAX_NB_CONTACT_BY_USER', '0'); 
define('_MAX_NB_IP', '0'); 
define('_DISPLAY_USER_FLAG_COUNTRY', ''); 
define('_OUTOFDATE_AFTER_X_DAYS_NOT_USE', '90'); 
define('_CHECK_NEW_MSG_EVERY', '60'); 
define('_FULL_CHECK', ''); 
define('_STATISTICS', 'X'); 
define('_PUBLIC_FOLDER', 'public'); 
define('_PUBLIC_OPTIONS_LIST', ''); 
define('_PUBLIC_USERS_LIST', ''); 
define('_PUBLIC_POST_AVATAR', ''); 

# 
## 
###################################### USERS RESTRICTIONS OPTIONS ###################################### 
## 
# 
 
define('_ALLOW_CONFERENCE', 'X'); 
define('_ALLOW_INVISIBLE', 'X'); 
define('_ALLOW_SMILEYS', 'X'); 
define('_ALLOW_CHANGE_CONTACT_NICKNAME', ''); 
define('_ALLOW_CHANGE_EMAIL_PHONE', ''); 
define('_ALLOW_CHANGE_FUNCTION_NAME', ''); 
define('_ALLOW_CHANGE_AVATAR', ''); 
define('_ALLOW_SEND_TO_OFFLINE_USER', 'X'); 
define('_ALLOW_USER_TO_HISTORY_MESSAGES', ''); 
define('_ALLOW_USE_PROXY', 'X'); 
define('_ALLOW_USER_RATING', ''); 
## If not empty, allow user to rate their contacts (but cannot see average).
## If 'PUBLIC', users can see their contacts average.
define('_ALLOW_EMAIL_NOTIFIER', ''); 
define('_INCOMING_EMAIL_SERVER_ADDRESS', ''); 
define('_FORCE_AWAY_ON_SCREENSAVER', 'X'); 
define('_HIDE_COL_FUNCTION_NAME', ''); 
define('_LOCK_USER_CONTACT_LIST', 'X'); 
define('_LOCK_USER_OPTIONS', 'X'); 
define('_FORCE_STATUS_LIST_FROM_SERVER', ''); 
define('_AWAY_REASONS_LIST', ''); 
## // example : 'On phone;Meeting;Not in front of screen;Back in 5 minutes;Eating' 

# 
## 
###################################### SECURITY OPTIONS ###################################### 
## 
# 
 
define('_MINIMUM_USERNAME_LENGTH', '4'); 
define('_USER_NEED_PASSWORD', 'X'); 
define('_MINIMUM_PASSWORD_LENGTH', '4'); 
define('_MAX_PASSWORD_ERRORS_BEFORE_LOCK_USER', '10'); 
define('_PENDING_USER_ON_COMPUTER_CHANGE', ''); 
define('_CRYPT_MESSAGES', ''); 
define('_LOG_MESSAGES', 'X'); 
define('_LOG_SESSION_OPEN', 'X'); 
define('_PASSWORD_FOR_PRIVATE_SERVER', ''); 
## Use a long password, to improve security transfert (must be more them 5 characters !).
define('_FORCE_UPDATE_BY_SERVER', 'X'); 
define('_FORCE_UPDATE_BY_INTERNET', ''); 
define('_SEND_ADMIN_ALERT', 'X'); 
define('_PROXY_ADDRESS', ''); 
define('_PROXY_PORT_NUMBER', ''); 

# 
## 
###################################### ADMIN OPTIONS ###################################### 
## 
# 
 
define('_SITE_URL_TO_SHOW', 'http://www.triade-educ.com'); 
define('_SITE_TITLE_TO_SHOW', 'TRIADE'); 
define('_SCROLL_TEXT', ''); 
## Only a temp message/text.
$mailadmin=MAILADMIN;
define('_ADMIN_EMAIL', "$mailadmin"); 
define('_ADMIN_PHONE', ''); 
define('_GROUP_FOR_ADMIN_MESSAGES', ''); 
define('_IM_ADDRESS_BOOK_PASSWORD', ''); 

# 
## 
###################################### SPECIALS OPTIONS ###################################### 
## 
# 
 
define('_SPECIAL_MODE_OPEN_COMMUNITY', 'X'); 
define('_SPECIAL_MODE_GROUP_COMMUNITY', ''); 
define('_ENTERPRISE_SERVER', ''); 
define('_FORCE_USERNAME_TO_PC_SESSION_NAME', ''); 
define('_ALLOW_AUTO_ADD_NEW_USER_ON_SERVER', 'X'); 
define('_PENDING_NEW_AUTO_ADDED_USER', ''); 
define('_USER_HIEARCHIC_MANAGEMENT_BY_ADMIN', ''); 

# 
## 
###################################### AUTHENTICATION OPTIONS ###################################### 
## 
# 

$urlsite="http://".URLSITE;
define("_EXTERN_URL_TO_REGISTER", "$urlsite");
## Address to register (phpBB, VBulletin, Joomla, Phenix Agenda, Dolibarr, dotProject, eGroupWare, Ovidentia...).
$urlsite="http://".URLSITE."/probleme_acces.php";
define("_EXTERN_URL_FORGET_PASSWORD", "$urlsite");
define('_EXTERN_URL_CHANGE_PASSWORD', ''); 

# 
## 
###################################### EXTERN AUTHENTICATION OPTIONS ###################################### 
## 
# 
 
define('_AUTHENTICATION_ON_ACHIEVO',          ''); 
define('_AUTHENTICATION_ON_ACTIVECOLLAB',     ''); 
define('_AUTHENTICATION_ON_AEF',              ''); 
define('_AUTHENTICATION_ON_AGORAPROJECT',     ''); 
define('_AUTHENTICATION_ON_BITWEAVER',        ''); 
define('_AUTHENTICATION_ON_CLAROLINE',        ''); 
define('_AUTHENTICATION_ON_CMSMADESIMPLE',    ''); 
define('_AUTHENTICATION_ON_COLLABTIVE',       ''); 
define('_AUTHENTICATION_ON_CONCRETE5',        ''); 
define('_AUTHENTICATION_ON_CONNECTIXBOARDS',  ''); 
define('_AUTHENTICATION_ON_CUTEFLOW',         ''); 
define('_AUTHENTICATION_ON_DOKEOS',           ''); 
define('_AUTHENTICATION_ON_DOLIBARR',         ''); 
define('_AUTHENTICATION_ON_DOTCLEAR_1',       ''); 
define('_AUTHENTICATION_ON_DOTCLEAR_2',       ''); 
define('_AUTHENTICATION_ON_DOTPROJECT',       ''); 
define('_AUTHENTICATION_ON_DRUPAL',           ''); 
define('_AUTHENTICATION_ON_E107',             ''); 
define('_AUTHENTICATION_ON_EGROUPWARE',       ''); 
define('_AUTHENTICATION_ON_ELGG',             ''); 
define('_AUTHENTICATION_ON_EZPUBLISH',        ''); 
define('_AUTHENTICATION_ON_FLUXBB',           ''); 
define('_AUTHENTICATION_ON_FUDFORUM',         ''); 
define('_AUTHENTICATION_ON_GEPI',             ''); 
define('_AUTHENTICATION_ON_GROUPOFFICE',      ''); 
define('_AUTHENTICATION_ON_IMPRESSCMS',       ''); 
define('_AUTHENTICATION_ON_IPBOARD',          ''); 
define('_AUTHENTICATION_ON_ISSUEMANAGER',     ''); 
define('_AUTHENTICATION_ON_JOOMLA',           ''); 
define('_AUTHENTICATION_ON_MALLEO',           ''); 
define('_AUTHENTICATION_ON_MAMBO',            ''); 
define('_AUTHENTICATION_ON_MINIBB',           ''); 
define('_AUTHENTICATION_ON_MODX',             ''); 
define('_AUTHENTICATION_ON_MOODLE',           ''); 
define('_AUTHENTICATION_ON_MYBB',             ''); 
define('_AUTHENTICATION_ON_NUCLEUS',          ''); 
define('_AUTHENTICATION_ON_OBM',              ''); 
define('_AUTHENTICATION_ON_OPENGOO',          ''); 
define('_AUTHENTICATION_ON_OVIDENTIA',        ''); 
define('_AUTHENTICATION_ON_OWL',              ''); 
define('_AUTHENTICATION_ON_PHENIX',           ''); 
define('_AUTHENTICATION_ON_PHORUM',           ''); 
define('_AUTHENTICATION_ON_PHPBB_2',          ''); 
define('_AUTHENTICATION_ON_PHPBB_3',          ''); 
define('_AUTHENTICATION_ON_PHPBMS',           ''); 
define('_AUTHENTICATION_ON_PHPBOOST',         ''); 
define('_AUTHENTICATION_ON_PHPCOLLAB',        ''); 
define('_AUTHENTICATION_ON_PHPFUSION',        ''); 
define('_AUTHENTICATION_ON_PHPGROUPWARE',     ''); 
define('_AUTHENTICATION_ON_PHPIZABI',         ''); 
define('_AUTHENTICATION_ON_PHPNUKE',          ''); 
define('_AUTHENTICATION_ON_PHPROJECKT',       ''); 
define('_AUTHENTICATION_ON_PLIGG',            ''); 
define('_AUTHENTICATION_ON_PMS',              ''); 
define('_AUTHENTICATION_ON_PROJECTPIER',      ''); 
define('_AUTHENTICATION_ON_PROMETHEE',        ''); 
define('_AUTHENTICATION_ON_PUNBB',            ''); 
define('_AUTHENTICATION_ON_SMF',              ''); 
define('_AUTHENTICATION_ON_STREBER',          ''); 
define('_AUTHENTICATION_ON_SUGARCRM',         ''); 
define('_AUTHENTICATION_ON_TASKFREAK',        ''); 
define('_AUTHENTICATION_ON_TEXTCUBE',         ''); 
define('_AUTHENTICATION_ON_TIKIWIKI',         ''); 
define('_AUTHENTICATION_ON_TOUTATEAM',        ''); 
define('_AUTHENTICATION_ON_TRELLISDESK',      ''); 
define('_AUTHENTICATION_ON_TRIADE',           'X'); 
define('_AUTHENTICATION_ON_TYPO3',            ''); 
define('_AUTHENTICATION_ON_TYPOLIGHT',        ''); 
define('_AUTHENTICATION_ON_UCENTER',          ''); 
define('_AUTHENTICATION_ON_VBULLETIN',        ''); 
define('_AUTHENTICATION_ON_VCALENDAR',        ''); 
define('_AUTHENTICATION_ON_VTIGERCRM',        ''); 
define('_AUTHENTICATION_ON_WBBLITE',          ''); 
define('_AUTHENTICATION_ON_WEBCALENDAR',      ''); 
define('_AUTHENTICATION_ON_WEBCOLLAB',        ''); 
define('_AUTHENTICATION_ON_WORDPRESS',        ''); 
define('_AUTHENTICATION_ON_XMB',              ''); 
define('_AUTHENTICATION_ON_XOOPS',            ''); 
define('_AUTHENTICATION_ON_YACS',             ''); 

define('_STOP_USE_THIS_SERVER_ADDRESS_NOW_USE_THIS_URL', ''); 

?>
