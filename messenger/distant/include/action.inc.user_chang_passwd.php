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
if ( (!isset($_GET['iu'])) or (!isset($_GET['s'])) or (!isset($_GET['ip'])) or (!isset($_GET['c'])) or (!isset($_GET['v'])) or (!isset($_GET['pa'])) or (!isset($_GET['pn'])) ) die();
if ( (strlen($_GET['v']) > 3) or (strlen($_GET['c']) > 15) ) die();
//if ( (!isset($_GET['id_user'])) or (!isset($_GET['id_ses'])) or (!isset($_GET['ip'])) or (!isset($_GET['pass_anc'])) or (!isset($_GET['pass_new'])) or (!isset($_GET['check'])) ) die();
//
$id_user =	  intval(f_decode64_wd($_GET['iu']));
$id_user = 		(intval($id_user) - intval($action));
$id_session = intval(f_decode64_wd($_GET['s']));
$ip = 			  f_decode64_wd($_GET['ip']);
$pass_anc =		f_decode64_wd($_GET['pa']);
$pass_new =		f_decode64_wd($_GET['pn']);
$version =    intval($_GET['v']);
$check = 		  $_GET['c'];
$check = 		  trim($check);
#if (!ctype_alnum($check))   $check = "";
//
if (preg_match("#[^0-9]#", $id_user)) $id_user = "";
if (preg_match("#[^0-9]#", $id_session)) $id_session = "";
//
if ( ($id_user > 0) and ($id_session > 0) and ($check != "") and ($pass_new != "") and ($ip != "") )
{
  require ("../common/acces.inc.php");
  f_verif_ip($ip);
  //
  require ("../common/sql.inc.php");
  require ("../common/sessions.inc.php");
  require ("../common/config/auth.inc.php");
  //
  if (f_verif_id_session_id_user($id_user, $id_session) <> 'OK')
    die (">F60#KO#Session KO.#");
  //
  if ( (f_verif_check_user_only($id_user, $check) == 'OK') and (_USER_NEED_PASSWORD != '') )
  {
    $requete  = " select USR_PASSWORD FROM " . $PREFIX_IM_TABLE . "USR_USER ";
    $requete .= " WHERE ID_USER = " . $id_user . " ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-70a]", $requete);
    if ( mysql_num_rows($result) == 1 )
    {
      list ($usr_pass) = mysql_fetch_row ($result);
      //
      $passcr = sha1($password_pepper . $pass_anc . "W$*7B0-c6");
      if ($usr_pass == $passcr)
      {
        $ret = f_update_pass_user($id_user, $pass_new);
        echo ">F60#". $ret . "##";
      }
      else
        echo ">F60#KO#OLD#";
    }
  }
  //
  mysql_close($id_connect);
}
?>