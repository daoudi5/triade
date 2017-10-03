<?php
/*******************************************************
 **                  IntraMessenger - server          **
 **                                                   **
 **  Copyright:      (C) 2006 - 2011 THeUDS           **
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

define("_EXTERNAL_AUTHENTICATION_NAME", "IP-Board3");

function f_external_authentication($t_user, $t_pass)
{
  $t_verif_pass = "Ko";
  //$passcr = md5($t_pass);
  //
  require("../common/config/extern.config.inc.php");
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    // Si IP-Board n'est pas sur le même serveur ou la même base de donnée.
    mysql_close();
    require("extern.sql.inc.php");
  }
  //
  $requete  = " select LOWER(members_seo_name), members_pass_hash , members_pass_salt ";
  $requete .= " FROM " . $extern_prefix . "members ";
  $requete .= " WHERE LOWER(members_seo_name) = '" . $t_user . "' ";
  $requete .= " and member_banned = 0 ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-T14b]", $requete);
  if ( mysql_num_rows($result) == 1 )
  {
    list ($login_extern, $pass_extern, $salt_extern) = mysql_fetch_row ($result);
    if ( ($login_extern == $t_user) and ($pass_extern == md5(md5($salt_extern) . md5($t_pass)) )
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
?>