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

define("_EXTERNAL_AUTHENTICATION_NAME", "pragmaMx");

function f_external_authentication($t_user, $t_pass)
{
  $t_verif_pass = "Ko";
  $passcr = md5($t_pass);
  //
  require("../common/config/extern.config.inc.php");
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    // Si pragmaMx n'est pas sur le même serveur ou la même base de donnée.
    mysql_close();
    require("extern.sql.inc.php");
  }
   //
  $requete  = " select LOWER(uname), pass FROM " . $extern_prefix . "_users ";
  $requete .= " WHERE LOWER(uname) = '" . $t_user . "' ";
  $requete .= " and user_stat > 0 ";
  //$requete .= " and user_level > 0 ";
  //$requete .= " and ublock is null ";
  //$requete .= " and ublockon = 0 ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-T130a]", $requete);
  if ( mysql_num_rows($result) == 1 )
  {
    list ($login_extern, $pass_extern) = mysql_fetch_row ($result);
    if ( ($login_extern == $t_user) and ($pass_extern == $passcr) )
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


function f_extern_nb_unread_pm($t_user)
{
  $nb_pm = 0;
  require("../common/config/extern.config.inc.php");
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    // Si pragmaMx n'est pas sur le même serveur ou la même base de donnée.
    mysql_close();
    require("extern.sql.inc.php");
  }
  $requete  = " select id FROM " . $extern_prefix . "_users ";
  $requete .= " WHERE LOWER(uname) = '" . $t_user . "' ";
  $requete .= " and user_stat > 0 ";
  //$requete .= " and user_level > 0 ";
  //$requete .= " and ublock is null ";
  //$requete .= " and ublockon = 0 ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-T130b]", $requete);
  if ( mysql_num_rows($result) == 1 )
  {
    list ($id_extern) = mysql_fetch_row ($result);
    //
    $requete  = " select count(*) FROM " . $extern_prefix . "_priv_msgs ";
    $requete .= " WHERE to_userid = " . $id_extern . " ";
    $requete .= " and read_msg = 0 ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-T130c]", $requete);
    if ( mysql_num_rows($result) == 1 )
    {
      list ($nb_pm) = mysql_fetch_row ($result);
    }
  }
  //
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    mysql_close($id_connect_extern);
    require("sql.2.inc.php");
  }
  //
  return $nb_pm;
}
?>