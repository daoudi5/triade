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
//
require ("../common/display_errors.inc.php"); 
//
if (isset($_GET['lang'])) $lang = $_GET['lang']; else $lang = "";
//
define('INTRAMESSENGER',true);
require ("../common/styles/style.css.inc.php"); 
require ("../common/config/config.inc.php");
require ("lang.inc.php");
//
$c_missing = "Missing !";
//
//if (!defined("_AUTHENTICATION_ON_XXXXXXX"))       define("_AUTHENTICATION_ON_XXXXXX", $c_missing);
if (!defined("_AUTHENTICATION_ON_CLAROLINE"))       define("_AUTHENTICATION_ON_CLAROLINE", $c_missing);
if (!defined("_AUTHENTICATION_ON_CMSMADESIMPLE"))   define("_AUTHENTICATION_ON_CMSMADESIMPLE", $c_missing);
if (!defined("_AUTHENTICATION_ON_CONNECTIXBOARDS")) define("_AUTHENTICATION_ON_CONNECTIXBOARDS", $c_missing);
if (!defined("_AUTHENTICATION_ON_DOKEOS"))          define("_AUTHENTICATION_ON_DOKEOS", $c_missing);
if (!defined("_AUTHENTICATION_ON_E107"))            define("_AUTHENTICATION_ON_E107", $c_missing);
if (!defined("_AUTHENTICATION_ON_FLUXBB"))          define("_AUTHENTICATION_ON_FLUXBB", $c_missing);
if (!defined("_AUTHENTICATION_ON_GEPI"))            define("_AUTHENTICATION_ON_GEPI", $c_missing);
if (!defined("_AUTHENTICATION_ON_IMPRESSCMS"))      define("_AUTHENTICATION_ON_IMPRESSCMS", $c_missing);
if (!defined("_AUTHENTICATION_ON_MALLEO"))          define("_AUTHENTICATION_ON_MALLEO", $c_missing);
if (!defined("_AUTHENTICATION_ON_MOODLE"))          define("_AUTHENTICATION_ON_MOODLE", $c_missing);
if (!defined("_AUTHENTICATION_ON_PLIGG"))           define("_AUTHENTICATION_ON_PLIGG", $c_missing);
if (!defined("_AUTHENTICATION_ON_PMS"))             define("_AUTHENTICATION_ON_PMS", $c_missing);
if (!defined("_AUTHENTICATION_ON_PHPBMS"))          define("_AUTHENTICATION_ON_PHPBMS", $c_missing);
if (!defined("_AUTHENTICATION_ON_PHPIZABI"))        define("_AUTHENTICATION_ON_PHPIZABI", $c_missing);
if (!defined("_AUTHENTICATION_ON_PROMETHEE"))       define("_AUTHENTICATION_ON_PROMETHEE", $c_missing);
if (!defined("_AUTHENTICATION_ON_WBBLITE"))         define("_AUTHENTICATION_ON_WBBLITE", $c_missing);
if (!defined("_AUTHENTICATION_ON_XMB"))             define("_AUTHENTICATION_ON_XMB", $c_missing);
if (!defined("_AUTHENTICATION_ON_OBM"))             define("_AUTHENTICATION_ON_OBM", $c_missing);
if (!defined("_AUTHENTICATION_ON_PHPBOOST"))        define("_AUTHENTICATION_ON_PHPBOOST", $c_missing);
if (!defined("_AUTHENTICATION_ON_TRELLISDESK"))     define("_AUTHENTICATION_ON_TRELLISDESK", $c_missing);
if (!defined("_AUTHENTICATION_ON_OPENGOO"))         define("_AUTHENTICATION_ON_OPENGOO", $c_missing);
if (!defined("_AUTHENTICATION_ON_PHPCOLLAB"))       define("_AUTHENTICATION_ON_PHPCOLLAB", $c_missing);
if (!defined("_AUTHENTICATION_ON_TRIADE"))          define("_AUTHENTICATION_ON_TRIADE", $c_missing);
if (!defined("_AUTHENTICATION_ON_TYPOLIGHT"))       define("_AUTHENTICATION_ON_TYPOLIGHT", $c_missing);
if (!defined("_AUTHENTICATION_ON_YACS"))            define("_AUTHENTICATION_ON_YACS", $c_missing);
if (!defined("_AUTHENTICATION_ON_ELGG"))            define("_AUTHENTICATION_ON_ELGG", $c_missing);
if (!defined("_AUTHENTICATION_ON_EZPUBLISH"))       define("_AUTHENTICATION_ON_EZPUBLISH", $c_missing);
if (!defined("_AUTHENTICATION_ON_TEXTCUBE"))        define("_AUTHENTICATION_ON_TEXTCUBE", $c_missing);
if (!defined("_AUTHENTICATION_ON_ACTIVECOLLAB"))    define("_AUTHENTICATION_ON_ACTIVECOLLAB", $c_missing);
if (!defined("_AUTHENTICATION_ON_ISSUEMANAGER"))    define("_AUTHENTICATION_ON_ISSUEMANAGER", $c_missing);
if (!defined("_AUTHENTICATION_ON_WORDPRESS"))       define("_AUTHENTICATION_ON_WORDPRESS", $c_missing);
if (!defined("_AUTHENTICATION_ON_BITWEAVER"))       define("_AUTHENTICATION_ON_BITWEAVER", $c_missing);
if (!defined("_AUTHENTICATION_ON_PROJECTPIER"))     define("_AUTHENTICATION_ON_PROJECTPIER", $c_missing);
if (!defined("_AUTHENTICATION_ON_DOTCLEAR_2"))      define("_AUTHENTICATION_ON_DOTCLEAR_2", $c_missing);
if (!defined("_AUTHENTICATION_ON_DOTCLEAR_1"))      define("_AUTHENTICATION_ON_DOTCLEAR_1", $c_missing);
if (!defined("_AUTHENTICATION_ON_CONCRETE5"))       define("_AUTHENTICATION_ON_CONCRETE5", $c_missing);
if (!defined("_AUTHENTICATION_ON_CUTEFLOW"))        define("_AUTHENTICATION_ON_CUTEFLOW", $c_missing);
if (!defined("_AUTHENTICATION_ON_GROUPOFFICE"))     define("_AUTHENTICATION_ON_GROUPOFFICE", $c_missing);
if (!defined("_AUTHENTICATION_ON_COLLABTIVE"))      define("_AUTHENTICATION_ON_COLLABTIVE", $c_missing);
if (!defined("_AUTHENTICATION_ON_AGORAPROJECT"))    define("_AUTHENTICATION_ON_AGORAPROJECT", $c_missing);
if (!defined("_AUTHENTICATION_ON_UCENTER"))         define("_AUTHENTICATION_ON_UCENTER", $c_missing);
if (!defined("_AUTHENTICATION_ON_WEBCALENDAR"))     define("_AUTHENTICATION_ON_WEBCALENDAR", $c_missing);
if (!defined("_AUTHENTICATION_ON_VCALENDAR"))       define("_AUTHENTICATION_ON_VCALENDAR", $c_missing);
if (!defined("_AUTHENTICATION_ON_OWL"))             define("_AUTHENTICATION_ON_OWL", $c_missing);
if (!defined("_AUTHENTICATION_ON_MINIBB"))          define("_AUTHENTICATION_ON_MINIBB", $c_missing);
if (!defined("_AUTHENTICATION_ON_AEF"))             define("_AUTHENTICATION_ON_AEF", $c_missing);
if (!defined("_AUTHENTICATION_ON_FUDFORUM"))        define("_AUTHENTICATION_ON_FUDFORUM", $c_missing);
if (!defined("_AUTHENTICATION_ON_PUNBB"))           define("_AUTHENTICATION_ON_PUNBB", $c_missing);
if (!defined("_AUTHENTICATION_ON_TOUTATEAM"))       define("_AUTHENTICATION_ON_TOUTATEAM", $c_missing);
if (!defined("_AUTHENTICATION_ON_PHPROJECKT"))      define("_AUTHENTICATION_ON_PHPROJECKT", $c_missing);
if (!defined("_AUTHENTICATION_ON_TIKIWIKI"))        define("_AUTHENTICATION_ON_TIKIWIKI", $c_missing);
if (!defined("_AUTHENTICATION_ON_STREBER"))         define("_AUTHENTICATION_ON_STREBER", $c_missing);
if (!defined("_AUTHENTICATION_ON_MODX"))            define("_AUTHENTICATION_ON_MODX", $c_missing);
if (!defined("_AUTHENTICATION_ON_NUCLEUS"))         define("_AUTHENTICATION_ON_NUCLEUS", $c_missing);
if (!defined("_AUTHENTICATION_ON_MAMBO"))           define("_AUTHENTICATION_ON_MAMBO", $c_missing);
if (!defined("_AUTHENTICATION_ON_TYPO3"))           define("_AUTHENTICATION_ON_TYPO3", $c_missing);
if (!defined("_AUTHENTICATION_ON_DRUPAL"))          define("_AUTHENTICATION_ON_DRUPAL", $c_missing);
if (!defined("_AUTHENTICATION_ON_VTIGERCRM"))       define("_AUTHENTICATION_ON_VTIGERCRM", $c_missing);
if (!defined("_AUTHENTICATION_ON_SUGARCRM"))        define("_AUTHENTICATION_ON_SUGARCRM", $c_missing);
if (!defined("_AUTHENTICATION_ON_PHPGROUPWARE"))    define("_AUTHENTICATION_ON_PHPGROUPWARE", $c_missing);
if (!defined("_AUTHENTICATION_ON_MYBB"))            define("_AUTHENTICATION_ON_MYBB", $c_missing);
if (!defined("_AUTHENTICATION_ON_XOOPS"))           define("_AUTHENTICATION_ON_XOOPS", $c_missing);
if (!defined("_AUTHENTICATION_ON_PHPFUSION"))       define("_AUTHENTICATION_ON_PHPFUSION", $c_missing);
if (!defined("_AUTHENTICATION_ON_WEBCOLLAB"))       define("_AUTHENTICATION_ON_WEBCOLLAB", $c_missing);
if (!defined("_AUTHENTICATION_ON_IPBOARD"))         define("_AUTHENTICATION_ON_IPBOARD", $c_missing);
if (!defined("_AUTHENTICATION_ON_TASKFREAK"))       define("_AUTHENTICATION_ON_TASKFREAK", $c_missing);
if (!defined("_AUTHENTICATION_ON_ACHIEVO"))         define("_AUTHENTICATION_ON_ACHIEVO", $c_missing);
if (!defined("_AUTHENTICATION_ON_SMF"))             define("_AUTHENTICATION_ON_SMF", $c_missing);
if (!defined("_AUTHENTICATION_ON_OVIDENTIA"))       define("_AUTHENTICATION_ON_OVIDENTIA", $c_missing);
if (!defined("_AUTHENTICATION_ON_EGROUPWARE"))      define("_AUTHENTICATION_ON_EGROUPWARE", $c_missing);
if (!defined("_AUTHENTICATION_ON_DOTPROJECT"))      define("_AUTHENTICATION_ON_DOTPROJECT", $c_missing);
if (!defined("_AUTHENTICATION_ON_DOLIBARR"))        define("_AUTHENTICATION_ON_DOLIBARR", $c_missing);
if (!defined("_AUTHENTICATION_ON_PHENIX"))          define("_AUTHENTICATION_ON_PHENIX", $c_missing);
if (!defined("_AUTHENTICATION_ON_PHPNUKE"))         define("_AUTHENTICATION_ON_PHPNUKE", $c_missing);
if (!defined("_AUTHENTICATION_ON_JOOMLA"))          define("_AUTHENTICATION_ON_JOOMLA", $c_missing);
if (!defined("_AUTHENTICATION_ON_PHORUM"))          define("_AUTHENTICATION_ON_PHORUM", $c_missing);
if (!defined("_AUTHENTICATION_ON_VBULLETIN"))       define("_AUTHENTICATION_ON_VBULLETIN", $c_missing);
if (!defined("_AUTHENTICATION_ON_PHPBB_2"))         define("_AUTHENTICATION_ON_PHPBB_2", $c_missing);
//
if (!defined("_EXTERN_URL_FORGET_PASSWORD"))        define("_EXTERN_URL_FORGET_PASSWORD", $c_missing);
if (!defined("_FORCE_UPDATE_BY_SERVER"))            define("_FORCE_UPDATE_BY_SERVER", $c_missing);
if (!defined("_STOP_USE_THIS_SERVER_ADDRESS_NOW_USE_THIS_URL")) define("_STOP_USE_THIS_SERVER_ADDRESS_NOW_USE_THIS_URL", $c_missing);
if (!defined("_EXTERN_URL_TO_REGISTER"))            define("_EXTERN_URL_TO_REGISTER", $c_missing);
if (!defined("_EXTERN_URL_CHANGE_PASSWORD"))        define("_EXTERN_URL_CHANGE_PASSWORD", $c_missing);
//
//
require ("../common/menu.inc.php"); // après config.inc.php !
//echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
echo "<html><head>";
echo "<title>[IM] " . $l_admin_options_title . " - " . $l_admin_options_autentification . "</title>";
echo '<LINK REL="SHORTCUT ICON" HREF="../images/favicon.ico">';
display_header();
echo '<META http-equiv="refresh" content="400;url="> ';
echo "</head>";
echo "<body>";
//
//
//
display_menu();
//
$si_not_ok = "OK";
//
/*
function f_is_empty_missing($option)
{
  GLOBAL $c_missing;
  if ( ($option == '') or ($option == $c_missing) )
    return true;
  else
    return false;
}
*/
function f_not_empty_missing($option)
{
  GLOBAL $c_missing;
  if ( ($option != '') and ($option != $c_missing) )
    return true;
  else
    return false;
}
//
// Afficher une ligne d'option.
function display_row($var1, $var2, $comment, $lan, $wan)  
{
	GLOBAL $si_not_ok, $c_missing;
	GLOBAL $l_admin_options_legende_not_empty, $l_admin_options_legende_empty, $l_admin_options_legende_up2u, $l_admin_options_title_2;
	$var1 = trim($var1);
	$info_is_on = "On : " . $l_admin_options_legende_not_empty;
	$info_is_off = "Off : " . $l_admin_options_legende_empty;
	$info_should_be_on = $l_admin_options_title_2 . " : " . $l_admin_options_legende_not_empty; // "Should be activated";
	$info_should_be_off = $l_admin_options_title_2 . " : " . $l_admin_options_legende_empty; // "Should not be activated";
	$info_should_be_up2u = $l_admin_options_legende_up2u; // "Should be... up to you...";
	echo "<TR>";
	//
	echo "<TD class='row2'>";
	echo "<font face='verdana' size='1'>&nbsp;" . $var2 . "&nbsp;</font>";
	echo "</TD>";
	//
	echo "<TD align='CENTER' class='row1'>";
	echo "<font face='verdana' size='2'>";
	if ($var1 != $c_missing)
	{
		if ($var1 == "")
				echo "<IMG SRC='" . _FOLDER_IMAGES . "bt_gray.gif' WIDTH='18' HEIGHT='18' ALT='" . $info_is_off . "' TITLE='" . $info_is_off . "'>";
		if ( (strval($var1) > 0) or ($var1 == "0") or (strlen($var1) > 2) )
		{
			if ( ($var2 != "_EXTERN_URL_TO_REGISTER") and ($var2 != "_EXTERN_URL_FORGET_PASSWORD") and ($var2 != "_EXTERN_URL_CHANGE_PASSWORD") )
				echo $var1;
			else
        echo "<A HREF='" . $var1 . "' target='_blank'>URL</A>";
		}
		else
			if ($var1 != "")
				echo "<IMG SRC='" . _FOLDER_IMAGES . "bt_green.gif' WIDTH='18' HEIGHT='18' ALT='" . $info_is_on . "' TITLE='" . $info_is_on . "'>";
	}
	else
	{
		echo "<FONT color='RED'><B>Missing</B></FONT> in <BR/><A HREF='check.php' alt='../common/config/config.inc.php' title='../common/config/config.inc.php'>file config</A> !";
		$si_not_ok = "KO";
	}
	echo "</TD>";

	if ($comment == '')
	{
		echo "<TD class='row2'>";
		echo " &nbsp; ";
	}
	else
	{
		echo "<TD align='LEFT' class='row3'>";
		echo "<font face='verdana' size='2'>&nbsp;" . $comment . "</font>";
	}
	//
	echo "</TR>";
	echo "\n";
}
//
//
echo "<font face='verdana' size='2'><BR/>";

