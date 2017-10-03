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
if ( (!isset($_GET['iu'])) or (!isset($_GET['s'])) or (!isset($_GET['ip'])) or (!isset($_GET['v'])) or (!isset($_GET['av'])) ) die();
//
$id_user =	    intval(f_decode64_wd($_GET['iu']));
$id_user = 		  (intval($id_user) - intval($action));
$id_session =   intval(f_decode64_wd($_GET['s']));
$ip = 			    f_decode64_wd($_GET['ip']);
$version =	    intval($_GET['v']);
$avatar = 		  f_decode64_wd($_GET['av']);
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
  $ext = strtolower(substr($avatar,-5));
  if ( (strlen($avatar) <= 20) and ( (strpos($ext, ".png")) or (strpos($ext, ".gif")) or (strpos($ext, ".jpg")) or (strpos($ext, ".jpeg")) ) )
  {
    $requete  = " update " . $PREFIX_IM_TABLE . "USR_USER "; 
    $requete .= " set USR_AVATAR = '" . $avatar . "' ";
    $requete .= " WHERE ID_USER = " . $id_user . " ";
    $requete .= " LIMIT 1 "; // (to protect)
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-74a]", $requete);
    //
    echo ">F69#OK###";
  }
  else
    echo ">F69#KO##";
  //
  mysql_close($id_connect);
}
?>