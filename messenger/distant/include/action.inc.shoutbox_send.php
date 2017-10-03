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
if ( (!isset($_GET['iu'])) or (!isset($_GET['s'])) or (!isset($_GET['m'])) or (!isset($_GET['ip'])) or (!isset($_GET['v'])) ) die();
//
$id_user =	  intval(f_decode64_wd($_GET['iu']));
$id_user = 		(intval($id_user) - intval($action));
$id_session = intval(f_decode64_wd($_GET['s']));
$ip = 			  f_decode64_wd($_GET['ip']);
$n_version =	intval($_GET['v']);
$msg =        $_GET['m'];
if (isset($_GET['ig'])) $id_grp = intval($_GET['ig']);  else  $id_grp = "0";  
//
if (preg_match("#[^0-9]#", $id_grp)) $id_grp = "0";
if (preg_match("#[^0-9]#", $id_user)) $id_user = "0";
if (preg_match("#[^0-9]#", $n_version)) $n_version = "0";
if (preg_match("#[^0-9]#", $id_session)) $id_session = "0";
//
if ( ($id_user > 0) and ($id_session > 0) and ($n_version > 0) and ($msg != "") and ($ip != "") )
{
  require ("../common/acces.inc.php");
  f_verif_ip($ip);
  //
  require ("../common/sql.inc.php");
  require ("../common/sessions.inc.php");
  require ("../common/shoutbox.inc.php");
  //
  if (f_verif_id_session_id_user($id_user, $id_session) != 'OK') 
  {
    die(">F81#KO#1#"); // 1:session non ouverte.
  }
  if (_SHOUTBOX == "") // pour plus bas si par groupe.
  {
    die(">F81#KO#2#"); // 2: Not allowed (option not activated)  
  }
  /*
  if ( ($id_user <> 1) and ($id_user <> 2) )
  {
    die(">F81#KO#3#"); // 3:n'a pas les droits (cannot send, allow only id_user...).
  }
  */
  //
  if (intval(_SHOUTBOX_QUOTA_USER_DAY) > 0)
  {
    $requete  = " select SBS_NB_LAST_DATE";
    $requete .= " FROM " . $PREFIX_IM_TABLE . "SBS_SHOUTSTATS ";
    $requete .= " WHERE ID_USER_AUT = " . $id_user;
    $requete .= " and SBS_LAST_DATE = CURDATE() ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-111a]", $requete);
    if ( mysql_num_rows($result) == 1 )
    {
      list ($nb_today) = mysql_fetch_row ($result);
      if ($nb_today >= intval(_SHOUTBOX_QUOTA_USER_DAY) )
        die(">F81#KO#4#"); // 4: Over quota
    }
  }
  //
  if (intval(_SHOUTBOX_QUOTA_USER_WEEK) > 0)
  {
    $requete  = " select SBS_NB_LAST_WEEK";
    $requete .= " FROM " . $PREFIX_IM_TABLE . "SBS_SHOUTSTATS ";
    $requete .= " WHERE ID_USER_AUT = " . $id_user;
    $requete .= " and SBS_LAST_WEEK = WEEK(CURDATE()) ";
    $requete .= " and TIMESTAMPDIFF(WEEK, SBS_LAST_DATE, CURDATE() ) = 0 ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-111b]", $requete);
    if ( mysql_num_rows($result) == 1 )
    {
      list ($nb_week) = mysql_fetch_row ($result);
      if ($nb_week >= intval(_SHOUTBOX_QUOTA_USER_WEEK) )
        die(">F81#KO#4#"); // 4: Over quota
    }
  }
  //
  //
  $grp_shoutbox_allowed = 0;
  $grp_shoutbox_need_approval = 1;
  if ($id_grp > 0)
  {
    $requete  = " select GRP_SHOUTBOX, GRP_SBX_NEED_APPROVAL";
    $requete .= " FROM " . $PREFIX_IM_TABLE . "GRP_GROUP ";
    $requete .= " WHERE ID_GROUP = " . $id_grp;
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-111j]", $requete);
    if ( mysql_num_rows($result) == 1 )
    {
      list ($grp_shoutbox_allowed, $grp_shoutbox_need_approval) = mysql_fetch_row ($result);
    }
    if ($grp_shoutbox_allowed <= 0)  
    {
      die(">F81#KO#2#"); // 2: Not allowed (option not activated)
    }
  }
  //
  //
  $this_group_box_need_approval = ""; // que ce soit en groupe OU non.
  if (_SHOUTBOX_NEED_APPROVAL != "")
  {
    $this_group_box_need_approval = "X"; // default  = _SHOUTBOX_NEED_APPROVAL
    if ($grp_shoutbox_need_approval == 0) $this_group_box_need_approval = "";
    //
    if ($this_group_box_need_approval != "")
    {
      // si l'utilisateur a trop de messages en attente d'approbation (ex: tentative de SPAM).
      if (intval(_SHOUTBOX_APPROVAL_QUEUE_USER) > 0)
      {
        $requete  = " select count(*) ";
        $requete .= " FROM " . $PREFIX_IM_TABLE . "SBX_SHOUTBOX ";
        $requete .= " WHERE ID_USER_AUT = " . $id_user;
        $requete .= " and SBX_DISPLAY = 0 ";
        if ($id_grp > 0) $requete .= " and ID_GROUP_DEST = " . $id_grp;
        $result = mysql_query($requete);
        if (!$result) error_sql_log("[ERR-111c]", $requete);
        if ( mysql_num_rows($result) == 1 )
        {
          list ($nb_wait) = mysql_fetch_row ($result);
          if ($nb_wait >= intval(_SHOUTBOX_APPROVAL_QUEUE_USER) )
            die(">F81#KO#5#"); // 5: Approval queue Over quota
        }
      }
      // si trop de messages en attente d'approbation (en tout)
      if (intval(_SHOUTBOX_APPROVAL_QUEUE) > 0)
      {
        $requete  = " select count(*) ";
        $requete .= " FROM " . $PREFIX_IM_TABLE . "SBX_SHOUTBOX ";
        $requete .= " WHERE SBX_DISPLAY = 0 ";
        if ($id_grp > 0) $requete .= " and ID_GROUP_DEST = " . $id_grp;
        $result = mysql_query($requete);
        if (!$result) error_sql_log("[ERR-111d]", $requete);
        if ( mysql_num_rows($result) == 1 )
        {
          list ($nb_reject) = mysql_fetch_row ($result);
          if ($nb_reject >= intval(_SHOUTBOX_APPROVAL_QUEUE) )
            die(">F81#KO#5#"); // 5: Approval queue Over quota
        }
      }
    }
    //
    // Si trop de rejets
    if (intval(_SHOUTBOX_LOCK_USER_APPROVAL) > 0)
    {
      $requete  = " select SBS_NB_REJECT ";
      $requete .= " FROM " . $PREFIX_IM_TABLE . "SBS_SHOUTSTATS ";
      $requete .= " WHERE ID_USER_AUT = " . $id_user;
      $result = mysql_query($requete);
      if (!$result) error_sql_log("[ERR-111e]", $requete);
      if ( mysql_num_rows($result) == 1 )
      {
        list ($nb_reject) = mysql_fetch_row ($result);
        if ($nb_reject >= intval(_SHOUTBOX_LOCK_USER_APPROVAL) )
          die(">F81#KO#4#");  // 4: Over quota
      }
    }
  }
  //
  if (intval(_SHOUTBOX_LOCK_USER_VOTES) > 0)
  {
    $requete  = " select count(*)";
    $requete .= " FROM " . $PREFIX_IM_TABLE . "SBV_SHOUTVOTE ";
    $requete .= " WHERE ID_USER_AUT = " . $id_user;
    $requete .= " and SBV_VOTE_L < 0 ";
    ## $requete .= " and SBV_DATE = CURDATE() ";                                  // only today
    ## $requete .= " and TIMESTAMPDIFF(WEEK, SBV_DATE, CURDATE() ) = 0 ";         // only this week
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-111f]", $requete);
    if ( mysql_num_rows($result) == 1 )
    {
      list ($nb_vote_negatif) = mysql_fetch_row ($result);
      if ($nb_vote_negatif >= intval(_SHOUTBOX_LOCK_USER_VOTES) )
      {
        //
        die(">F81#KO#4#" . $nb_vote_negatif . "#"); // over quota
      }
    }
  }
  //
  $msg_clair = "";
  if ( (_CENSOR_MESSAGES != '') or (_LOG_MESSAGES != '') )
  {
    $msg_clair = f_decode64_wd($msg);
  }
  //
  // on censure les mots interdits par l'administrateur :
  if (_CENSOR_MESSAGES != '')
  {
    if (is_readable("../common/config/censure.txt"))
    {
      $msg_clair = trim($msg_clair);
      require ("../common/words_filtering.inc.php");
      $msg_clair = textCensure($msg_clair, "../common/config/censure.txt");
      $msg = f_encode64($msg_clair);
    }
  }
  //
  //
  $sending = "#";
  $requete  = "INSERT INTO " . $PREFIX_IM_TABLE . "SBX_SHOUTBOX ( ID_GROUP_DEST, ID_USER_AUT, SBX_TEXT, SBX_TIME, SBX_DATE, SBX_DISPLAY) ";
  $requete .= "VALUES (" . $id_grp . ", " . $id_user . ", '" . $msg . "', CURTIME(), CURDATE(), ";
  //if (_SHOUTBOX_NEED_APPROVAL != "")
  if ($this_group_box_need_approval != "")
    $requete .= "0 ) ";
  else
  {
    $requete .= "1 ) ";
    $sending = date("H:i:s") . "#"; 
  }
  //
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-111g]", $requete);
  //
  // message bien envoyé
  echo ">F81#OK#" . $sending . "#";
  //
  stats_sbx_inc($id_user);
  //
  //if ( (_SHOUTBOX_NEED_APPROVAL != "") and (_SEND_ADMIN_ALERT != "") )
  if ( ($this_group_box_need_approval != "") and (_SEND_ADMIN_ALERT != "") )
  {
    $send = "X";
    // Do not send admin notify, if already admin.
    $requete  = " SELECT USR_GET_ADMIN_ALERT ";
    $requete .= " FROM " . $PREFIX_IM_TABLE . "USR_USER ";
    $requete .= " WHERE ID_USER = " . $id_user . " ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-111h]", $requete);
    if ( mysql_num_rows($result) == 1 )
    {
      list ($get_admin_alert) = mysql_fetch_row ($result);
      if (intval($get_admin_alert) == 1) $send = "";
    }
    if ($send != "")
    {
      $txt = $l_index_shoutbox_pending;
      if ($txt == "") $txt = "Shoutbox message(s) waiting approbation...";
      send_alert_message_to_admins($txt);
    }
  }
  //
  // si option de log (archivage) des messages échangé activé :
  if (_LOG_MESSAGES != '')
  {
    // on récupère le username expéditeur :
    $username = f_get_username_of_id($id_user);
    //
    $ip = $_SERVER['REMOTE_ADDR'];	
    //
    $chemin = "log/" . "shoutbox_log.txt" ;
    $fp = fopen($chemin, "a");
    if (flock($fp, 2));
    {
      fputs($fp,date("d/m/Y;H:i:s") . ";" . $username . ";" . $msg_clair . ";" . $ip ."\r\n");
    }
    flock($fp, 3);
    fclose($fp);
  }
  //
  mysql_close($id_connect);
}
?>