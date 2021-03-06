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
if ( (!isset($_GET['iu'])) or (!isset($_GET['s'])) or (!isset($_GET['c'])) or (!isset($_GET['ip'])) ) die();
//
$id_user =		intval(f_decode64_wd($_GET['iu'])); 
$id_user = 		(intval($id_user) - intval($action));
$id_session = intval(f_decode64_wd($_GET['s']));
$contact =    f_decode64_wd($_GET['c']);
$ip = 			  f_decode64_wd($_GET['ip']);
$contact =    f_clean_username($contact);
//
if (preg_match("#[^0-9]#", $id_user)) $id_user = "";
if (preg_match("#[^0-9]#", $id_session)) $id_session = "";
//
if ( ($id_user > 0) and ($id_session > 0) and ($contact <> "") and ($ip != "") )
{
  require ("../common/acces.inc.php");
  f_verif_ip($ip);
  //
  require ("../common/sql.inc.php");
  require ("../common/sessions.inc.php");
  //
  if (function_exists('mysql_real_escape_string'))  $contact = mysql_real_escape_string($contact);
  //
  if (f_verif_id_session_id_user($id_user, $id_session) <> 'OK')
    die ("Session KO.");
  //
  $requete  = " select ID_USER, USR_USERNAME, USR_NICKNAME, USR_NAME, USR_COUNTRY_CODE, USR_LANGUAGE_CODE ";
  //$requete .= " USR_AVATAR, USR_TIME_SHIFT, USR_EMAIL, USR_PHONE, USR_GENDER ";
  $requete .= " FROM " . $PREFIX_IM_TABLE . "USR_USER ";
  $requete .= " WHERE ID_USER <> " . $id_user . " ";
  $requete .= " and ( (USR_CHECK <> 'WAIT' and USR_CHECK <> '') or USR_STATUS = 1 )  "; // ne pouvoir afficher dans ses contacts que des users valid�s.
  $requete .= " and USR_NAME <> 'HIDDEN' "; // ne pas afficher les contacts masqu�s : pour ajout dans les contacts.
  if (_USER_HIEARCHIC_MANAGEMENT_BY_ADMIN != "") // v�rification si niveau <=
  {
    $requete .= " and USR_LEVEL >= " . f_level_of_user($id_user);
  }
  $requete .= " and ( LOWER(USR_USERNAME) like '%" . $contact . "%' or LOWER(USR_NAME) like '%" . $contact . "%' or LOWER(USR_EMAIL) like '" . $contact . "%' ) ";
  $requete .= " ORDER BY USR_USERNAME";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-40a]", $requete);
  if ( mysql_num_rows($result) > 0 )
  {
    echo ">F16#OK####|";
    while( list ($id_user_2, $user_name, $nickname, $name, $country_code, $language_code) = mysql_fetch_row ($result) ) // $avatar, $timeshift, $email, $phone, $gender
    {
      if ( ($nickname != '') and (_ALLOW_UPPERCASE_SPACE_USERNAME != '') ) $user_name = $nickname;
      if (_DISPLAY_USER_FLAG_COUNTRY == "") $country_code = "";
      if ($name == 'HIDDEN')	$name = '';
      //
      // on renvoi seulement ceux qui ne sont pas dans ses contacts
      if (  ( f_is_deja_in_contacts_id($id_user, $id_user_2) <= 0 ) and ( f_is_deja_in_contacts_id($id_user_2, $id_user) <= 0 )  )
      {
        $msg = "#" . $id_user_2 . "#" . $user_name . "#" . $name . "#" . $language_code . "#";
        $msg = f_encode64($msg);
        echo $msg . "|"; // s�parateur de ligne : '|' (pipe).
      }
    }
  }
  else
  {
    // renvoie : aucun contact 'disponible'
    echo ">F16#-#-###|";
  }
  //
  mysql_close($id_connect);
}
?>