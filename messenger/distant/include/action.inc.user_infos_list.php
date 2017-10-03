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
$id_user =	    intval(f_decode64_wd($_GET['iu']));
$id_user = 		  (intval($id_user) - intval($action));
$id_session =   intval(f_decode64_wd($_GET['s']));
$ip = 			    f_decode64_wd($_GET['ip']);
$version =	    intval($_GET['v']);
//
if (preg_match("#[^0-9]#", $id_user)) $id_user = "";
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
  $requete  = " select USR_USERNAME, USR_NICKNAME, USR_NAME, USR_PHONE, USR_EMAIL, USR_GENDER, USR_AVATAR, USR_COUNTRY_CODE, USR_LANGUAGE_CODE, USR_TIME_SHIFT, USR_GET_OFFLINE_MSG, USR_RATING ";
  $requete .= " FROM " . $PREFIX_IM_TABLE . "USR_USER ";
  $requete .= " WHERE ID_USER = " . $id_user . " ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-73a]", $requete);
  //
  if ( mysql_num_rows($result) == 1 )
  {
    list ($username, $nickname, $name, $usr_phone, $usr_email, $usr_gender, $avatar, $country_code, $language_code, $time_shift, $get_offline, $rating) = mysql_fetch_row ($result);
    //
    if ($avatar != "")
    {
      if (is_readable("avatar/" . $avatar) == false) 
        $avatar = "";
    }
    else
    {
      if (is_readable("avatar/" . $username . ".jpg"))
        $avatar = $username . ".jpg";
    }
    #if ( ($nickname != '') and (_ALLOW_UPPERCASE_SPACE_USERNAME != '') ) $username = $nickname;
    $name =       f_encode64($name);
    $usr_phone =  f_encode64($usr_phone);
    $usr_email =  f_encode64($usr_email);
    $avatar =     f_encode64($avatar);
    $rating =     f_encode64($rating);
    if (_ALLOW_USER_RATING == "") $rating = "";
    //
    //
    echo ">F66#OK#" . $name . "#" . $usr_phone . "#" . $usr_email . "#" . $usr_gender .  "#" . $avatar . "#" .  $country_code . "#" . $language_code . "#" . $time_shift . "#" . $rating . "#" . $get_offline . "####|";
  }
  else
  {
    echo ">F66#-#####";
  }
  mysql_close($id_connect);
}
?>