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

define("_EXTERNAL_AUTHENTICATION_NAME", "ProjeQtOr");

function f_external_authentication($t_user, $t_pass)
{
  $t_verif_pass = "Ko";
  //$passcr = md5($t_pass);
  //
  require("../common/config/extern.config.inc.php");
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    // Si ProjeQtOr n'est pas sur le même serveur ou la même base de donnée.
    mysql_close();
    require("extern.sql.inc.php");
  }
   //
  $requete  = " select LOWER(name), password, crypto, salt FROM " . $extern_prefix . "resource ";
  $requete .= " WHERE LOWER(name) = '" . $t_user . "' ";
  $requete .= " and isUser = 1 ";
  $requete .= " and locked = 0 ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-T160a]", $requete);
  if ( mysql_num_rows($result) == 1 )
  {
    list ($login_extern, $pass_extern, $hash_extern, $salt_extern) = mysql_fetch_row ($result);
    if ( ($login_extern == $t_user) 
    {
      if ( ($hash_extern == "md5") and ($pass_extern == md5($t_pass)) )
        $t_verif_pass = "OK";
      //
      if ( ($hash_extern == "sha1") and ($pass_extern == sha1($t_pass)) )
        $t_verif_pass = "OK";
      //
      if ( ($hash_extern == "sha1") and ($pass_extern == sha1($t_pass . $salt_extern)) )
        $t_verif_pass = "OK";
      //
      if ( ($hash_extern == "sha256") and ($pass_extern == hash('sha256', $t_pass . $salt_extern)) )
        $t_verif_pass = "OK";
    }
    
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