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
if ( (!isset($_GET['iu'])) or (!isset($_GET['s'])) or (!isset($_GET['ip'])) or (!isset($_GET['v'])) or (!isset($_GET['n'])) or (!isset($_GET['p'])) or (!isset($_GET['e'])) or (!isset($_GET['g'])) ) die();
//
$id_user =	    intval(f_decode64_wd($_GET['iu']));
$id_user = 		  (intval($id_user) - intval($action));
$id_session =   intval(f_decode64_wd($_GET['s']));
$ip = 			    f_decode64_wd($_GET['ip']);
$version =	    intval($_GET['v']);
$name = 			  f_decode64_wd($_GET['n']);
$phone = 			  f_decode64_wd($_GET['p']);
$email = 			  f_decode64_wd($_GET['e']);
$gender =			  $_GET['g'];
if (isset($_GET['gof'])) $get_offline = intval($_GET['gof']);  else  $get_offline = -1;
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
  $email = trim(strtolower($email));
  $name  = f_clean_name($name);
  $gender= trim($gender);
  if (!preg_match('/^[-a-z0-9._@]+$/i', $email) ) $email = "";
  if (!preg_match('/^[+0-9.()]+$/i', $phone) ) $phone = "";
  //
  // on censure les mots interdits par l'administrateur :
  if (_CENSOR_MESSAGES != '')
  {
    if (is_readable("../common/censure.txt"))
    {
      require ("../common/words_filtering.inc.php");
      $email = textCensure($email, "../common/config/censure.txt");
      $name  = textCensure($name,  "../common/config/censure.txt");
    }
  }
  //
  if (_ALLOW_CHANGE_EMAIL_PHONE != "")
  {
    $requete  = " update " . $PREFIX_IM_TABLE . "USR_USER "; 
    $requete .= " set USR_PHONE = '" . $phone . "' , USR_EMAIL = '" . $email. "' , USR_GENDER = '" . $gender. "', USR_DATE_PASSWORD = CURDATE() ";
    $requete .= " WHERE ID_USER = " . $id_user . " ";
    $requete .= " LIMIT 1 "; // (to protect)
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-72a]", $requete);
  }
  if (_ALLOW_CHANGE_FUNCTION_NAME != "")
  {
    if ($name != "HIDDEN")
    {
      $requete  = " update " . $PREFIX_IM_TABLE . "USR_USER "; 
      $requete .= " set USR_NAME = '" . $name . "', USR_DATE_PASSWORD = CURDATE() ";
      $requete .= " WHERE ID_USER = " . $id_user . " ";
      $requete .= " LIMIT 1 "; // (to protect)
      $result = mysql_query($requete);
      if (!$result) error_sql_log("[ERR-72b]", $requete);
    }
  }
  
  if ( (_ALLOW_SEND_TO_OFFLINE_USER != "") and ($get_offline <> "") )
  {
    if ( ($get_offline == 0) or ($get_offline == 1) or ($get_offline == 2) )
    {
      $requete  = " update " . $PREFIX_IM_TABLE . "USR_USER "; 
      $requete .= " set USR_GET_OFFLINE_MSG = " . $get_offline . " ";
      $requete .= " WHERE ID_USER = " . $id_user . " ";
      $requete .= " LIMIT 1 "; // (to protect)
      $result = mysql_query($requete);
      if (!$result) error_sql_log("[ERR-72c]", $requete);
    }
  }
  //
  echo ">F67#OK####";
  //
  mysql_close($id_connect);
}
?>