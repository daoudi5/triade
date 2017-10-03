<?php
/*******************************************************
 **                  IntraMessenger - server          **
 **                                                   **
 **  Copyright:      (C) 2006 - 2014 THeUDS           **
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

define("_EXTERNAL_AUTHENTICATION_NAME", "Joomla");

function f_external_authentication($t_user, $t_pass)
{
  $t_verif_pass = "Ko";
  //$passcr = md5($t_pass);
  //
  require("../common/config/extern.config.inc.php");
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    // Si Joomla n'est pas sur le même serveur ou la même base de donnée.
    mysql_close();
    require("extern.sql.inc.php");
  }
   //
  $requete  = " select LOWER(username), password FROM " . $extern_prefix . "users ";
  $requete .= " WHERE LOWER(username) = '" . $t_user . "' ";
  $requete .= " and block = 0 ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-T5a]", $requete);
  if ( mysql_num_rows($result) == 1 )
  {
    list ($login_extern, $pass_extern) = mysql_fetch_row ($result);
    if ($login_extern == $t_user)
    { 
      if (strstr($pass_extern, ";"))
      {
        // $pass_extern contient le mot de pass cripté en md5 avec hash (md5(pass+hash) suivi après ':' du hash.
        $tt = explode (':', $pass_extern);
        if ( ($tt[0] != '') and ($tt[1] != '') )
        {
          $passcr = md5($t_pass . $tt[1]);
          if ($tt[0] == $passcr) $t_verif_pass = "OK";
        }
        else
        {
          $passcr = md5($t_pass);
          if ($pass_extern == $passcr) $t_verif_pass = "OK";
        } 
      } 
      //
      if ($t_verif_pass != "OK")
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
    // Si Joomla n'est pas sur le même serveur ou la même base de donnée.
    mysql_close();
    require("extern.sql.inc.php");
  }
  //
  $requete  = " select id FROM " . $extern_prefix . "users ";
  $requete .= " WHERE LOWER(username) = '" . $t_user . "' ";
  $requete .= " and block = 0 ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-T5b]", $requete);
  if ( mysql_num_rows($result) == 1 )
  {
    list ($id_extern) = mysql_fetch_row ($result);
    //
    $requete  = " select count(*) FROM " . $extern_prefix . "messages ";
    $requete .= " WHERE user_id_to = " . $id_extern . " ";
    $requete .= " and state = 0 ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-T5b]", $requete);
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