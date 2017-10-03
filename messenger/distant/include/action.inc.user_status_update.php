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
// see also : list_contact_user_to_confirm.php
//
if ( !defined('INTRAMESSENGER') )
{
  exit;
}
//
if ( (!isset($_GET['u'])) or (!isset($_GET['s'])) or (!isset($_GET['st'])) or (!isset($_GET['ip'])) ) die();
//
$id_user =	  intval(f_decode64_wd($_GET['u']));
$id_user = 		(intval($id_user) - intval($action));
$id_session = intval(f_decode64_wd($_GET['s']));
$ip = 			  f_decode64_wd($_GET['ip']);
$status = 		intval($_GET['st']);
$version =    intval($_GET['v']);
$away =       intval($_GET['aw']);
//if (isset($_GET['aw'])) $away = intval($_GET['aw']);  else  $away = 0;
//$check = 		$_GET['check'];
//$check = 		trim($check);
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
  if ($status <> 2) $away = 0;
  //
  if (f_verif_id_session_id_user($id_user, $id_session) <> 'OK')
    die ("Session KO.");
  //
  $requete  = " update " . $PREFIX_IM_TABLE . "SES_SESSION ";
  $requete .= " SET SES_STATUS = " . $status . ", ";
  $requete .= " SES_AWAY_REASON = " . $away . " ";
  $requete .= " WHERE ID_SESSION = " . $id_session . " ";
  $requete .= " and ID_USER = " . $id_user ;
  $requete .= " LIMIT 1 "; // (to protect)
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-75a]", $requete);
  //
  // on vérifie si la modif à bien eu lieu
  $retour = 'KO'; // par défaut
  $requete  = " select ID_SESSION, SES_STATUS ";
  $requete .= " FROM " . $PREFIX_IM_TABLE . "SES_SESSION ";
  $requete .= " WHERE ID_USER = " . $id_user . " ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-75b]", $requete);
  if ( mysql_num_rows($result) == 1 ) // il ne doit y avoir qu'une seule ligne !
  {
    list ($session_id, $etat_num) = mysql_fetch_row ($result);
    if ( ($etat_num == $status) and ($session_id = $id_session) )
    {
      $retour = 'OK'; 
      update_time_session_id_session($id_session);
    }
  }
  if ($retour <> 'OK') 
  {
    close_session_id_user($id_user);
  }
  //
  echo ">F30#" . $retour . "#";
  //
  mysql_close($id_connect);
}
?>