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
if ( (!isset($_GET['u1'])) or (!isset($_GET['u2'])) or (!isset($_GET['s'])) or (!isset($_GET['ic'])) or (!isset($_GET['nc'])) or (!isset($_GET['ip'])) ) die();
//
$id_u_1 =	      intval(f_decode64_wd($_GET['u1']));
$id_u_1 = 		  (nb_vip($id_u_1) - intval($action));
$id_u_2 =		    intval(f_decode64_wd($_GET['u2']));
$id_session = 	intval(f_decode64_wd($_GET['s']));
$contact_id = 	intval(f_decode64_wd($_GET['ic']));
$pseudo = 			f_decode64_wd($_GET['nc']);
$ip = 			    f_decode64_wd($_GET['ip']);
$version = 			$_GET['v'];
$pseudo =       f_clean_name($pseudo);
//
if (preg_match("#[^0-9]#", $id_u_1)) $id_u_1 = "";
if (preg_match("#[^0-9]#", $id_u_2)) $id_u_2 = "";
if (preg_match("#[^0-9]#", $id_session)) $id_session = "";
if (preg_match("#[^0-9]#", $contact_id)) $contact_id = "";
//
if ( ($id_u_1 > 0) and ($id_u_2 > 0) and ($id_session > 0) and ($contact_id > 0) and ($ip != "") )
{
  require ("../common/acces.inc.php");
  f_verif_ip($ip);
  //
  if (_ALLOW_CHANGE_CONTACT_NICKNAME != '')
  {
    require ("../common/sql.inc.php");
    require ("../common/sessions.inc.php");
    //
    if (f_verif_id_session_id_user($id_u_1, $id_session) <> 'OK')
      die ("Session KO.");
    //
    if (strlen($pseudo) < 3) $pseudo = "";
    $username = f_get_username_of_id($id_u_2);
    if ($pseudo == $username) $pseudo = ""; // si identiques, plus nécessaire d'avoir un 2ème pseudo.
    //
    // Empêcher d'utiliser le même pseudo pour 2 contacts différents
    //
    if ($pseudo != "")
    {
      $requete  = " select CNT_NEW_USERNAME from " . $PREFIX_IM_TABLE . "CNT_CONTACT ";
      $requete .= " WHERE ID_CONTACT <> " . $contact_id . " ";
      $requete .= " and ID_USER_1 = " . $id_u_1 ;
      $requete .= " and CNT_NEW_USERNAME = '" . $pseudo . "' ";
      $result = mysql_query($requete);
      if (!$result) error_sql_log("[ERR-39a]", $requete);
      if ( mysql_num_rows($result) > 0 )
        die ("KO#1#");
      //
      $requete  = " select USR.USR_USERNAME from " . $PREFIX_IM_TABLE . "CNT_CONTACT CNT, " . $PREFIX_IM_TABLE . "USR_USER USR ";
      $requete .= " WHERE CNT.ID_USER_2 = USR.ID_USER ";
      $requete .= " and CNT.ID_CONTACT <> " . $contact_id . " ";
      $requete .= " and CNT.ID_USER_1 = " . $id_u_1 ;
      $requete .= " and USR.USR_USERNAME = '" . $pseudo . "' ";
      $result = mysql_query($requete);
      if (!$result) error_sql_log("[ERR-39b]", $requete);
      if ( mysql_num_rows($result) > 0 )
        die ("KO#2#");
      //
      $t = f_DelSpecialChar($pseudo);
      if (f_is_banned_user_ip_pc($t, "U"))
      {
        die ($l_start_username_forbid_by_admin);
      }
    }
    //
    //
    $requete  = " select CNT_STATUS from " . $PREFIX_IM_TABLE . "CNT_CONTACT ";
    $requete .= " WHERE ID_CONTACT = " . $contact_id ;
    $requete .= " and ID_USER_1 = " . $id_u_1 ; // (pour le cas ou)
    $requete .= " and ID_USER_2 = " . $id_u_2 ; // (pour le cas ou)
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-39c]", $requete);
    if ( mysql_num_rows($result) == 1 )
    {
      list ($priv) = mysql_fetch_row ($result);
      //
      $requete  = " update " . $PREFIX_IM_TABLE . "CNT_CONTACT "; 
      $requete .= " set CNT_NEW_USERNAME = '" . $pseudo . "' ";
      $requete .= " WHERE ID_CONTACT = " . $contact_id;
      $requete .= " LIMIT 1 "; // (to protect)
      $result = mysql_query($requete);
      if (!$result) error_sql_log("[ERR-39d]", $requete);
    }
    //
    mysql_close($id_connect);
  }
}
?>