if (!is_readable("../common/config/extern.config.inc.php")) 
{
	echo "<FONT COLOR='RED'><B> <I>/common/config/extern.config.inc.php</I> : " . $l_admin_check_not_found;
  if ($lang == "FR")
    echo "</B><BR/><BR/> Pour utiliser l'authentification externe, déplacez le fichier de configuration <BR/><I>/config/extern/***.config.inc.php</I> &nbsp;<B>vers</B>&nbsp; <I>/config/extern.config.inc.php</I> <BR/> et renommer l'option \$table_prefix &nbsp;<B>en</B>&nbsp; \$extern_prefix !</font><BR/><BR/>";
  else
    echo "</B><BR/><BR/> To use extern authentication, move the configuration file <BR/><I>/config/extern/***.config.inc.php</I> &nbsp;<B>to</B>&nbsp; <I>/config/extern.config.inc.php</I> <BR/> and rename option \$table_prefix &nbsp;<B>to</B>&nbsp; \$extern_prefix !</font><BR/><BR/>";
}
else
{
  require("../common/config/extern.config.inc.php");
  if (!isset($extern_prefix))
  {
    echo "<FONT COLOR='RED'><B> <I>/common/config/extern.config.inc.php</I> : ";
    if ($lang == "FR")
      echo "</B><BR/> Renommer l'option <I>\$table_prefix</I> &nbsp;<B>en</B>&nbsp; <I>\$extern_prefix</I> !</font><BR/><BR/>";
    else
      echo "</B><BR/> Rename option <I>\$table_prefix</I> &nbsp;<B>to</B>&nbsp; <I>\$extern_prefix</I> !</font><BR/><BR/>";
  }
}

