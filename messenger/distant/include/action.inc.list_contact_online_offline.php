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
//
//						IDEM list_contact_online_only.php mais les offline aussi.
//						(donc liste des contacts du user, online ou non).
//
if ( !defined('INTRAMESSENGER') )
{
  exit;
}
//
if ( (!isset($_GET['iu'])) or (!isset($_GET['is'])) or (!isset($_GET['v'])) or (!isset($_GET['ip'])) ) die();
//if ( (strlen($_GET['iu']) > 8) or (strlen($_GET['is']) > 7) ) die();
//
$id_user =	  intval(f_decode64_wd($_GET['iu']));
$id_user = 		(intval($id_user) - intval($action));
$id_session = intval(f_decode64_wd($_GET['is']));
$version =    intval($_GET['v']);
$ip = 			  f_decode64_wd($_GET['ip']);
if (isset($_GET['bi'])) $last_id_m = intval(f_decode64_wd($_GET['bi'])); else $last_id_m = "";
//
//
if (preg_match("#[^0-9]#", $id_user)) $id_user = "";
if (preg_match("#[^0-9]#", $last_id_m)) $last_id_m = "";
if (preg_match("#[^0-9]#", $id_session)) $id_session = "";
//
if ( ($id_user > 0) and ($id_session > 0) and ($version > 18) and ($ip != "") )
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
  $nb_contact_waiting = 0;
  $nb_msg = 0;
  $if_conf_invit = "";
  $srv_list_status = "";
  if (_FULL_CHECK == "") // si PAS coché
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
    // -------------------------------------------- COMPTER LES CONTACTS EN ATTENTE -------------------------------------------- 
    //
    //
    //
    $requete  = " select count(CNT.ID_CONTACT) ";
    $requete .= " FROM " . $PREFIX_IM_TABLE . "CNT_CONTACT CNT, " . $PREFIX_IM_TABLE . "USR_USER USR ";
    $requete .= " WHERE USR.ID_USER = CNT.ID_USER_1 and CNT.ID_USER_2 = " . $id_user . " ";
    $requete .= " and CNT_STATUS = 0 ";
    $requete .= " ORDER BY USR_USERNAME ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-20a]", $requete);
    if ( mysql_num_rows($result) != 0 )
    {
      list ($nb_contact_waiting) = mysql_fetch_row ($result);
    }
    //
    //
    //
    // -------------------------------------------- SHOUTBOX NOUVEAU MESSAGE ? -------------------------------------------- 
    //
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
  // -------------------------------------------- COMPTER MESSAGES -------------------------------------------- 
  //
  //
  //
  $requete  = " SELECT COUNT(ID_MESSAGE) ";
  $requete .= " from " . $PREFIX_IM_TABLE . "MSG_MESSAGE ";
  $requete .= " where ID_USER_DEST = " . $id_user . " ";
  $requete .= " and ID_CONFERENCE = 0 ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-20b]", $requete);
  if ( mysql_num_rows($result) > 0  )
  {
    list ($nb_msg) = mysql_fetch_row ($result);
  }
  //
  if (intval($nb_msg) <= 0)
  {
    // Pas de message, mais peut être une invitation à une conférence...          (voir aussi msg_get.php !!!)
    if (_ALLOW_CONFERENCE != '')
    {
      $id_conf = 0;
      $requete  = " select CNF.ID_CONFERENCE, CNF.ID_USER ";
      $requete .= " FROM " . $PREFIX_IM_TABLE . "CNF_CONFERENCE CNF, " . $PREFIX_IM_TABLE . "USC_USERCONF USC ";
      $requete .= " WHERE CNF.ID_CONFERENCE = USC.ID_CONFERENCE ";
      $requete .= " and USC.ID_USER = " . $id_user . " ";
      $requete .= " AND USC_ACTIVE = 0 "; // en attente de validation
      $result = mysql_query($requete);
      if (!$result) error_sql_log("[ERR-20c]", $requete);
      if ( mysql_num_rows($result) == 1 ) // normalement pas plus...
      {
        list ($id_conf, $id_u_creat) = mysql_fetch_row ($result);
        if (intval($id_conf) > 0)
        {
          $u_creat = f_get_username_of_id($id_u_creat);
          $u_creat = f_encode64($u_creat);
          $if_conf_invit = "CONF#ADD#" . $id_conf . "#" . $u_creat . "###"; // pas de message, mais invitation à conférence par contre...
        }
      }
    }
  }
  //
  echo ">F16#" . $nb_pm . "#" . $nb_contact_waiting . "#" . $nb_msg . "#" . $if_conf_invit . "#" . $id_max_shoutbox . "#" . $id_grp_max_sbx . "#" . f_encode64($srv_list_status) . "##|";
  //
  //
  //
  // -------------------------------------------- LISTER LES CONTACTS -------------------------------------------- 
  //
  //
  //
  $hide_list = "#";
  if ( (_ALLOW_INVISIBLE != '') or (_SPECIAL_MODE_OPEN_COMMUNITY != "") ) // and (_SPECIAL_MODE_GROUP_COMMUNITY == '')
  {
    // on récupère la liste de ceux qui ne veulent pas de nous (l'état de privilège de l'auteur chez le contact destinataire) (list people dont want us).
    $requete  = " select CNT.ID_USER_1 ";
    $requete .= " FROM " . $PREFIX_IM_TABLE . "CNT_CONTACT CNT ";
    $requete .= " WHERE CNT.ID_USER_1 <> " . $id_user . " ";
    $requete .= " and CNT.ID_USER_2 = " . $id_user . " ";
    $requete .= " and (CNT.CNT_STATUS < 0 or CNT.CNT_STATUS = 5) ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-20d]", $requete);
    if ( mysql_num_rows($result) != 0 )
    {
      while( list ($usr_id) = mysql_fetch_row ($result) )
      {
        $hide_list .= $usr_id . "#";
      }
    }
  }
  //
  //
  // 1 - MODE NORMAL :
  if ( (_SPECIAL_MODE_OPEN_COMMUNITY == "") and (_SPECIAL_MODE_GROUP_COMMUNITY == '') )
  {
    $requete  = "select CNT.ID_CONTACT, SES.SES_STATUS, USR.ID_USER, SES.SES_AWAY_REASON, '' ";
    $requete .= "FROM " . $PREFIX_IM_TABLE . "CNT_CONTACT CNT, " . $PREFIX_IM_TABLE . "USR_USER USR ";
    $requete .= "LEFT JOIN " . $PREFIX_IM_TABLE . "SES_SESSION SES ON USR.ID_USER = SES.ID_USER ";
    $requete .= "WHERE CNT.ID_USER_2 = USR.ID_USER ";
    $requete .= "and CNT.ID_USER_1 = " . $id_user . " ";
    $requete .= "and CNT.ID_USER_2 <> " . $id_user . " ";
    $requete .= "and CNT.CNT_STATUS > 0 ";
    $requete .= "and CNT.CNT_STATUS < 5 ";
    $requete .= "ORDER BY CNT_USER_GROUP, SES_STATUS, USR_USERNAME ";
  }
  //
  //
  // 2 - MODE OpenCommunity :
  $reject_list = "#";
  if ( (_SPECIAL_MODE_OPEN_COMMUNITY != "")  and  (_SPECIAL_MODE_GROUP_COMMUNITY == '') )
  {
    // on récupère la liste de ceux qu'on ne veut pas (list people we dont want).
    $requete  = " select CNT.ID_USER_2 ";
    $requete .= " FROM " . $PREFIX_IM_TABLE . "CNT_CONTACT CNT ";
    $requete .= " WHERE CNT.ID_USER_1 = " . $id_user . " ";
    $requete .= " and CNT.ID_USER_2 <> " . $id_user . " ";
    $requete .= " and (CNT.CNT_STATUS < 0 or CNT.CNT_STATUS = 5) ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-20e]", $requete);
    if ( mysql_num_rows($result) != 0 )
    {
      while( list ($usr_id) = mysql_fetch_row ($result) )
      {
        $reject_list .= $usr_id . "#";
      }
    }
    //
    $requete  = " SELECT 0, SES.SES_STATUS, USR.ID_USER, SES.SES_AWAY_REASON, '' ";
    $requete .= " FROM " . $PREFIX_IM_TABLE . "USR_USER USR ";
    $requete .= " LEFT JOIN " . $PREFIX_IM_TABLE . "SES_SESSION SES ON USR.ID_USER = SES.ID_USER ";
    $requete .= " WHERE USR.ID_USER <> " . $id_user . " ";
    $requete .= " ORDER BY SES_STATUS DESC, USR_USERNAME ";
  }
  //
  // 3 - MODE GroupCommunity :
  if ( (_SPECIAL_MODE_GROUP_COMMUNITY != '')  and  (_SPECIAL_MODE_OPEN_COMMUNITY == '') )
  {
    $username = f_get_username_of_id($id_user);
    $requete  = " select DISTINCT 0, SES.SES_STATUS, USR.ID_USER, SES.SES_AWAY_REASON, GRP.GRP_NAME ";
    $requete .= " FROM " . $PREFIX_IM_TABLE . "USG_USERGRP USG1, " . $PREFIX_IM_TABLE . "USG_USERGRP USG2, " . $PREFIX_IM_TABLE . "GRP_GROUP GRP, " . $PREFIX_IM_TABLE . "USR_USER USR ";
    $requete .= " LEFT JOIN " . $PREFIX_IM_TABLE . "SES_SESSION SES ON USR.ID_USER = SES.ID_USER  ";
    $requete .= " WHERE USG1.ID_GROUP = USG2.ID_GROUP ";
    $requete .= " and USG1.ID_USER = USR.ID_USER ";
    $requete .= " and USG2.ID_GROUP = GRP.ID_GROUP ";
    $requete .= " AND USG2.ID_USER = " . $id_user . " ";
    $requete .= " AND USR.USR_USERNAME <> '" . $username . "' ";
    $requete .= " ORDER BY GRP_NAME, USR_USERNAME ";
    //if ($tri == 'etat')
    //  $requete .= " ORDER BY GRP_NAME, SES_STATUS, USR_USERNAME ";
    //else
  }
  //
  //
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-20f]", $requete);
  if ( mysql_num_rows($result) != 0 )
  {
    $nb_c_send = 0;
    while( list ($id_contact, $eta_num, $usr_id, $away_reason, $group) = mysql_fetch_row ($result) )
    {
      $ok = 'OK';
      if ( strlen($reject_list) > 1 )
      {
        if (strstr($reject_list, "#" . $usr_id . "#") != "" ) $ok = 'Ko';
      }
      if ( strlen($hide_list) > 1 )
      {
        if (strstr($hide_list, "#" . $usr_id . "#") != "" ) $ok = 'Ko';
      }
      //
      // si non masqué et non rejeté
      if ( $ok == 'OK')
      {
        // on renvoi les contacts du user (un par un)
        echo ">F16#" . f_encode64($id_contact . "#" . $eta_num . "#" . $usr_id  . "#" . $away_reason . "#" . $group . "#") . "|"; // séparateur de ligne : '|' (pipe).
        $nb_c_send += 1;
      }
    }
    //
    if ($nb_c_send < 1) // si aucun contact envoyé (car invisibles)
    {
      // renvoie : aucun contact pour ce user
      echo ">F16#0#-#0#";
    }
  }
  else
  {
    // renvoie : aucun contact pour ce user
    echo ">F16#0#-#0#";
  }
  //
  update_time_session_id_session($id_session);
  //
  mysql_close($id_connect);
}
?>