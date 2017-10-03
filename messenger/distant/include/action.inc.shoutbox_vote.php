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
if ( (!isset($_GET['iu'])) or (!isset($_GET['s'])) or (!isset($_GET['is'])) or (!isset($_GET['r'])) or (!isset($_GET['ip'])) or (!isset($_GET['v'])) ) die();
//
$id_user =	  intval(f_decode64_wd($_GET['iu']));
$id_user = 		(intval($id_user) - intval($action));
$id_session = intval(f_decode64_wd($_GET['s']));
$id_shout =   intval(f_decode64_wd($_GET['is']));
$ip = 			  f_decode64_wd($_GET['ip']);
$n_version =	intval($_GET['v']);
$vote =       $_GET['r'];
if ($vote == "p") $vote = 1;
if ($vote == "c") $vote = -1;
//
if (preg_match("#[^0-9]#", $id_user)) $id_user = "";
if (preg_match("#[^0-9]#", $id_session)) $id_session = "";
if (preg_match("#[^0-9]#", $id_shout)) $id_shout = "";
//
if ( ($id_user > 0) and ($id_session > 0) and ($id_shout > 0) and ($n_version > 0) and (abs(intval($vote)) == 1) and ($ip != "") )
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
    die(">F85#KO#1#"); // 1:session non ouverte.
  }
  if ( (_SHOUTBOX_VOTE == "") or (_SHOUTBOX == "") )
  {
    die(">F85#KO#2#"); // 2:n'a pas les droits (option non activée).
  }
  /*
  if ( ($id_user <> 1) and ($id_user <> 2) )
  {
    die(">F85#KO#2#"); // 2:n'a pas les droits (cannot send, allow only id_user...).
  }
  */
  //
  $deja_vote = "";
  $requete  = " select (SBV_VOTE_M + SBV_VOTE_L) ";
  $requete .= " FROM " . $PREFIX_IM_TABLE . "SBV_SHOUTVOTE ";
  $requete .= " WHERE ID_SHOUT = " . $id_shout;
  $requete .= " and ID_USER_VOTE = " . $id_user;
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-115a]", $requete);
  if ( mysql_num_rows($result) == 1 )
  {
    list ($deja_vote) = mysql_fetch_row ($result);
    echo ">F85#KO#4#" . $deja_vote . "#";
  }
  //
  if ( (intval(_SHOUTBOX_MAX_NOTES_USER_DAY) > 0) and ($deja_vote == "") )
  {
    $requete  = " select count(*)";
    $requete .= " FROM " . $PREFIX_IM_TABLE . "SBV_SHOUTVOTE ";
    $requete .= " WHERE ID_USER_VOTE = " . $id_user;
    $requete .= " and SBV_DATE = CURDATE() ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-115b]", $requete);
    if ( mysql_num_rows($result) == 1 )
    {
      list ($nb_vote) = mysql_fetch_row ($result);
      if ($nb_vote > intval(_SHOUTBOX_MAX_NOTES_USER_DAY) )
      {
        echo ">F85#KO#3#" . $nb_vote . "#"; // over quota
        $deja_vote = "X";
      }
    }
  }
  //
  if ( (intval(_SHOUTBOX_MAX_NOTES_USER_WEEK) > 0) and ($deja_vote == "") )
  {
    $requete  = " select count(*)";
    $requete .= " FROM " . $PREFIX_IM_TABLE . "SBV_SHOUTVOTE ";
    $requete .= " WHERE ID_USER_VOTE = " . $id_user;
    $requete .= " and TIMESTAMPDIFF(WEEK, SBV_DATE, CURDATE() ) = 0 ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-115c]", $requete);
    if ( mysql_num_rows($result) == 1 )
    {
      list ($nb_vote) = mysql_fetch_row ($result);
      if ($nb_vote > intval(_SHOUTBOX_MAX_NOTES_USER_WEEK) )
      {
        echo ">F85#KO#3#" . $nb_vote . "#"; // over quota
        $deja_vote = "X";
      }
    }
  }
  //
  if ( (intval(_SHOUTBOX_REMOVE_MESSAGE_VOTES) > 0) and ($deja_vote == "") )
  {
    $requete  = " select count(*)";
    $requete .= " FROM " . $PREFIX_IM_TABLE . "SBV_SHOUTVOTE ";
    $requete .= " WHERE ID_SHOUT = " . $id_shout;
    $requete .= " and SBV_VOTE_L < 0 ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-115d]", $requete);
    if ( mysql_num_rows($result) == 1 )
    {
      list ($nb_vote_negatif) = mysql_fetch_row ($result);
      if ($nb_vote_negatif >= intval(_SHOUTBOX_REMOVE_MESSAGE_VOTES) )
      {
        $requete  = " DELETE FROM " . $PREFIX_IM_TABLE . "SBV_SHOUTVOTE ";
        $requete .= " WHERE ID_SHOUT = " . $id_shout;
        $result = mysql_query($requete);
        if (!$result) error_sql_log("[ERR-115e]", $requete);
        //
        $requete  = " DELETE FROM " . $PREFIX_IM_TABLE . "SBX_SHOUTBOX ";
        $requete .= " WHERE ID_SHOUT = " . $id_shout;
        $requete .= " LIMIT 1 "; // (to protect)
        $result = mysql_query($requete);
        if (!$result) error_sql_log("[ERR-115f]", $requete);
        //
        echo ">F85#KO#5#" . $nb_vote_negatif . "#"; // over quota
        $deja_vote = "X";
      }
    }
  }
  //
  if ($deja_vote == "")
  {
    // auteur du message
    $requete  = " select ID_USER_AUT";
    $requete .= " FROM " . $PREFIX_IM_TABLE . "SBX_SHOUTBOX ";
    $requete .= " WHERE ID_SHOUT = " . $id_shout;
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-115g]", $requete);
    if ( mysql_num_rows($result) == 1 )
    {
      list ($id_aut) = mysql_fetch_row ($result);
    }
    //
    $vote_p = 0;
    $vote_c = 0;
    if ($vote > 0) $vote_p = 1;
    if ($vote < 0) $vote_c = -1;
    //
    // On enregistre le vote
    $requete  = " INSERT INTO " . $PREFIX_IM_TABLE . "SBV_SHOUTVOTE ( ID_SHOUT, ID_USER_VOTE, ID_USER_AUT, SBV_VOTE_M, SBV_VOTE_L, SBV_DATE ) ";
    $requete .= " VALUES (" . $id_shout . ", " . $id_user . ", " . $id_aut . ", " . $vote_p  . ", " . $vote_c . ",  CURDATE() ) ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-115h]", $requete);
    //
    // On met à jour la moyenne (votes du messages)
    $requete  = " select sum(SBV_VOTE_M) + sum(SBV_VOTE_L)";
    $requete .= " FROM " . $PREFIX_IM_TABLE . "SBV_SHOUTVOTE ";
    $requete .= " WHERE ID_SHOUT = " . $id_shout;
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-115j]", $requete);
    if ( mysql_num_rows($result) == 1 )
    {
      list ($rating) = mysql_fetch_row ($result);
      //if ($rating <> 0)
      $requete  = " UPDATE " . $PREFIX_IM_TABLE . "SBX_SHOUTBOX ";
      $requete .= " set SBX_RATING = " . $rating;
      $requete .= " WHERE ID_SHOUT = " . $id_shout;
      $result = mysql_query($requete);
      if (!$result) error_sql_log("[ERR-115k]", $requete);
    }
    //
    //
    echo ">F85#OK##"; // vote bien enregistré (le faire APRES avoir actualisé la moyenne !).
    //
    //
    //
    stats_sbx_add_note_user($id_aut, $vote);
    //
    // Meilleurs scores
    stats_sbx_update_scores($id_shout, $id_aut);
  }
  //
  mysql_close($id_connect);
}
?>