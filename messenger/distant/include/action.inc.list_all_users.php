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
  $requete  = " select SQL_CACHE ID_USER, USR_USERNAME, USR_NICKNAME, USR_NAME, USR_LEVEL, USR_COUNTRY_CODE, USR_LANGUAGE_CODE, ";
  $requete .= " USR_AVATAR, USR_TIME_SHIFT, USR_EMAIL, USR_PHONE, USR_GENDER, USR_RATING ";
  $requete .= " FROM " . $PREFIX_IM_TABLE . "USR_USER ";
  //$requete .= " WHERE ID_USER <> " . $id_user . " "; / pour SQL_CACHE (voir plus bas {1}).
  $requete .= " WHERE ( (USR_CHECK <> 'WAIT' and USR_CHECK <> '') or USR_STATUS = 1 )  "; // ne pouvoir afficher dans ses contacts que des users validés.
  $requete .= " and USR_NAME <> 'HIDDEN' "; // ne pas afficher les contacts masqués : pour ajout dans les contacts.
  //if (_USER_HIEARCHIC_MANAGEMENT_BY_ADMIN != "") // vérification si niveau <=
  //{
  //  $requete .= " and USR_LEVEL >= " . f_level_of_user($id_user);
  //}
  $requete .= " ORDER BY USR_USERNAME";
  //$requete .= " ORDER BY ID_USER";
  //
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-10a]", $requete);
  if ( mysql_num_rows($result) > 0 )
  {
    echo ">F18#OK####|";
    while( list ($id_user_2, $user_name, $nickname, $name, $level, $country_code, $language_code, $avatar, $timeshift, $email, $phone, $gender, $usr_rating) = mysql_fetch_row ($result) )
    {
      if ( ($nickname != '') and (_ALLOW_UPPERCASE_SPACE_USERNAME != '') ) $user_name = $nickname;
      if (_DISPLAY_USER_FLAG_COUNTRY == "") $country_code = "";
      if (_USER_HIEARCHIC_MANAGEMENT_BY_ADMIN == "")  echo $level = "";
      if (_ALLOW_USER_RATING == "") $usr_rating = ""; // 0
      //
      $ok = "";
      // on renvoi seulement ceux qui ne sont pas dans ses contacts
      if ($all == "not_in_contact_list")
      {
        if (  ($name != 'HIDDEN') and ( f_is_deja_in_contacts_id($id_user, $id_user_2) <= 0 ) and ( f_is_deja_in_contacts_id($id_user_2, $id_user) <= 0 )  ) $ok = "X";
      }
      else
        $ok = "X";
      //
      if ($id_user_2 == $id_user) $ok = ""; // pour SQL_CACHE (voir le where {1}).
      //
      if ($name == 'HIDDEN')	$name = '';
      if ($ok != "")
      {
        $msg  = $user_name . "#" . $id_user_2 . "#" . $name . "#" . $language_code . "#";
        if ($all != "not_in_contact_list") $msg .= $avatar . "#" . $timeshift . "#" . $email . "#" . $phone . "#" . $gender . "#" . $country_code . "#" . $level . "#" . $usr_rating . "#";
        $msg = f_send_param($msg);
        $msg = f_encode64($msg);
        echo $msg . "|"; // séparateur de ligne : '|' (pipe).
      }
    }
  }
  else
  {
    // renvoie : aucun contact 'disponible'
    echo ">F18#-#-#";
  }
  //
  mysql_close($id_connect);
}
?>