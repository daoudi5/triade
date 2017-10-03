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

define("_EXTERNAL_AUTHENTICATION_NAME", "ATutor");

function f_external_authentication($t_user, $t_pass)
{
  $t_verif_pass = "Ko";
  $try_to_hack = "";
  $passcr = sha1($t_pass);
  //
  require("../common/config/extern.config.inc.php");
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    // Si atutor n'est pas sur le même serveur ou la même base de donnée.
    mysql_close();
    require("extern.sql.inc.php");
  }
  //
  $requete  = " select LOWER(login), password FROM " . $extern_prefix . "admins "; //
  $requete .= " WHERE LOWER(login) = '" . $t_user . "' ";
  $requete .= " and privileges > 0 ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-T125a]", $requete);
  if ( mysql_num_rows($result) == 1 )
  {
    list ($login_extern, $pass_extern) = mysql_fetch_row ($result);
    if ($login_extern == $t_user) 
    {
      if ($pass_extern == $passcr)
        $t_verif_pass = "OK";
      else
        $try_to_hack = "!!!";
    }
    //
  }
  //
  if ( ($try_to_hack == "") and ($t_verif_pass != "OK") )
  {
    $requete  = " select LOWER(login), password FROM " . $extern_prefix . "members "; // 
    $requete .= " WHERE LOWER(login) = '" . $t_user . "' ";
    $requete .= " and status > 0 ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-T125b]", $requete);
    if ( mysql_num_rows($result) == 1 )
    {
      list ($login_extern, $pass_extern) = mysql_fetch_row ($result);
      if ( ($login_extern == $t_user) and ($pass_extern == $passcr) )
        $t_verif_pass = "OK";
      //
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