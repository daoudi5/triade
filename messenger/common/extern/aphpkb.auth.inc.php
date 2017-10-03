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

define("_EXTERNAL_AUTHENTICATION_NAME", "Andy's PHP Knowledgebase");

function f_external_authentication($t_user, $t_pass)
{
  $t_verif_pass = "Ko";
  //
  require("../common/config/extern.config.inc.php");
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    // Si Andy's PHP Knowledgebase n'est pas sur le même serveur ou la même base de donnée.
    mysql_close();
    require("extern.sql.inc.php");
  }
  //
  $requete  = " select LOWER(UserName) FROM authors ";
  $requete .= " WHERE LOWER(UserName) = '" . $t_user . "' ";
  $requete .= " and Passwd = PASSWORD(" . $t_pass .") ";
  $requete .= " and Approved <> 'B' ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-T150a]", $requete);
  if ( mysql_num_rows($result) == 1 )
  {
    list ($login_extern) = mysql_fetch_row ($result);
    if ($login_extern == $t_user)
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