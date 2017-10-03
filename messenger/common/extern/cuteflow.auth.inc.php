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

define("_EXTERNAL_AUTHENTICATION_NAME", "CuteFlow");

function f_external_authentication($t_user, $t_pass)
{
  $t_verif_pass = "Ko";
  $passcr = md5($t_pass);
  //
  require("../common/config/extern.config.inc.php");
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    // Si CuteFlow n'est pas sur le même serveur ou la même base de donnée.
    mysql_close();
    require("extern.sql.inc.php");
  }
   //
  $requete  = " select LOWER(strUserId), strPassword FROM " . $extern_prefix . "user ";
  $requete .= " WHERE LOWER(strUserId) = '" . $t_user . "' ";
  $requete .= " and nAccessLevel > 0 ";
  //$requete .= " and bDeleted = 0 ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-T41a]", $requete);
  if ( mysql_num_rows($result) == 1 )
  {
    list ($login_extern, $pass_extern) = mysql_fetch_row ($result);
    if ( ($login_extern == $t_user) and ($pass_extern == $passcr) )
    {
      $t_verif_pass = "OK";
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


function f_get_cuteflow_name_of_user($t_user)
{
  $family_and_first_name = "";
  //
  require("../common/config/extern.config.inc.php");
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    // Si cuteflow n'est pas sur le même serveur ou la même base de donnée.
    mysql_close();
    require("extern.sql.inc.php");
  }
   //
  $requete  = " select LOWER(strUserId), strLastName, strFirstName FROM " . $extern_prefix . "user ";
  $requete .= " WHERE LOWER(strUserId) = '" . $t_user . "' ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-T41b]", $requete);
  if ( mysql_num_rows($result) == 1 )
  {
    list ($login_extern, $extern_familyname, $extern_firstname) = mysql_fetch_row ($result);
    if ($login_extern == $t_user)
      $family_and_first_name = ucfirst(trim($extern_firstname)) . " " . strtoupper(trim($extern_familyname));
      //$family_and_first_name = trim($extern_firstname) . " " . trim($extern_familyname);
    //
  }
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    mysql_close($id_connect_extern);
    require("sql.2.inc.php");
  }
  //
  return $family_and_first_name;
}

?>