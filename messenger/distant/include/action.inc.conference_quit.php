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
if ( (!isset($_GET['u'])) or (!isset($_GET['s'])) or (!isset($_GET['id'])) or (!isset($_GET['ip'])) ) die();
//
$id_user =	  intval(f_decode64_wd($_GET['u']));
$id_user = 		(intval($id_user) - intval($action));
$id_session = intval(f_decode64_wd($_GET['s']));
$ip = 			  f_decode64_wd($_GET['ip']);
$id_conf = 		intval(f_decode64_wd($_GET['id']));
$version =    intval($_GET['v']);
//
if (preg_match("#[^0-9]#", $id_user)) $id_user = "";
if (preg_match("#[^0-9]#", $id_session)) $id_session = "";
if (preg_match("#[^0-9]#", $id_conf)) $id_conf = "";
//
if ( ($id_user > 0) and ($id_session > 0) and ($id_conf > 0) )
{
  require ("../common/acces.inc.php");
  f_verif_ip($ip);
  //
  require ("../common/sql.inc.php");
  require ("../common/sessions.inc.php");
  //
  if (f_verif_id_session_id_user($id_user, $id_session) != 'OK') 
  {
    //die(">F51#KO#1#"); // 1:session non ouverte.
    $id_conf = 0;
  }
  //if (_ALLOW_CONFERENCE == '')
  //	die(">F51#KO#5#"); // 5:non autorisé
  //
  if ($id_conf > 0)
  {
    $msg_cr = f_encode64("QUIT_CONFERENCE");
    $cr = "64";
    // on envoi l'info à tous.
    // on défile tous les destinataires (en vérifiant que leur session est toujours valide)
    $requete  = " select distinct(USC.ID_USER) ";
    $requete .= " FROM " . $PREFIX_IM_TABLE . "USC_USERCONF USC, " . $PREFIX_IM_TABLE . "SES_SESSION SES";
    $requete .= " WHERE SES.ID_USER = USC.ID_USER ";
    $requete .= " AND USC.ID_USER <> " . $id_user . " ";
    $requete .= " AND USC.ID_CONFERENCE = " . $id_conf ;
    $requete .= " AND USC.USC_ACTIVE = 1 "; // 
    $requete .= " AND (SES.SES_STATUS = 1 or SES.SES_STATUS = 2 or SES.SES_STATUS = 3 or SES.SES_STATUS = 4) ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-65a]", $requete);
    if ( mysql_num_rows($result) > 0 )
    {
      while( list ($id_u_2) = mysql_fetch_row ($result) )
      {
        $requete2 = "INSERT INTO " . $PREFIX_IM_TABLE . "MSG_MESSAGE ( ID_USER_AUT, ID_USER_DEST, MSG_TEXT, MSG_CR, MSG_TIME, MSG_DATE, ID_CONFERENCE) ";
        $requete2 .= "VALUES (" . $id_user . ", " . $id_u_2 . ", '" . $msg_cr . "', '" . $cr . "', CURTIME(), CURDATE(), " . $id_conf . " ) ";
        $result2 = mysql_query($requete2);
        if (!$result2) error_sql_log("[ERR-65b]", $requete2);
      }
    }
    //
    // On supprime sa participation à la conférence.
    $requete  = " DELETE FROM " . $PREFIX_IM_TABLE . "USC_USERCONF ";
    $requete .= " WHERE ID_CONFERENCE = " . $id_conf . " ";
    $requete .= " AND ID_USER = " . $id_user . " ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-65c]", $requete);
    //
    // on vérifie s'il reste des participants
    $requete  = " select ID_USER ";
    $requete .= " FROM " . $PREFIX_IM_TABLE . "USC_USERCONF ";
    $requete .= " WHERE ID_CONFERENCE = " . $id_conf . " ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-65d]", $requete);
    if ( mysql_num_rows($result) <= 0 )
    {
      // Dans le cas contraire, on supprime les messages et la conférence elle-même.
      $requete  = " DELETE FROM " . $PREFIX_IM_TABLE . "MSG_MESSAGE ";
      $requete .= " where ID_CONFERENCE = " . $id_conf ;
      $result = mysql_query($requete);
      if (!$result) error_sql_log("[ERR-65e]", $requete);
      //
      $requete  = " DELETE FROM " . $PREFIX_IM_TABLE . "CNF_CONFERENCE ";
      $requete .= " WHERE ID_CONFERENCE = " . $id_conf . " ";
      $result = mysql_query($requete);
      if (!$result) error_sql_log("[ERR-65f]", $requete);
    }
  }
  //
  mysql_close($id_connect);
}
?>