/*
$nb_auth_extern = f_nb_auth_extern();
if ($nb_auth_extern > 0)
{
  if ( (_USER_NEED_PASSWORD == '') or (_ALLOW_AUTO_ADD_NEW_USER_ON_SERVER == '') or (_PENDING_NEW_AUTO_ADDED_USER != '') )
    echo "<div class='warning'><B>" . $l_admin_options_info_10 . " <font color='red'>" . $l_admin_options_info_9 . "</font></B><I> _USER_NEED_PASSWORD _ALLOW_AUTO_ADD_NEW_USER_ON_SERVER _PENDING_NEW_AUTO_ADDED_USER</I>.</div>";
  //
  if ( (_EXTERN_URL_TO_REGISTER == "") or (_EXTERN_URL_TO_REGISTER == $c_missing) )
    echo "<div class='warning'><B>" . $l_admin_options_info_10 . " <font color='red'>" . $l_admin_options_info_9 . "</font></B><I> _EXTERN_URL_TO_REGISTER</I>.</div>";
  //
  if ($nb_auth_extern > 1)
    echo "<div class='warning'><B>" . $l_admin_options_info_10 . " <font color='red'>" . $l_admin_options_info_11 . "</font></B></div>";
  //
}
*/
echo "<TABLE cellspacing='1' cellpadding='1' class='forumline'>";
echo "<TR>";
	echo "<TH align=center COLSPAN='3' class='thHead'>";
	echo "<font face=verdana size=3><b>" . $l_admin_options_title . " - " . $l_admin_options_autentification . "</b></font></TH>";
	//echo "<TH align=center COLSPAN='2' class='thHead'>";
	//echo "<font face=verdana size=3><b>" . $l_admin_options_title_2 . "</b></font></TH>";
