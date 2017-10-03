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
if ( !defined('INTRAMESSENGER') )
{
  exit;
}
//
if ( (!isset($_GET['u'])) or (!isset($_GET['iu'])) or (!isset($_GET['s'])) or (!isset($_GET['ip'])) or (!isset($_GET['v'])) or (!isset($_GET['c'])) ) die();
//
$id_user =	  intval(f_decode64_wd($_GET['iu']));
$id_user = 		(intval($id_user) - intval($action));
$id_session = intval(f_decode64_wd($_GET['s']));
$ip = 			  f_decode64_wd($_GET['ip']);
$check = 			f_decode64_wd($_GET['c']);
$version =	  intval($_GET['v']);
$username = 	f_decode64_wd($_GET['u']);
$username =   f_clean_username($username);
$check =      Trim($check);
//
if (preg_match("#[^0-9]#", $id_user)) $id_user = "";
if (preg_match("#[^0-9]#", $id_session)) $id_session = "";
//
//if ( (_AUTHENTICATION_ON_OPENGOO != '') and ($id_user > 0) and ($id_session > 0) and ($check != "") and ($ip != "") )
if ( (_EXTERNAL_AUTHENTICATION == "opengoo") and ($id_user > 0) and ($id_session > 0) and ($check != "") and ($ip != "") )
{
  require ("../common/acces.inc.php");
  f_verif_ip($ip);
  //
  require ("../common/sessions.inc.php");
  require ("../common/sql.inc.php");
  //
  if (f_verif_id_session_id_user($id_user, $id_session) != 'OK')
  {
    die("KO#1#"); // la session est déjà fermée (de celui qui consulte, donc presque impossible).
  }
  if (f_verif_check_user_only($id_user, $check) != 'OK')
  {
    write_log("error_check_get_msg", $id_u_1 . "   " . $check);
    die("KO#10#"); 
  }
  //
  //
  function DisplayTime($hr, $gmt, $dec) 
  {
    $hor = explode ('.', $hr);
    return date("H:i",mktime($hor[0] + strval($gmt) + strval($dec),($hor[1] / 100 * 60)%60,0,1,1,2000)); 
  }
  //
  //
  $idUserOpenGoo = 0;
  require("../common/config/extern/opengoo.config.inc.php");
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    // If OpenGoo not on same server/database
    mysql_close($id_connect);
    require("../common/extern/extern.sql.inc.php");
  }
  $requete  = " select id, username, company_id, timezone  FROM " . $extern_prefix . "users ";
  $requete .= " WHERE LOWER(username) = '" . $username . "' ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-S2a]", $requete);
  if ( mysql_num_rows($result) == 1 )
  {
    list ($idUserOpenGoo, $login_opengoo, $company_id, $gmt_user) = mysql_fetch_row ($result);
    if ($login_opengoo != $username) $idUserOpenGoo = 0;
  }
  //
  if (intval($idUserOpenGoo) > 0) // is user valid
  {
    //
    // TASK (T).
    //
    $requete  = " SELECT id, title, due_date ";
    $requete .= " FROM " . $extern_prefix . "project_tasks ";
    $requete .= " WHERE (assigned_to_user_id = " . $idUserOpenGoo . " or (assigned_to_user_id = 0 and assigned_to_company_id = " . $company_id . ") ) ";
    //$requete .= " and due_date = '" . date("Ymd") . "' ";
    $requete .= " and due_date = '" . date("Y-m-d") . "' ";
    $requete .= " and completed_by_id = 0 ";
    $requete .= " and trashed_by_id = 0 ";
    $requete .= " ORDER BY orders";
    $result = mysql_query($requete);
    if (!$result) 
      error_sql_log("[ERR-S2b]", $requete);
    else
    {
      if ( mysql_num_rows($result) > 0 )
      {
        while( list ($id, $title, $due_date) = mysql_fetch_row ($result) )
        {
          //$due_date = DisplayTime($due_date, $gmt_user, $dec);
          //
          echo ">F71#T#" . $id . "#" . f_encode64($title) . "#" . $due_date . "####" . "#|"; // séparateur de ligne : '|' (pipe).
        }
      }
      //else
        //echo("KO#7#");
    }
    //
    //
    // MILESTONES (M).
    //
    $requete  = " SELECT id, title, due_date ";
    $requete .= " FROM " . $extern_prefix . "project_milestones ";
    $requete .= " WHERE (assigned_to_user_id = " . $idUserOpenGoo . " or (assigned_to_user_id = 0 and assigned_to_company_id = " . $company_id . ") ) ";
    //$requete .= " and due_date = '" . date("Ymd") . "' ";
    $requete .= " and due_date = '" . date("Y-m-d") . "' ";
    $requete .= " and completed_by_id = 0 ";
    $requete .= " and trashed_by_id = 0 ";
    $requete .= " ORDER BY orders";
    $result = mysql_query($requete);
    if (!$result) 
      error_sql_log("[ERR-S2d]", $requete);
    else
    {
      if ( mysql_num_rows($result) > 0 )
      {
        while( list ($id, $title, $due_date) = mysql_fetch_row ($result) )
        {
          //$due_date = DisplayTime($due_date, $gmt_user, $dec);
          //
          echo ">F71#M#" . $id . "#" . f_encode64($title) . "#" . $due_date . "####" . "#|"; // séparateur de ligne : '|' (pipe).
        }
      }
      //else
        //echo("KO#7#");
    }
    //
    //
    // EVENTS (E).
    //
    $requete  = " SELECT id, subject, start, duration, repeat_num, repeat_d, repeat_m, repeat_y, repeat_h ";
    $requete .= " FROM " . $extern_prefix . "project_events EVN, " . $extern_prefix . "event_invitations INV ";
    $requete .= " WHERE EVN.id = INV.event_id ";
    $requete .= " and INV.user_id = " . $idUserOpenGoo;
    //$requete .= " and start = '" . date("Ymd") . "' ";
    $requete .= " and start = '" . date("Y-m-d") . "' ";
    //$requete .= " and duration   ";
    //$requete .= " ORDER BY ";
    $result = mysql_query($requete);
    if (!$result) 
      error_sql_log("[ERR-S2c]", $requete);
    else
    {
      if ( mysql_num_rows($result) > 0 )
      {
        while( list ($id, $subject, $start) = mysql_fetch_row ($result) )
        {
          //$due_date = DisplayTime($due_date, $gmt_user, $dec);
          //
          echo ">F71#E#" . $id . "#" . f_encode64($subject) . "#" . $start . "####" . "#|"; // séparateur de ligne : '|' (pipe).
        }
      }
      //else
        //echo("KO#7#");
    }
  }
  else
    die("KO#5#"); // user not find
  }
  //
  mysql_close($id_connect);
}
else
  echo("KO#6#"); // user not find
?>