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
if ( (!isset($_GET['u'])) or (!isset($_GET['s'])) or (!isset($_GET['ip'])) ) die();
//
$id_user =	    intval(f_decode64_wd($_GET['u']));
$id_user = 		  (intval($id_user) - intval($action));
$id_session =   intval(f_decode64_wd($_GET['s']));
$ip = 			    f_decode64_wd($_GET['ip']);
//
if (preg_match("#[^0-9]#", $id_user)) $id_user = "";
if (preg_match("#[^0-9]#", $id_session)) $id_session = "";
//
if ( ($id_user > 0) and ($id_session > 0) and ($ip != "") )
{
  require ("../common/acces.inc.php");
  f_verif_ip($ip);
  //
  require ("../common/sql.inc.php");
  require ("../common/sessions.inc.php");
  if (f_verif_id_session_id_user($id_user, $id_session) <> 'OK')
    die ("Session KO.");
  //
  close_session_id_user($id_user);
  //
  $requete  = " update " . $PREFIX_IM_TABLE . "USR_USER ";
  $requete .= " SET USR_STATUS = 9 "; // USR_NAME = 'LEAVE SERVER' , USR_CHECK = '', 
  $requete .= " WHERE ID_USER = " . $id_user ;
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-09a]", $requete);
  //
  // on vide son carnet d'adresses :
  $requete  = " delete from " . $PREFIX_IM_TABLE . "CNT_CONTACT "; 
  $requete .= " WHERE ID_USER_1 = " . $id_user . " "; 
  $requete .= " or ID_USER_2 = " . $id_user;
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-09b]", $requete);
  //
  // Suppression de sa présence dans les groupes
  $requete  = " delete FROM " . $PREFIX_IM_TABLE . "USG_USERGRP ";
  $requete .= " WHERE ID_USER = " . $id_user;
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-09c]", $requete);
  //
  // Suppression des messages
  $requete  = " delete FROM " . $PREFIX_IM_TABLE . "MSG_MESSAGE ";
  $requete .= " WHERE ID_USER_AUT = " . $id_user . " ";
  $requete .= " or ID_USER_DEST = " . $id_user;
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-09d]", $requete);
  //
  // ShoutBox
  $requete  = " delete from " . $PREFIX_IM_TABLE . "SBV_SHOUTVOTE ";
  $requete .= " where ID_USER_AUT = " . $id_user . " or ID_USER_VOTE = " . $id_user . " ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-09e]", $requete);
  //
  $requete  = " delete from " . $PREFIX_IM_TABLE . "SBS_SHOUTSTATS ";
  $requete .= " where ID_USER_AUT = " . $id_user;
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-09f]", $requete);
  //
  $requete  = " delete from " . $PREFIX_IM_TABLE . "SBX_SHOUTBOX ";
  $requete .= " where ID_USER_AUT = " . $id_user;
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-09g]", $requete);
  //
  //write_log("log_leave_server", $id_user . " / " . $ip);
  //
  mysql_close($id_connect);
}
?>