echo "</TR>";
echo "<TR>";
	display_row_table($l_admin_options_col_option, '');
	display_row_table("&nbsp;" . $l_admin_options_col_value . "&nbsp;", '');
	display_row_table($l_admin_options_col_comment, '');
	//display_row_table("&nbsp;LAN&nbsp;", '');
	//display_row_table("Internet", '');
echo "</TR>";

/*
if (_PASSWORD_FOR_PRIVATE_SERVER != "")
  display_row("X", "_PASSWORD_FOR_PRIVATE_SERVER", $l_admin_options_password_for_private_server, "-", "");
else
  display_row("", "_PASSWORD_FOR_PRIVATE_SERVER", $l_admin_options_password_for_private_server, "-", "");
*/
display_row(_EXTERN_URL_TO_REGISTER, "_EXTERN_URL_TO_REGISTER", $l_admin_extern_url_to_register, "", "");
display_row(_EXTERN_URL_FORGET_PASSWORD, "_EXTERN_URL_FORGET_PASSWORD", $l_admin_extern_url_password_forget, "", "");
display_row(_EXTERN_URL_CHANGE_PASSWORD, "_EXTERN_URL_CHANGE_PASSWORD", $l_admin_extern_url_change_password, "", "");

echo "<TR>";
echo "<TD colspan='5' align='center' class='catHead'>";
//echo "<font face='verdana' size='2'><B>" . $l_admin_options_autentification . " :</B></font>";
echo "<font face='verdana' size='2'><B>" . $l_admin_options_info_10 . " :</B></font>";
echo "</TD>";
echo "</TR>";
//
$auth_dotclear = "";
if ( (f_not_empty_missing(_AUTHENTICATION_ON_DOTCLEAR_1)) or (f_not_empty_missing(_AUTHENTICATION_ON_DOTCLEAR_2)) ) $auth_dotclear = "X";
if ( (_AUTHENTICATION_ON_DOTCLEAR_1 == $c_missing) or (_AUTHENTICATION_ON_DOTCLEAR_2 == $c_missing) ) $auth_dotclear = $c_missing;
//
$auth_phpbb = "";
if ( (f_not_empty_missing(_AUTHENTICATION_ON_PHPBB_2)) or (f_not_empty_missing(_AUTHENTICATION_ON_PHPBB_3)) ) $auth_phpbb = "X";
if ( (_AUTHENTICATION_ON_PHPBB_2 == $c_missing) or (_AUTHENTICATION_ON_PHPBB_3 == $c_missing) ) $auth_phpbb = $c_missing;
//
//display_row($c_autentification_on_phpBB_2, "c_autentification_on_phpBB_2", $l_admin_authentication_extern . " " . $l_auth_phpbb, "", "");
//display_row($c_autentification_on_phpBB_3, "c_autentification_on_phpBB_3", $l_admin_authentication_extern . " " . $l_auth_phpbb, "", "");
//if ( (f_not_empty_missing(_AUTHENTICATION_ON_DOTCLEAR_1)) or (f_not_empty_missing(_AUTHENTICATION_ON_DOTCLEAR_2)) )
//  display_row("X", "_AUTHENTICATION_ON_DOTCLEAR", $l_admin_authentication_extern . " " . $l_auth_dotclear, "", "");
//else
//  display_row("", "_AUTHENTICATION_ON_DOTCLEAR", $l_admin_authentication_extern . " " . $l_auth_dotclear, "", "");
//if ( (f_not_empty_missing(_AUTHENTICATION_ON_PHPBB_2)) or (f_not_empty_missing(_AUTHENTICATION_ON_PHPBB_3))  )
//  display_row("X", "_AUTHENTICATION_ON_PHPBB", $l_admin_authentication_extern . " " . $l_auth_phpbb, "", "");
//else
//  display_row("", "_AUTHENTICATION_ON_PHPBB", $l_admin_authentication_extern . " " . $l_auth_phpbb, "", "");
$l_admin_authentication_extern .= "<I>";

