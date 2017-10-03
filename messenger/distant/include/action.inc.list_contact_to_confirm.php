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
if ( (!isset($_GET['iu'])) or (!isset($_GET['is'])) or (!isset($_GET['ip'])) or (!isset($_GET['v'])) ) die();
//
$id_user =	    intval(f_decode64_wd($_GET['iu']));
$id_user = 		  (intval($id_user) - intval($action));
$id_session =   intval(f_decode64_wd($_GET['is']));
$ip = 			    f_decode64_wd($_GET['ip']);
$version =	    intval($_GET['v']);
$status =       intval($_GET['st']);
if (isset($_GET['bi'])) $last_id_m = intval(f_decode64_wd($_GET['bi'])); else $last_id_m = "";
//
if (preg_match("#[^0-9]#", $id_user)) $id_user = "";
if (preg_match("#[^0-9]#", $last_id_m)) $last_id_m = "";
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
  if (f_verif_id_session_id_user($id_user, $id_session) <> 'OK')
    die ("Session KO.");
  //
  $nb_pm = -1;
  $id_max_shoutbox = -1;
  $id_grp_max_sbx = 0;
  $srv_list_status = "";
  if (_FULL_CHECK != "") // si coché
  {
    //
    //
    //
    // -------------------------------------------- FORUMS : COMPTER MESSAGES PRIVES (PM) -------------------------------------------- 
    //
    //
    //
    if (_EXTERNAL_AUTHENTICATION != "")
    {
      require ("../common/extern/extern.inc.php");
      $nb_pm = f_nb_unread_pm_extern($id_user);
    }
    //
    //
    //
    // -------------------------------------------- SHOUTBOX NOUVEAU MESSAGE ? -------------------------------------------- 
    //
    //
    if (_SHOUTBOX != "")
    {
      require ("../common/shoutbox.inc.php");
      $id_max_shoutbox = f_shoutbox_last_id_if_new($last_id_m);
      if ($id_max_shoutbox > 0) $id_grp_max_sbx = f_id_group_id_sbx($id_max_shoutbox);
    }
    //
    //
    //
    // -------------------------------------------- SERVERS STATUS LIST -------------------------------------------- 
    //
    //
    if (_SERVERS_STATUS != "")
    {
      $srv_list_status = f_servers_status();
    }
  }
  //
  //
  //
  echo ">F12#" . $nb_pm . "#" . $id_max_shoutbox . "#" . $id_grp_max_sbx . "#" . f_encode64($srv_list_status) . "###|"; // séparateur de ligne : '|' (pipe).
  //
  //
  //
  // -------------------------------------------- LISTER LES CONTACTS EN ATTENTE -------------------------------------------- 
  //
  //
  //
  $requete  = " select CNT.ID_CONTACT, USR.USR_USERNAME, USR.USR_NICKNAME, USR.USR_NAME, CNT.ID_USER_1, USR.USR_COUNTRY_CODE, CNT.CNT_NEW_USERNAME ";
  $requete .= " FROM " . $PREFIX_IM_TABLE . "CNT_CONTACT CNT, " . $PREFIX_IM_TABLE . "USR_USER USR ";
  $requete .= " WHERE USR.ID_USER = CNT.ID_USER_1 and CNT.ID_USER_2 = " . $id_user . " ";
  $requete .= " and CNT_STATUS = 0 ";
  $requete .= " ORDER BY USR_USERNAME ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-25a]", $requete);
  if ( mysql_num_rows($result) > 0 )
  {
    while( list ($id_contact, $contact, $nickname, $nom, $id_user1, $country, $msg) = mysql_fetch_row ($result) )
    {
      if ( ($nickname != '') and (_ALLOW_UPPERCASE_SPACE_USERNAME != '') ) $contact = $nickname;
      if ($nom == 'HIDDEN') $nom = '';
      //
      $nom =        f_encode64($nom);
      $contact =    f_encode64($contact);
      //
      // on renvoi les contacts du user
      echo ">F12#" . $id_contact . "#" . $contact . "#" . $nom . "#" . $id_user1 . "#" . $country . "#" . f_encode64($msg) . "#|"; // séparateur de ligne : '|' (pipe).
    }
  }
  else
  {
    // renvoie : aucun contact pour ce user
    echo ">F12#0#-#0#";
  }
  //
  //
  // update date of last use of user
  $requete  = " update " . $PREFIX_IM_TABLE . "USR_USER ";
  $requete .= " SET USR_DATE_LAST = CURDATE() ";
  $requete .= " where ID_USER = " . $id_user . " ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-25b]", $requete);
  //
  //
  // pour éviter que ceux qui ont perdu la connexion restent offline pour les autres (alors qu'ils ont l'impression d'être online).
  if ($status > 0)
  {
    $requete  = " update " . $PREFIX_IM_TABLE . "SES_SESSION ";
    $requete .= " SET SES_STATUS = " . $status . " ";
    $requete .= " WHERE ID_SESSION = " . $id_session . " ";
    $requete .= " and ID_USER = " . $id_user ;
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-25c]", $requete);
  }
  //
  clean_inactives_session();
  //
  mysql_close($id_connect);
}
?>