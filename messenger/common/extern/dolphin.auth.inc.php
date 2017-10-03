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

define("_EXTERNAL_AUTHENTICATION_NAME", "Dolphin");

function f_external_authentication($t_user, $t_pass)
{
  $t_verif_pass = "Ko";
  //
  require("../common/config/extern.config.inc.php");
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    // Si dolphin n'est pas sur le même serveur ou la même base de donnée.
    mysql_close();
    require("extern.sql.inc.php");
  }
   //
  $requete  = " select LOWER(NickName), Password, Salt FROM " . $extern_prefix . "Profiles ";
  $requete .= " WHERE LOWER(NickName) = '" . $t_user . "' ";
  $requete .= " AND Status = 'Active' ";
  //$requete .= " AND Role > 0 ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-T121a]", $requete);
  if ( mysql_num_rows($result) == 1 )
  {
    list ($login_extern, $pass_extern, $salt_extern) = mysql_fetch_row ($result);
    if ($login_extern == $t_user) 
    {    
      #if (!class_exists('SHA256'))
      if (phpversion() >='5.1.2')
      {
        $passcr = hash('sha256', md5($t_pass) . $salt_extern));
      }
      else
      {
        require("../common/library/sha256.class.php");
        $passcr = SHA256::hash(md5($t_pass) . $salt_extern));
      }
      if ($pass_extern == sha1(md5($t_pass) . $salt_extern))  $t_verif_pass = "OK";
      if ($pass_extern == $passcr)  $t_verif_pass = "OK";
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