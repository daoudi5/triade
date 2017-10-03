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

define("_EXTERNAL_AUTHENTICATION_NAME", "Etano");

function f_external_authentication($t_user, $t_pass)
{
  $t_verif_pass = "Ko";
  $try_to_hack = "";
  $passcr = md5($t_pass);
  //
  $t_user = trim($t_user);
  if ( ($t_user != "") and ($passcr != "") )
  {
    //
    require("../common/config/extern.config.inc.php");
    if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
    {
      // Si Etano n'est pas sur le même serveur ou la même base de donnée.
      mysql_close();
      require("extern.sql.inc.php");
    }
    //
    // ---- Admin ----
    //
    $requete  = " select LOWER(user), pass FROM " . $extern_prefix . "admin_accounts ";
    $requete .= " WHERE LOWER(user) = '" . $t_user . "' ";
    $requete .= " and status = 15 ";
    //$requete .= " and dept_id = 4 ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-T154a]", $requete);
    if ( mysql_num_rows($result) == 1 )
    {
      list ($nom_extern, $pass_extern) = mysql_fetch_row ($result);
      if ($nom_extern == $t_user)
      {
        if ($pass_extern == $passcr) 
          $t_verif_pass = "OK";
        else
          $try_to_hack = "!!!";
      }
    }
    //
    if ($try_to_hack == "")
    {
      //
      // ---- Customers ----
      //
      $requete  = " select LOWER(user), pass passwd FROM " . $extern_prefix . "user_accounts ";
      $requete .= " WHERE LOWER(user) = '" . $t_user . "' ";
      $requete .= " and status > 10 ";
      //$requete .= " and membership = 2 ";
      //$requete .= " and temp_pass = '' ";
      $result = mysql_query($requete);
      if (!$result) error_sql_log("[ERR-T154b]", $requete);
      if ( mysql_num_rows($result) > 0 )
      {
        while( list ($nom_extern, $pass_extern) = mysql_fetch_row ($result) )
        {
          if ( ($nom_extern == $t_user) and ($pass_extern == $passcr) )
            $t_verif_pass = "OK";
          //
        }
      }
    }
    //
    if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
    {
      mysql_close($id_connect_extern);
      require("sql.2.inc.php");
    }
  }
  //
  return $t_verif_pass;
}
?>