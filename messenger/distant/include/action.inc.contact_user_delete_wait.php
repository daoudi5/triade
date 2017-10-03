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
if ( (!isset($_GET['iu'])) or (!isset($_GET['s'])) or (!isset($_GET['ip'])) or (!isset($_GET['c'])) ) die();
//
$id_user =	    intval(f_decode64_wd($_GET['iu']));
$id_user = 		  (intval($id_user) - intval($action));
$id_session =   intval(f_decode64_wd($_GET['s']));
$ip = 			    f_decode64_wd($_GET['ip']);
$check = 		    f_decode64_wd($_GET['c']);
$check = 		    trim($check);
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
    die ("Session KO.");
  //
  if (f_verif_check_user_only($id_user, $check) == 'OK')
  {
    $requete  = " delete from " . $PREFIX_IM_TABLE . "CNT_CONTACT ";
    $requete .= " where ID_USER_1 = " . $id_user . " and CNT_STATUS = 0 ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-35a]", $requete);
    //
    // On fait aussi le ménage sur les contacts dont le user n'existe plus :
    $requete  = " select distinct(ID_USER_2) from " . $PREFIX_IM_TABLE . "CNT_CONTACT LEFT JOIN " . $PREFIX_IM_TABLE . "USR_USER ON " . $PREFIX_IM_TABLE . "CNT_CONTACT.ID_USER_2 = " . $PREFIX_IM_TABLE . "USR_USER.ID_USER ";
    $requete .= " where " . $PREFIX_IM_TABLE . "USR_USER.ID_USER IS NULL and " . $PREFIX_IM_TABLE . "CNT_CONTACT.ID_USER_1 = " . $id_user . " ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-35b]", $requete);
    if ( mysql_num_rows($result) > 0 )
    {
      while( list ($id_user_to_delete) = mysql_fetch_row ($result) )
      {
        $requete_2  = " delete from " . $PREFIX_IM_TABLE . "CNT_CONTACT ";
        $requete_2 .= " where ID_USER_1 = " . $id_user_to_delete . " or ID_USER_2 = " . $id_user_to_delete . " ";
        $result2 = mysql_query($requete_2);
        if (!$result2) error_sql_log("[ERR-35c]", $requete_2);
      }
    }
  }
  //
  mysql_close($id_connect);
}
?>