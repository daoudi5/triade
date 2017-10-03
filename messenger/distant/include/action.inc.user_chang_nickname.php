<?php
/*******************************************************
 **                  IntraMessenger - server          **
 **                                                   **
 **  Copyright:      (C) 2006 - 2010 THeUDS           **
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
if ( !defined('INTRAMESSENGER') )
{
  exit;
}
//
if ( (!isset($_GET['iu'])) or (!isset($_GET['s'])) or (!isset($_GET['n'])) or (!isset($_GET['ip'])) or (!isset($_GET['c'])) or (!isset($_GET['v'])) ) die();
if ( (strlen($_GET['v']) > 3) or (strlen($_GET['c']) > 15) ) die();
//if ( (!isset($_GET['id_user'])) or (!isset($_GET['id_ses'])) or (!isset($_GET['ip'])) or (!isset($_GET['n'])) or (!isset($_GET['check'])) ) die();
//
$id_user =	    intval(f_decode64_wd($_GET['iu']));
$id_user = 		  (intval($id_user) - intval($action));
$id_session = 	intval(f_decode64_wd($_GET['s']));
$ip = 			    f_decode64_wd($_GET['ip']);
$new_pseudo =	  f_decode64_wd($_GET['n']);
$version =      intval($_GET['v']);
$check = 		    $_GET['c'];
$check = 		    trim($check);
$nickname =     f_clean_name($new_pseudo);
$new_pseudo =   f_clean_username($new_pseudo);
#if (!ctype_alnum($check)) $check = "";
//
if (preg_match("#[^0-9]#", $id_user)) $id_user = "";
if (preg_match("#[^0-9]#", $id_session)) $id_session = "";
//
if ( ($id_user > 0) and ($id_session > 0) and ($check != "") and ($ip != "") )
{
  require ("../common/acces.inc.php");
  f_verif_ip($ip);
  //
  require ("../common/sql.inc.php");
  require ("../common/sessions.inc.php");
  //
  if (f_verif_id_session_id_user($id_user, $id_session) <> 'OK')
    die (">F65#KO#Session KO.#");
  //
  if ( (strlen($new_pseudo) < 3) or ( (intval(_MINIMUM_USERNAME_LENGTH) > 1) and (strlen($new_pseudo) < _MINIMUM_USERNAME_LENGTH) ) )
    die (">F65#KO#SMALL#");
  //
  if ( (strlen($nickname) < 3) or (_ALLOW_UPPERCASE_SPACE_USERNAME == '') ) $nickname = $user;
  //
  $t = f_DelSpecialChar($new_pseudo);
  if (f_is_banned_user_ip_pc($t, "U"))
  {
    die(">F65#KO#INTERDIT#"); // Pseudo interdit par l'administrateur.
  }
  //
  //
  if (f_verif_check_user_only($id_user, $check) == 'OK')
  {
    if (_ALLOW_AUTO_ADD_NEW_USER_ON_SERVER != '')
    {
      if (f_get_id_nom_user($new_pseudo) != '')
      {
        echo ">F65#KO#DOUBLON#"; // pseudo existe déjà.
      }
      else
      {
        $username = f_get_username_of_id($id_user);
        //
        if (_PENDING_NEW_AUTO_ADDED_USER != '')
        {
          //update_check_user($id_user, 'WAIT');
          $requete  = " update " . $PREFIX_IM_TABLE . "USR_USER SET USR_STATUS = 2 ";
          $requete .= " WHERE ID_USER = " . $id_user;
          $requete .= " LIMIT 1 "; // (to protect)
          $result = mysql_query($requete);
          if (!$result) error_sql_log("[ERR-71a]", $requete);
        }
        //
        if ($nickname == $new_pseudo) $nickname = "";
        //
        $requete  = " update " . $PREFIX_IM_TABLE . "USR_USER ";
        $requete .= " SET USR_USERNAME = '" . $new_pseudo . "', USR_NICKNAME = '" . $nickname . "' ";
        $requete .= " WHERE ID_USER = " . $id_user;
        $requete .= " LIMIT 1 "; // (to protect)
        $result = mysql_query($requete);
        if (!$result) error_sql_log("[ERR-71b]", $requete);
        //
        echo ">F65#OK##";
        //
        write_log("log_user_change_nickname", $username . ";" . $new_pseudo . " (" . $nickname . ")");
      }
    }
    else
    {
      echo ">F65#KO#CANNOT#";
    }
  }
  //
  mysql_close($id_connect);
}
?>