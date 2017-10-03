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
//if ( (strlen($_GET['iu']) > 8) or (strlen($_GET['is']) > 7) ) die();
//
$id_user =	  intval(f_decode64_wd($_GET['iu']));
$id_user = 		(intval($id_user) - intval($action));
$id_session = intval(f_decode64_wd($_GET['is']));
$ip = 			  f_decode64_wd($_GET['ip']);
$version =    intval($_GET['v']);
//
if (preg_match("#[^0-9]#", $id_user)) $id_user = "";
if (preg_match("#[^0-9]#", $id_session)) $id_session = "";
//
if ( ($id_user > 0) and ($id_session > 0) and ($version > 18) and ($ip != "") )
{
  require ("../common/acces.inc.php");
  f_verif_ip($ip);
  //
  require ("../common/sql.inc.php");
  require ("../common/sessions.inc.php");
  require ("../common/library/crwd.php");
  //
  if (f_verif_id_session_id_user($id_user, $id_session) <> 'OK')
    die ("Session KO.");
  //
  $requete  = " select USR.ID_USER, USR.USR_USERNAME, USR.USR_NICKNAME, USR.USR_NAME, USR.USR_LEVEL, USR.USR_COUNTRY_CODE, USR.USR_LANGUAGE_CODE, ";
  $requete .= " USR.USR_AVATAR, USR.USR_TIME_SHIFT, USR.USR_EMAIL, USR.USR_PHONE, USR.USR_GENDER, USR.USR_RATING, ";
  $requete .= " CNT.ID_CONTACT, CNT.CNT_STATUS, CNT.CNT_NEW_USERNAME, CNT.CNT_USER_GROUP ";
  $requete .= " FROM " . $PREFIX_IM_TABLE . "CNT_CONTACT CNT, " . $PREFIX_IM_TABLE . "USR_USER USR ";
  $requete .= " WHERE USR.ID_USER = CNT.ID_USER_2 ";
  $requete .= " and CNT.ID_USER_1 = " . $id_user . " ";
  //$requete .= " and CNT_STATUS > 0 ";
  //$requete .= " ORDER BY USR.ID_USER"; 
  $requete .= " ORDER BY USR.USR_USERNAME"; 
  //$requete .= " and ( (USR_CHECK <> 'WAIT' and USR_CHECK <> '') or USR_STATUS = 1 )  "; // ne pouvoir afficher dans ses contacts que des users validés.
  //
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[11a]", $requete);
  if ( mysql_num_rows($result) > 0 )
  {
    echo ">F19#OK####|";
    while( list ($id_user_2, $user_name, $nickname, $name, $level, $country_code, $language_code, $avatar, $timeshift, $email, $phone, $gender, $usr_rating,
    $id_contact, $status, $new_name, $group) = mysql_fetch_row ($result) )
    {
      if ( ($nickname != '') and (_ALLOW_UPPERCASE_SPACE_USERNAME != '') ) $user_name = $nickname;
      if (_DISPLAY_USER_FLAG_COUNTRY == "") $country_code = "";
      if (_USER_HIEARCHIC_MANAGEMENT_BY_ADMIN == "")  echo $level = "";
      if (_ALLOW_USER_RATING == "") $usr_rating = ""; // 0
      if ($name == 'HIDDEN')	$name = '';
      //
      $msg  = $user_name . "#" . $id_user_2 . "#" . $name . "#" . $language_code . "#" . $avatar . "#" . $timeshift . "#" . $email . "#" . $phone . "#";
      $msg .= $gender . "#" . $country_code . "#" . $level . "#" . $usr_rating  . "#" . $id_contact . "#" . $status . "#" . $new_name . "#" . $group . "#";
      $msg = f_send_param($msg);
      $msg = f_encode64($msg);
      echo $msg . "|"; // séparateur de ligne : '|' (pipe).
    }
  }
  else
  {
    // renvoie : aucun contact 'disponible'
    echo ">F19#-#-#";
  }
  //
  mysql_close($id_connect);
}
?>