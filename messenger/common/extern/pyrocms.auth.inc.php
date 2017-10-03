<?php
/*******************************************************
 **                  IntraMessenger - server          **
 **                                                   **
 **  Copyright:      (C) 2006 - 2012 THeUDS           **
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

define("_EXTERNAL_AUTHENTICATION_NAME", "PyroCMS");

function f_external_authentication($t_user, $t_pass)
{
  $t_verif_pass = "Ko";
  //
  require("../common/config/extern.config.inc.php");
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    // Si PyroCMS n'est pas sur le même serveur ou la même base de donnée.
    mysql_close();
    require("extern.sql.inc.php");
  }
  //
  $requete  = " select LOWER(username), password, salt FROM core_users ";
  $requete .= " WHERE LOWER(username) = '" . $t_user . "' ";
  $requete .= " AND active = 1 ";
  //
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-T147a]", $requete);
  if ( mysql_num_rows($result) == 1 )
  {
    list ($login_extern, $pass_extern, $salt) = mysql_fetch_row ($result);
    if ($login_extern == $t_user)
    { 
      $passcr = sha1($t_pass . $salt);
      //
      if ($passcr == $pass_extern)
        $t_verif_pass = "OK";
    }
  }
  else
  {
    $requete  = " select LOWER(username), password, salt FROM default_users ";
    $requete .= " WHERE LOWER(username) = '" . $t_user . "' ";
    $requete .= " AND active = 1 ";
    $requete .= " AND forgotten_password_code is null ";
    //$requete .= " AND group_id = 1 ";
    //
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-T147b]", $requete);
    if ( mysql_num_rows($result) == 1 )
    {
      list ($login_extern, $pass_extern, $salt) = mysql_fetch_row ($result);
      if ($login_extern == $t_user)
      { 
        $passcr = sha1($t_pass . $salt);
        //
        if ($passcr == $pass_extern)
          $t_verif_pass = "OK";
      }
    }
  }
  //
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    mysql_close($id_connect_extern);
    require("sql.2.inc.php");
  }
  //
  return $t_verif_pass;
}
?>