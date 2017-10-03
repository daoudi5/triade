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

define("_EXTERNAL_AUTHENTICATION_NAME", "Freeway");

function f_external_authentication($t_user, $t_pass)
{
  $t_verif_pass = "Ko";
  $try_to_hack = "";
  //
  //
  require("../common/config/extern.config.inc.php");
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    // Si Freeway n'est pas sur le m�me serveur ou la m�me base de donn�e.
    mysql_close();
    require("extern.sql.inc.php");
  }
  //
  // ---- Admin ----
  //
  $requete  = " select LOWER(admin_email_address), admin_password FROM " . $extern_prefix . "employee ";
  $requete .= " WHERE LOWER(admin_email_address) = '" . $t_user . "' ";
  $requete .= " and admin_hide_backend = 'N' ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-T120a]", $requete);
  if ( mysql_num_rows($result) == 1 )
  {
    list ($login_extern, $pass_extern) = mysql_fetch_row ($result);
    if ($login_extern == $t_user)
    { 
      // $pass_extern contient le mot de pass cript� en md5 avec hash (md5(pass+hash) suivi apr�s ':' du hash.
      $tt = explode (':', $pass_extern);
      if ( ($tt[0] != '') and ($tt[1] != '') )
      {
        $passcr = md5($tt[1] . $t_pass);
        if ($tt[0] == $passcr) 
          $t_verif_pass = "OK";
        else
          $try_to_hack = "!!!";
      }
    } 
  }
  //
  if ($try_to_hack == "")
  {
    //
    // ---- Customers ----
    //
    $requete  = " select LOWER(customers_username), customers_password FROM " . $extern_prefix . "customers ";
    $requete .= " WHERE LOWER(customers_username) = '" . $t_user . "' ";
    $requete .= " and is_blocked = 'N' ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-T120b]", $requete);
    if ( mysql_num_rows($result) == 1 )
    {
      list ($login_extern, $pass_extern) = mysql_fetch_row ($result);
      if ($login_extern == $t_user)
      { 
        // $pass_extern contient le mot de pass cript� en md5 avec hash (md5(pass+hash) suivi apr�s ':' du hash.
        $tt = explode (':', $pass_extern);
        if ( ($tt[0] != '') and ($tt[1] != '') )
        {
          $passcr = md5($tt[1] . $t_pass);
          if ($tt[0] == $passcr) $t_verif_pass = "OK";
        }
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