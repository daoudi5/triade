<?php
/*******************************************************
 **                  IntraMessenger - server          **
 **                                                   **
 **  Copyright:      (C) 2006 - 2013 THeUDS           **
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

define("_EXTERNAL_AUTHENTICATION_NAME", "eGroupWare");

function f_external_authentication($t_user, $t_pass)
{
  $t_verif_pass = "Ko";
  $passcr = md5($t_pass);
  //
  require("../common/config/extern.config.inc.php");
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    // Si eGroupWare n'est pas sur le m�me serveur ou la m�me base de donn�e.
    mysql_close();
    require("extern.sql.inc.php");
  }
  //
  $requete  = " select LOWER(account_lid), account_pwd FROM " . $extern_prefix . "egw_accounts ";
  $requete .= " WHERE LOWER(account_lid) = '" . $t_user . "' ";
  $requete .= " and account_type = 'u' ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-T9a]", $requete);
  if ( mysql_num_rows($result) == 1 )
  {
    list ($login_extern, $pass_extern) = mysql_fetch_row ($result);
    if ($login_extern == $t_user)
    {
      if ($pass_extern == $passcr) 
        $t_verif_pass = "OK";
      else
      {
        if (substr($pass_extern, 0, 7) == "{crypt}")
        {
          $pass_extern = substr($pass_extern, 7, strlen($pass_extern)-7);
          $t = strpos($pass_extern, "$", 4);
          if ($t > 1)
          {
            $salt = substr($pass_extern, 0, $t);
            if (crypt($t_pass, $salt) == $pass_extern) 
              $t_verif_pass = "OK";
          }
        }
      }
    }
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
?>