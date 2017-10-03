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

define("_EXTERNAL_AUTHENTICATION_NAME", "Zikula");

function f_external_authentication($t_user, $t_pass)
{
  $t_verif_pass = "Ko";
  //
  require("../common/config/extern.config.inc.php");
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    // Si Zikula n'est pas sur le m�me serveur ou la m�me base de donn�e.
    mysql_close();
    require("extern.sql.inc.php");
  }
  //
  $requete  = " select LOWER(login), password FROM " . $extern_prefix . "member ";
  $requete .= " WHERE LOWER(login) = '" . $t_user . "' ";
  //$requete .= " and level > 0 ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-T132a]", $requete);
  if ( mysql_num_rows($result) == 1 )
  {
    list ($login_extern, $pass_extern) = mysql_fetch_row ($result);
    if ($login_extern == $t_user) 
    {    
      #if (!class_exists('SHA256'))
      if (phpversion() >='5.1.2')
      {
        $passcr = hash('sha256', $t_pass);
      }
      else
      {
        require("../common/library/sha256.class.php");
        $passcr = SHA256::hash($t_pass);
      }
      if ($pass_extern == md5($t_pass))  $t_verif_pass = "OK";
      if ($pass_extern == sha1($t_pass))  $t_verif_pass = "OK";
      if ($pass_extern == $passcr)  $t_verif_pass = "OK";
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