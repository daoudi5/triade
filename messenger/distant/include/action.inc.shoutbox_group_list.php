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
$id_user =	  f_decode64_wd($_GET['iu']);
$id_user = 		(intval($id_user) - intval($action));
$id_session = intval(f_decode64_wd($_GET['s']));
$ip = 			  f_decode64_wd($_GET['ip']);
$n_version =	intval($_GET['v']);
//
if (preg_match("#[^0-9]#", $id_user)) $id_user = "";
if (preg_match("#[^0-9]#", $n_version)) $n_version = "";
if (preg_match("#[^0-9]#", $id_session)) $id_session = "";
//
if ( ($id_user > 0) and ($id_session > 0) and ($n_version > 0) and ($ip != "") )
{
  if (_SHOUTBOX == "")
  {
    die(">F87#KO#2#"); // 2: Not allowed (option not activated)
  }
  if ( ( _SPECIAL_MODE_GROUP_COMMUNITY != '' ) xor ( _GROUP_FOR_SBX_AND_ADMIN_MSG != '') )
  {
    /*
    if ( ($id_user <> 1) and ($id_user <> 2) )
    {
      die(">F80#KO#3#"); // 3:n'a pas les droits (cannot send, allow only id_user...).
    }
    */
    //
    require ("../common/acces.inc.php");
    f_verif_ip($ip);
    //
    require ("../common/sql.inc.php");
    require ("../common/sessions.inc.php");
    //
    if (f_verif_id_session_id_user($id_user, $id_session) != 'OK') 
    {
      die(">F87#KO#1#"); // 1:session non ouverte.
    }
    //
    /*
    $requete  = " SELECT GRP.ID_GROUP, GRP.GRP_NAME, GRP.GRP_SBX_NEED_APPROVAL, GRP.GRP_PRIVATE "; // , count(SBX.ID_SHOUT) , max(SBX.ID_SHOUT)
    $requete .= " FROM " . $PREFIX_IM_TABLE . "GRP_GROUP GRP, " . $PREFIX_IM_TABLE . "USG_USERGRP USG, " . $PREFIX_IM_TABLE . "SBX_SHOUTBOX SBX ";
    $requete .= " WHERE USG.ID_GROUP = GRP.ID_GROUP ";
    $requete .= " and SBX.ID_GROUP_DEST = GRP.ID_GROUP ";
    */
    $requete  = " SELECT GRP.ID_GROUP, GRP.GRP_NAME, GRP.GRP_SBX_NEED_APPROVAL, GRP.GRP_PRIVATE "; // , count(SBX.ID_SHOUT) , max(SBX.ID_SHOUT)
    $requete .= " FROM " . $PREFIX_IM_TABLE . "GRP_GROUP GRP, " . $PREFIX_IM_TABLE . "USG_USERGRP USG ";
    $requete .= " WHERE USG.ID_GROUP = GRP.ID_GROUP ";
    $requete .= " and USG.ID_USER = " . $id_user;
    $requete .= " and GRP.GRP_SHOUTBOX > 0 ";
    $requete .= " GROUP BY ID_GROUP ";
    $requete .= " ORDER BY UPPER(GRP_NAME) ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-116a]", $requete);
    $nb_grp = mysql_num_rows($result);
    if ( $nb_grp > 0 )
    {
      echo ">F87#OK#" . $nb_grp . "###|";
      while( list ($id_group, $group_name, $sbx_need_approval, $grp_private) = mysql_fetch_row ($result) )
      {
        $msg = "#" . $id_group . "#" . $group_name . "#" . $sbx_need_approval . "#" . $grp_private . "###";
        $msg = f_encode64($msg);
        echo $msg . "|"; // séparateur de ligne : '|' (pipe).
      }
    }
    else
    {
      // renvoie : aucun groupe
      echo ">F87#-#B##";
    }
    //
    mysql_close($id_connect);
  }
  else
    die(">F87#KO#2#"); // 2: Not allowed (option not activated)
}
?>