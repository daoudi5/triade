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

define("_EXTERNAL_AUTHENTICATION_NAME", "phpBB 3");

function f_external_authentication($t_user, $t_pass)
{
  $t_verif_pass = "Ko";
  $passcr = md5($t_pass);
  //
  require("../common/config/extern.config.inc.php");
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    // Si phpBB n'est pas sur le m�me serveur ou la m�me base de donn�e.
    mysql_close();
    require("extern.sql.inc.php");
  }
   //
  $requete  = " select LOWER(username_clean), user_password FROM " . $extern_prefix . "users ";
  $requete .= " WHERE LOWER(username_clean) = '" . $t_user . "' ";
  $requete .= " and user_lastvisit > 0 ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-T42a]", $requete);
  if ( mysql_num_rows($result) == 1 )
  {
    list ($login_extern, $pass_extern) = mysql_fetch_row ($result);
    if ($login_extern == $t_user) 
    {
      if ($pass_extern == $passcr) 
        $t_verif_pass = "OK";
      else
      {
        if (substr($pass_extern, 0, 3) == '$H$') $pass_extern = '$P$' . substr($pass_extern, 3, strlen($pass_extern)-1);
        require ("../common/library/PasswordHash.php");
        $t_hasher = new PasswordHash(8, FALSE);
        $check = $t_hasher->CheckPassword($t_pass, $pass_extern);
        if ($check) $t_verif_pass = "OK";
      }
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



function f_extern_nb_unread_pm($t_user)
{
  $nb_pm = 0;
  require("../common/config/extern.config.inc.php");
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    // Si phpBB n'est pas sur le m�me serveur ou la m�me base de donn�e.
    mysql_close();
    require("extern.sql.inc.php");
  }
   //
  $requete  = " select LOWER(username_clean), user_new_privmsg, user_password FROM " . $extern_prefix . "users ";
  $requete .= " WHERE LOWER(username_clean) = '" . $t_user . "' ";
  $requete .= " and user_lastvisit > 0 ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-T42b]", $requete);
  if ( mysql_num_rows($result) == 1 )
  {
    list ($login_extern, $nb_pm, $pass_extern) = mysql_fetch_row ($result);
    if ($login_extern != $t_user) $nb_pm = 0;
    //
  }
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    mysql_close($id_connect_extern);
    require("sql.2.inc.php");
  }
  //
  return $nb_pm;
}

?>