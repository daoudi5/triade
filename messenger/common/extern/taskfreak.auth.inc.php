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

define("_EXTERNAL_AUTHENTICATION_NAME", "TaskFreak");

function f_external_authentication($t_user, $t_pass)
{
  $t_verif_pass = "Ko";
  $passcr = md5($t_pass);   // if TZN_USER_PASS_MODE = 4 (see /include/config.php)
  //
  require("../common/config/extern.config.inc.php");
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    // Si TaskFreak n'est pas sur le même serveur ou la même base de donnée.
    mysql_close();
    require("extern.sql.inc.php");
  }
   //
  #$requete  = " select LOWER(name), password FROM " . $extern_prefix . "_member ";
  #$requete .= " WHERE LOWER(name) = '" . $t_user . "' ";
  $requete  = " select LOWER(username), password FROM " . $extern_prefix . "_member ";
  $requete .= " WHERE LOWER(username) = '" . $t_user . "' ";
  $requete .= " and enabled > 0 ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-T13a]", $requete);
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


function f_extern_name_of_user($t_user)
{
  $family_and_first_name = "";
  //
  require("../common/config/extern.config.inc.php");
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    // Si TaskFreak n'est pas sur le même serveur ou la même base de donnée.
    mysql_close();
    require("extern.sql.inc.php");
  }
   //
  $requete  = " select LOWER(username), lastName, firstName FROM " . $extern_prefix . "_member ";
  $requete .= " WHERE LOWER(username) = '" . $t_user . "' ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-T13b]", $requete);
  if ( mysql_num_rows($result) == 1 )
  {
    list ($login_extern, $extern_familyname, $extern_firstname) = mysql_fetch_row ($result);
    if ($login_extern == $t_user)
      $family_and_first_name = ucfirst(trim($extern_firstname)) . " " . strtoupper(trim($extern_familyname));
      //$family_and_first_name = trim($extern_firstname) . " " . trim($extern_familyname);
    //
  }
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    mysql_close($id_connect_extern);
    require("sql.2.inc.php");
  }
  //
  return $family_and_first_name;
}
?>
