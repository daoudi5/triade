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
if ( (!isset($_GET['iu'])) or (!isset($_GET['s'])) or (!isset($_GET['ig'])) or (!isset($_GET['ip'])) or (!isset($_GET['c'])) or (!isset($_GET['v'])) ) die();
if (strlen($_GET['v']) > 3) die();
//
$id_user =	    intval(f_decode64_wd($_GET['iu']));
$id_user = 		  (intval($id_user) - intval($action));
$id_grp =	      intval(f_decode64_wd($_GET['ig']));
$id_session =   intval(f_decode64_wd($_GET['s']));
$ip = 			    f_decode64_wd($_GET['ip']);
$check = 		    f_decode64_wd($_GET['c']);
$check = 		    trim($check);
$version =      intval($_GET['v']);
//
if (preg_match("#[^0-9]#", $id_user)) $id_user = "";
if (preg_match("#[^0-9]#", $id_grp)) $id_grp = "";
if (preg_match("#[^0-9]#", $id_session)) $id_session = "";
//
if ( ($id_user > 0) and ($id_grp > 0) and ($id_session > 0) and ($check != "") and ($ip != "") )
{
  if ( ( _SPECIAL_MODE_GROUP_COMMUNITY != '' ) xor ( _GROUP_FOR_SBX_AND_ADMIN_MSG != '') )
  {
    require ("../common/acces.inc.php");
    f_verif_ip($ip);
    //
    require ("../common/sql.inc.php");
    require ("../common/sessions.inc.php");
    //
    if (f_verif_id_session_id_user($id_user, $id_session) <> 'OK')
      die (">F92#KO#Session KO.#");
    //
    //
    $requete  = " SELECT GRP.GRP_PRIVATE ";
    $requete .= " FROM " . $PREFIX_IM_TABLE . "GRP_GROUP GRP, " . $PREFIX_IM_TABLE . "USG_USERGRP USG ";
    $requete .= " WHERE USG.ID_GROUP = GRP.ID_GROUP ";
    $requete .= " and GRP.ID_GROUP = " . $id_grp;
    $requete .= " and USG.ID_USER = " . $id_user;
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-122a]", $requete);
    if ( mysql_num_rows($result) == 1 )
    {
      list ($grp_private) = mysql_fetch_row ($result);
      //
      if (intval($grp_private) > 0)
      {
        $requete  = " UPDATE " . $PREFIX_IM_TABLE . "USG_USERGRP ";
        $requete .= " set USG_PENDING = -1 ";
        $requete .= " where ID_GROUP = " . $id_grp;
        $requete .= " and ID_USER = " . $id_user;
        $requete .= " and USG_PENDING > -2 "; // -2 : on ne peut pas se d�sincrire //  +2 : on ne peut pas s'y inscrire  (mais dans les 2 cas, on l'a demand�).
        $requete .= " limit 1";
        $result = mysql_query($requete);
        if (!$result) error_sql_log("[ERR-122b]", $requete);
      }
      else
      {
        $requete  = " DELETE from " . $PREFIX_IM_TABLE . "USG_USERGRP ";
        $requete .= " where ID_GROUP = " . $id_grp;
        $requete .= " and ID_USER = " . $id_user;
        $requete .= " and USG_PENDING > -2 "; // -2 : on ne peut pas se d�sincrire //  +2 : on ne peut pas s'y inscrire  (mais dans les 2 cas, on l'a demand�).
        $requete .= " limit 1";
        $result = mysql_query($requete);
        if (!$result) error_sql_log("[ERR-122c]", $requete);
      }
      //
      echo ">F92#OK#" . $grp_private . "##"; 
      //
      update_last_activity_user($id_user);
    }
    //
    mysql_close($id_connect);
  }
  else
    die(">F92#KO#2#"); // 2: Not allowed (option not activated)
}
?>