display_row(_AUTHENTICATION_ON_ACHIEVO, "_AUTHENTICATION_ON_ACHIEVO", $l_admin_authentication_extern . " Achievo", "", "");
display_row(_AUTHENTICATION_ON_ACTIVECOLLAB, "_AUTHENTICATION_ON_ACTIVECOLLAB", $l_admin_authentication_extern . " activeCollab", "", "");
display_row(_AUTHENTICATION_ON_AEF, "_AUTHENTICATION_ON_AEF", $l_admin_authentication_extern . " AEF Board", "", "");
display_row(_AUTHENTICATION_ON_AGORAPROJECT, "_AUTHENTICATION_ON_AGORAPROJECT", $l_admin_authentication_extern . " Agora-Project", "", "");
display_row(_AUTHENTICATION_ON_BITWEAVER, "_AUTHENTICATION_ON_BITWEAVER", $l_admin_authentication_extern . " Bitweaver", "", "");
display_row(_AUTHENTICATION_ON_CLAROLINE, "_AUTHENTICATION_ON_CLAROLINE", $l_admin_authentication_extern . " Claroline", "", "");
display_row(_AUTHENTICATION_ON_CMSMADESIMPLE, "_AUTHENTICATION_ON_CMSMADESIMPLE", $l_admin_authentication_extern . " CMS-Made-Simple", "", "");
display_row(_AUTHENTICATION_ON_COLLABTIVE, "_AUTHENTICATION_ON_COLLABTIVE", $l_admin_authentication_extern . " Collabtive", "", "");
display_row(_AUTHENTICATION_ON_CONCRETE5, "_AUTHENTICATION_ON_CONCRETE5", $l_admin_authentication_extern . " Concrete5", "", "");
display_row(_AUTHENTICATION_ON_CONNECTIXBOARDS, "_AUTHENTICATION_ON_CONNECTIXBOARDS", $l_admin_authentication_extern . " Connectix-Boards", "", "");
display_row(_AUTHENTICATION_ON_CUTEFLOW, "_AUTHENTICATION_ON_CUTEFLOW", $l_admin_authentication_extern . " CuteFlow", "", "");
display_row(_AUTHENTICATION_ON_DOKEOS, "_AUTHENTICATION_ON_DOKEOS", $l_admin_authentication_extern . " Dokeos", "", "");
display_row(_AUTHENTICATION_ON_DOLIBARR, "_AUTHENTICATION_ON_DOLIBARR", $l_admin_authentication_extern . " Dolibarr", "", "");
display_row($auth_dotclear, "_AUTHENTICATION_ON_DOTCLEAR", $l_admin_authentication_extern . " Dotclear", "", "");
display_row(_AUTHENTICATION_ON_DOTPROJECT, "_AUTHENTICATION_ON_DOTPROJECT", $l_admin_authentication_extern . " dotProject", "", "");
display_row(_AUTHENTICATION_ON_DRUPAL, "_AUTHENTICATION_ON_DRUPAL", $l_admin_authentication_extern . " Drupal", "", "");
display_row(_AUTHENTICATION_ON_E107, "_AUTHENTICATION_ON_E107", $l_admin_authentication_extern . " e107", "", "");
display_row(_AUTHENTICATION_ON_EGROUPWARE, "_AUTHENTICATION_ON_EGROUPWARE", $l_admin_authentication_extern . " eGroupWare", "", "");
display_row(_AUTHENTICATION_ON_ELGG, "_AUTHENTICATION_ON_ELGG", $l_admin_authentication_extern . " Elgg", "", "");
display_row(_AUTHENTICATION_ON_EZPUBLISH, "_AUTHENTICATION_ON_EZPUBLISH", $l_admin_authentication_extern . " eZ-Publish", "", "");
display_row(_AUTHENTICATION_ON_FLUXBB, "_AUTHENTICATION_ON_FLUXBB", $l_admin_authentication_extern . " FluxBB", "", "");
display_row(_AUTHENTICATION_ON_FUDFORUM, "_AUTHENTICATION_ON_FUDFORUM", $l_admin_authentication_extern . " FUDforum", "", "");
display_row(_AUTHENTICATION_ON_GEPI, "_AUTHENTICATION_ON_GEPI", $l_admin_authentication_extern . " GEPI", "", "");
display_row(_AUTHENTICATION_ON_GROUPOFFICE, "_AUTHENTICATION_ON_GROUPOFFICE", $l_admin_authentication_extern . " Group-Office", "", "");
display_row(_AUTHENTICATION_ON_IMPRESSCMS, "_AUTHENTICATION_ON_IMPRESSCMS", $l_admin_authentication_extern . " ImpressCMS", "", "");
display_row(_AUTHENTICATION_ON_IPBOARD, "_AUTHENTICATION_ON_IPBOARD", $l_admin_authentication_extern . " IP-Board", "", "");
display_row(_AUTHENTICATION_ON_ISSUEMANAGER, "_AUTHENTICATION_ON_ISSUEMANAGER", $l_admin_authentication_extern . " IssueManager", "", "");
display_row(_AUTHENTICATION_ON_JOOMLA, "_AUTHENTICATION_ON_JOOMLA", $l_admin_authentication_extern . " Joomla", "", "");
display_row(_AUTHENTICATION_ON_MALLEO, "_AUTHENTICATION_ON_MALLEO", $l_admin_authentication_extern . " Malleo", "", "");
display_row(_AUTHENTICATION_ON_MAMBO, "_AUTHENTICATION_ON_MAMBO", $l_admin_authentication_extern . " Mambo", "", "");
display_row(_AUTHENTICATION_ON_MINIBB, "_AUTHENTICATION_ON_MINIBB", $l_admin_authentication_extern . " miniBB", "", "");
display_row(_AUTHENTICATION_ON_MODX, "_AUTHENTICATION_ON_MODX", $l_admin_authentication_extern . " MODx", "", "");
display_row(_AUTHENTICATION_ON_MOODLE, "_AUTHENTICATION_ON_MOODLE", $l_admin_authentication_extern . " Moodle", "", "");
display_row(_AUTHENTICATION_ON_MYBB, "_AUTHENTICATION_ON_MYBB", $l_admin_authentication_extern . " MyBB", "", "");
display_row(_AUTHENTICATION_ON_NUCLEUS, "_AUTHENTICATION_ON_NUCLEUS", $l_admin_authentication_extern . " Nucleus", "", "");
display_row(_AUTHENTICATION_ON_OBM, "_AUTHENTICATION_ON_OBM", $l_admin_authentication_extern . " OBM", "", "");
display_row(_AUTHENTICATION_ON_OPENGOO, "_AUTHENTICATION_ON_OPENGOO", $l_admin_authentication_extern . " OpenGoo", "", "");
display_row(_AUTHENTICATION_ON_OVIDENTIA, "_AUTHENTICATION_ON_OVIDENTIA", $l_admin_authentication_extern . " Ovidentia", "", "");
display_row(_AUTHENTICATION_ON_OWL, "_AUTHENTICATION_ON_OWL", $l_admin_authentication_extern . " Owl", "", "");
display_row(_AUTHENTICATION_ON_PHENIX, "_AUTHENTICATION_ON_PHENIX", $l_admin_authentication_extern . " Phenix-Agenda", "", "");
display_row(_AUTHENTICATION_ON_PHORUM, "_AUTHENTICATION_ON_PHORUM", $l_admin_authentication_extern . " Phorum", "", "");
display_row($auth_phpbb, "_AUTHENTICATION_ON_PHPBB", $l_admin_authentication_extern . " phpBB", "", "");
display_row(_AUTHENTICATION_ON_PHPBMS, "_AUTHENTICATION_ON_PHPBMS", $l_admin_authentication_extern . " phpBMS", "", "");
display_row(_AUTHENTICATION_ON_PHPBOOST, "_AUTHENTICATION_ON_PHPBOOST", $l_admin_authentication_extern . " PHPBoost", "", "");
display_row(_AUTHENTICATION_ON_PHPCOLLAB, "_AUTHENTICATION_ON_PHPCOLLAB", $l_admin_authentication_extern . " phpCollab", "", "");
display_row(_AUTHENTICATION_ON_PHPFUSION, "_AUTHENTICATION_ON_PHPFUSION", $l_admin_authentication_extern . " PHP-Fusion", "", "");
display_row(_AUTHENTICATION_ON_PHPGROUPWARE, "_AUTHENTICATION_ON_PHPGROUPWARE", $l_admin_authentication_extern . " phpGroupWare", "", "");
display_row(_AUTHENTICATION_ON_PHPIZABI, "_AUTHENTICATION_ON_PHPIZABI", $l_admin_authentication_extern . " PHPizabi", "", "");
display_row(_AUTHENTICATION_ON_PHPNUKE, "_AUTHENTICATION_ON_PHPNUKE", $l_admin_authentication_extern . " PHP-Nuke", "", "");
display_row(_AUTHENTICATION_ON_PHPROJECKT, "_AUTHENTICATION_ON_PHPROJECKT", $l_admin_authentication_extern . " PHProjekt", "", "");
display_row(_AUTHENTICATION_ON_PLIGG, "_AUTHENTICATION_ON_PLIGG", $l_admin_authentication_extern . " Pligg", "", "");
display_row(_AUTHENTICATION_ON_PMS, "_AUTHENTICATION_ON_PMS", $l_admin_authentication_extern . " PMS", "", "");
display_row(_AUTHENTICATION_ON_PROJECTPIER, "_AUTHENTICATION_ON_PROJECTPIER", $l_admin_authentication_extern . " ProjectPier", "", "");
display_row(_AUTHENTICATION_ON_PROMETHEE, "_AUTHENTICATION_ON_PROMETHEE", $l_admin_authentication_extern . " Prom&eacute;th&eacute;e", "", "");
display_row(_AUTHENTICATION_ON_PUNBB, "_AUTHENTICATION_ON_PUNBB", $l_admin_authentication_extern . " PunBB", "", "");
display_row(_AUTHENTICATION_ON_SMF, "_AUTHENTICATION_ON_SMF", $l_admin_authentication_extern . " SMF", "", "");
display_row(_AUTHENTICATION_ON_STREBER, "_AUTHENTICATION_ON_STREBER", $l_admin_authentication_extern . " Streber", "", "");
display_row(_AUTHENTICATION_ON_SUGARCRM, "_AUTHENTICATION_ON_SUGARCRM", $l_admin_authentication_extern . " SugarCRM", "", "");
display_row(_AUTHENTICATION_ON_TASKFREAK, "_AUTHENTICATION_ON_TASKFREAK", $l_admin_authentication_extern . " TaskFreak", "", "");
display_row(_AUTHENTICATION_ON_TEXTCUBE, "_AUTHENTICATION_ON_TEXTCUBE", $l_admin_authentication_extern . " Textcube", "", "");
display_row(_AUTHENTICATION_ON_TIKIWIKI, "_AUTHENTICATION_ON_TIKIWIKI", $l_admin_authentication_extern . " TikiWiki", "", "");
display_row(_AUTHENTICATION_ON_TOUTATEAM, "_AUTHENTICATION_ON_TOUTATEAM", $l_admin_authentication_extern . " Toutateam", "", "");
display_row(_AUTHENTICATION_ON_TRELLISDESK, "_AUTHENTICATION_ON_TRELLISDESK", $l_admin_authentication_extern . " Trellis Desk", "", "");
display_row(_AUTHENTICATION_ON_TRIADE, "_AUTHENTICATION_ON_TRIADE", $l_admin_authentication_extern . " Triade", "", "");
display_row(_AUTHENTICATION_ON_TYPO3, "_AUTHENTICATION_ON_TYPO3", $l_admin_authentication_extern . " Typo3", "", "");
display_row(_AUTHENTICATION_ON_TYPOLIGHT, "_AUTHENTICATION_ON_TYPOLIGHT", $l_admin_authentication_extern . " TYPOlight", "", "");
display_row(_AUTHENTICATION_ON_UCENTER, "_AUTHENTICATION_ON_UCENTER", $l_admin_authentication_extern . " UCenter", "", "");
display_row(_AUTHENTICATION_ON_VBULLETIN, "_AUTHENTICATION_ON_VBULLETIN", $l_admin_authentication_extern . " vBulletin", "", "");
display_row(_AUTHENTICATION_ON_VCALENDAR, "_AUTHENTICATION_ON_VCALENDAR", $l_admin_authentication_extern . " VCalendar", "", "");
display_row(_AUTHENTICATION_ON_VTIGERCRM, "_AUTHENTICATION_ON_VTIGERCRM", $l_admin_authentication_extern . " vtigerCRM", "", "");
display_row(_AUTHENTICATION_ON_WBBLITE, "_AUTHENTICATION_ON_WBBLITE", $l_admin_authentication_extern . " Burning Board Lite", "", "");
display_row(_AUTHENTICATION_ON_WEBCALENDAR, "_AUTHENTICATION_ON_WEBCALENDAR", $l_admin_authentication_extern . " WebCalendar", "", "");
display_row(_AUTHENTICATION_ON_WEBCOLLAB, "_AUTHENTICATION_ON_WEBCOLLAB", $l_admin_authentication_extern . " WebCollab", "", "");
display_row(_AUTHENTICATION_ON_WORDPRESS, "_AUTHENTICATION_ON_WORDPRESS", $l_admin_authentication_extern . " WordPress", "", "");
display_row(_AUTHENTICATION_ON_XMB, "_AUTHENTICATION_ON_XMB", $l_admin_authentication_extern . " XMB-Forum", "", "");
display_row(_AUTHENTICATION_ON_XOOPS, "_AUTHENTICATION_ON_XOOPS", $l_admin_authentication_extern . " Xoops", "", "");
display_row(_AUTHENTICATION_ON_YACS, "_AUTHENTICATION_ON_YACS", $l_admin_authentication_extern . " YACS", "", "");


