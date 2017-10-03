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
$id_user =	  intval(f_decode64_wd($_GET['iu']));
$id_user = 		(intval($id_user) - intval($action));
$id_session = intval(f_decode64_wd($_GET['s']));
$last_id_m  = intval(f_decode64_wd($_GET['bi']));
$ip = 			  f_decode64_wd($_GET['ip']);
$n_version =	intval($_GET['v']);
if (isset($_GET['dtf'])) $dt_f = $_GET['dtf'];  else  $dt_f = "";  
if (isset($_GET['ig'])) $id_grp = intval($_GET['ig']);  else  $id_grp = "0";  
//
if (preg_match("#[^0-9]#", $id_grp)) $id_grp = "0";
if (preg_match("#[^0-9]#", $id_user)) $id_user = "";
if (preg_match("#[^0-9]#", $last_id_m)) $last_id_m = "";
if (preg_match("#[^0-9]#", $n_version)) $n_version = "";
if (preg_match("#[^0-9]#", $id_session)) $id_session = "";
//
if ( ($id_user > 0) and ($id_session > 0) and ($n_version > 0) and ($ip != "") )
{
  if (_SHOUTBOX == "")
  {
    die(">F80#KO#2#"); // 2: Not allowed (option not activated)
  }
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
  if (!ctype_alnum($dt_f))    $dt_f = "";  // après functions.inc.php !
  $dt_form = "d/m/Y"; // FR
  if ($dt_f == 'EN') $dt_form = "m-d-Y";
  //
  if (f_verif_id_session_id_user($id_user, $id_session) != 'OK') 
  {
    die(">F80#KO#1#"); // 1:session non ouverte.
  }
  //
  // $last_id_m  < 0 : juste récupérer le dernier ID.
  // $last_id_m == 0 : afficher la shoutbox.
  // $last_id_m  > 0 : n'afficher la shoutbox que si ya du nouveau.
  if ($last_id_m <> 0)
  {
    $requete  = " select max(ID_SHOUT)";
    $requete .= " FROM " . $PREFIX_IM_TABLE . "SBX_SHOUTBOX ";
    $requete .= " WHERE SBX_DISPLAY > 0 ";
    $requete .= " and ID_GROUP_DEST = " . $id_grp;
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-110a]", $requete);
    if ( mysql_num_rows($result) == 1 )
    {
      list ($id_max_msg) = mysql_fetch_row ($result);
      if ( ($id_max_msg > $last_id_m) and ($last_id_m > 0) )
        $last_id_m = 0; // pour afficher la liste
      else
        echo ">F80#-#A#" . $id_max_msg . "##";
    }
  }
  //
  if ($last_id_m == 0)
  {
    $requete  = " select SBX.ID_SHOUT, SBX.ID_GROUP_DEST, SBX.ID_USER_AUT, SBX.SBX_TIME, SBX.SBX_DATE, SBX.SBX_RATING, SBX.SBX_TEXT, sum(SBV.SBV_VOTE_M), sum(SBV.SBV_VOTE_L) "; // SBX_NB_VOTE_M
    $requete .= " FROM " . $PREFIX_IM_TABLE . "SBX_SHOUTBOX as SBX ";
    $requete .= " LEFT JOIN " . $PREFIX_IM_TABLE . "SBV_SHOUTVOTE as SBV ON ( SBX.ID_SHOUT = SBV.ID_SHOUT ) ";
    $requete .= " WHERE SBX.SBX_DISPLAY > 0 ";
    $requete .= " and SBX.ID_GROUP_DEST = " . $id_grp;
    //$requete .= " ORDER BY SBX_DATE, SBX_TIME ";
    $requete .= " GROUP BY SBX.ID_SHOUT ";
    $requete .= " ORDER BY SBX.ID_SHOUT DESC ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-110b]", $requete);
    $nb_lig = mysql_num_rows($result);
    if ( $nb_lig > 0 )
    {
      echo ">F80#OK#" . $nb_lig . "###|";
      while( list ($id_shout, $id_group_dest, $id_aut, $s_time, $s_date, $rating, $txt, $nb_vote_m, $nb_vote_l) = mysql_fetch_row ($result) )
      {
        $s_date = date($dt_form, strtotime($s_date));
        $username = f_get_username_of_id($id_aut);
        $msg = "#" . $id_shout . "#" . $id_group_dest . "#" . $id_aut . "#" . $username . "#" . $s_time . "#" . $s_date . "#" . $rating . "#" . f_decode64_wd($txt) . "#" . $nb_vote_m . "#" . $nb_vote_l . "#";
        $msg = f_encode64($msg);
        echo $msg . "|"; // séparateur de ligne : '|' (pipe).
      }
    }
    else
    {
      // renvoie : la shout est vide.
      echo ">F80#-#B##";
    }
  }
  //
  mysql_close($id_connect);
}
?>