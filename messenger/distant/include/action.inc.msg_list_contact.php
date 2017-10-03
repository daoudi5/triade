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
if ( (!isset($_GET['iu'])) or (!isset($_GET['s'])) or (!isset($_GET['ip'])) or (!isset($_GET['v'])) ) die();
//
$id_user =	    intval(f_decode64_wd($_GET['iu']));
$id_user = 		  (intval($id_user) - intval($action));
$id_session =   intval(f_decode64_wd($_GET['s']));
$ip = 			    f_decode64_wd($_GET['ip']);
$version =	    intval($_GET['v']);
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
  //
  if (f_verif_id_session_id_user($id_user, $id_session) != 'OK')
  {
    die(">F46##"); // la session est déjà fermée (depuis celui qui consulte).
  }
  //
  $msg_from_admin = "";
  $msg_admin = "";
  //
  $requete  = " SELECT ID_MESSAGE, MSG_TEXT, MSG_CR ";
  $requete .= " from " . $PREFIX_IM_TABLE . "MSG_MESSAGE ";
  $requete .= " where ID_USER_DEST = " . $id_user . " ";
  $requete .= " and ID_USER_AUT = -99 ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-53a]", $requete);
  if ( mysql_num_rows($result) > 0 )
  {
    $msg_from_admin = "X";
    list ($id_msg, $msg_admin, $msg_cr) = mysql_fetch_row ($result);
    if ($msg_cr == "") $msg_admin = f_encode64($msg_admin);
    echo ">F46#ADMIN!#ADMIN!#" . $msg_admin . "##"; // on ne prend que le message d'admin
    //
    // on efface le message dans la foulée qu'on la envoyé
    $requete  = " delete from " . $PREFIX_IM_TABLE . "MSG_MESSAGE ";
    $requete .= " where ID_MESSAGE = " . $id_msg;
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-53b]", $requete);
  }
  //
  if ($msg_from_admin == "")
  {
    $retour = "";
    if ( (_SPECIAL_MODE_OPEN_COMMUNITY != "") or (_SPECIAL_MODE_GROUP_COMMUNITY != "") )
    {
      $requete  = " SELECT distinct(USR.ID_USER) ";
      $requete .= " from " . $PREFIX_IM_TABLE . "MSG_MESSAGE MSG, " . $PREFIX_IM_TABLE . "USR_USER USR ";
      $requete .= " where MSG.ID_USER_AUT = USR.ID_USER ";
      $requete .= " and MSG.ID_USER_DEST = " . $id_user . " ";
      $requete .= " and MSG.ID_CONFERENCE = 0 ";
    }
    else
    {
      $requete  = " SELECT distinct(USR.ID_USER) ";
      $requete .= " from " . $PREFIX_IM_TABLE . "MSG_MESSAGE MSG, " . $PREFIX_IM_TABLE . "USR_USER USR, " . $PREFIX_IM_TABLE . "CNT_CONTACT CNT ";
      $requete .= " where MSG.ID_USER_AUT = USR.ID_USER and CNT.ID_USER_2 = USR.ID_USER ";
      $requete .= " and CNT.ID_USER_1 = MSG.ID_USER_DEST ";
      $requete .= " and MSG.ID_USER_DEST = " . $id_user . " ";
      $requete .= " and MSG.ID_CONFERENCE = 0 ";
    }
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-53c]", $requete);
    if ( mysql_num_rows($result) > 0  )
    {
      while( list ($id_user_2) = mysql_fetch_row ($result) )
      {
        $retour .= $id_user_2 . "#";
      }
      echo ">F46#" . f_encode64($retour);
    }
    else
    {
      echo ">F46##"; // pas de message
    }
    //
    clean_inactives_session();
  }
  //
  mysql_close($id_connect);
}
?>