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

define("_EXTERNAL_AUTHENTICATION_NAME", "SMF");

function f_external_authentication($t_user, $t_pass)
{
  $t_verif_pass = "Ko";
  $passcr = sha1(strtolower($t_user) . $t_pass);
  //
  require("../common/config/extern.config.inc.php");
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    // Si Simple Machines Forum n'est pas sur le même serveur ou la même base de donnée.
    mysql_close();
    require("extern.sql.inc.php");
  }
  //
  // SMF VERSION 1 :
  //$requete  = " select LOWER(memberName), passwd, passwordSalt FROM " . $extern_prefix . "members ";
  //$requete .= " WHERE LOWER(memberName) = '" . $t_user . "' ";
  // SMF VERSION 2 :
  $requete  = " select LOWER(member_name), passwd, password_salt FROM " . $extern_prefix . "members ";
  $requete .= " WHERE LOWER(member_name) = '" . $t_user . "' ";
  //
  $requete .= " and is_activated > 0 ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-T11c]", $requete);
  if ( mysql_num_rows($result) == 1 )
  {
    list ($login_extern, $pass_extern) = mysql_fetch_row ($result);
    if ( ($login_extern == $t_user) and ($pass_extern == $passcr) )
      $t_verif_pass = "OK";
    //
  }
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    mysql_close($id_connect_extern);
    require("sql.2.inc.php");
  }
  //
  return $t_verif_pass;
}


function f_extern_nb_unread_pm($t_user)
{
  $nb_pm = 0;
  require("../common/config/extern.config.inc.php");
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    // Si smf n'est pas sur le même serveur ou la même base de donnée.
    mysql_close();
    require("extern.sql.inc.php");
  }
  //
  //  SMF VERSION 1 :
  //$requete  = " select LOWER(memberName), unreadMessages FROM " . $extern_prefix . "members ";
  //$requete .= " WHERE LOWER(memberName) = '" . $t_user . "' ";
  //  SMF VERSION 2 :
  $requete  = " select LOWER(member_name), new_pm FROM " . $extern_prefix . "members ";
  $requete .= " WHERE LOWER(member_name) = '" . $t_user . "' ";
  //
  //$requete .= " and is_activated > 0 ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-T11d]", $requete);
  if ( mysql_num_rows($result) == 1 )
  {
    list ($login_extern, $nb_pm) = mysql_fetch_row ($result);
    if ($login_extern != $t_user) $nb_pm = 0;
    //
  }
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    mysql_close($id_connect_extern);
    require("sql.2.inc.php");
  }
  //
  return $nb_pm;
}
?>