#display_row(_AUTHENTICATION_ON_XXXXXX, "_AUTHENTICATION_ON_XXXXXX", $l_admin_authentication_extern . " xxxxxx", "", "");


/*
echo "<TR>";
  echo "<TD align='center' COLSPAN='10' class='catBottom'>";
  echo "<font face=verdana size='2' color='GRAY'>";
  //echo $l_admin_options_info_11; // only one
  echo "</TD>";
echo "</TR>";
*/
//
if ($si_not_ok != "OK") 
{
	echo "<TR>";
		echo "<TD align='center' COLSPAN='10' class='catBottom'>";
		echo "<font face=verdana size=2 color='RED'><B>";
		echo $l_admin_options_missing_option;
		echo " <A HREF='check.php' alt='' title=''>" . $l_admin_options_conf_file  . "</A> !</B>";
		echo "</TD>";
	echo "</TR>";
}
//
echo "</TABLE>";
echo "<BR/>";
//
	

  echo "<TABLE cellspacing='1' cellpadding='1' class='forumline'>";
  echo "<TR><TD COLSPAN='2' ALIGN='CENTER' class='catHead'><B>" . $l_legende . "</B></TD></TR>";

  echo "</TR><TR><TD ALIGN='CENTER' WIDTH='25' class='row1'>";
  echo "<IMG SRC='" . _FOLDER_IMAGES . "bt_green.gif' WIDTH='18' HEIGHT='18'>";
  echo "</TD><TD class='row3'><font face=verdana size=2>&nbsp;On : " . $l_admin_options_legende_not_empty . "&nbsp;";
  echo "</TD>";

  echo "</TD></TR><TR><TD ALIGN='CENTER' class='row1'>";
  //echo "&nbsp;";
  echo "<IMG SRC='" . _FOLDER_IMAGES . "bt_gray.gif' WIDTH='18' HEIGHT='18'>";
  echo "</TD><TD class='row3'><font face=verdana size=2>&nbsp;Off : " . $l_admin_options_legende_empty . "&nbsp;";
  echo "</TD>";

  echo "</TD></TR>";
  echo "</TABLE>";





//echo "</TD></TR>";
//echo "</TABLE>";
//mysql_close();
//
display_menu_footer();
//
echo "</body></html>";
?>