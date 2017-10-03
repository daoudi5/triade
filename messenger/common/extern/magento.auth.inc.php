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

define("_EXTERNAL_AUTHENTICATION_NAME", "Magento");

function f_external_authentication($t_user, $t_pass)
{
  $t_verif_pass = "Ko";
  //
  require("../common/config/extern.config.inc.php");
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    // Si magento n'est pas sur le même serveur ou la même base de donnée.
    mysql_close();
    require("extern.sql.inc.php");
  }
  //
  // Customers
  //
  $requete  = " select LOWER(customers_email_address), CV.value FROM " . $extern_prefix . "customer_entity as CE, " . $extern_prefix . "customer_entity_varchar as CV ";
  $requete .= " WHERE CE.entity_type_id = CV.entity_type_id ";
  $requete .= " AND CV.attribute_id = 12 ";
  $requete .= " AND LOWER(CE.email) = '" . $t_user . "' ";
  $requete .= " AND is_active = 1 ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-T115a]", $requete);
  if ( mysql_num_rows($result) == 1 )
  {
    list ($login_extern, $pass_extern) = mysql_fetch_row ($result);
    if ( ($login_extern == $t_user)
    {
      $salt = strstr($pass_extern, ':');
      $pass_extern = substr($pass_extern, 0, strlen($pass_extern) - strlen($salt));
      $salt = substr($salt, 1, strlen($salt)-1);
      if (md5($salt . $t_pass) == $pass_extern) $t_verif_pass = "OK";
    }
  }
  //
  // Admins
  //
  if ($t_verif_pass != "OK")
  {
    $requete  = " select LOWER(username), password  FROM " . $extern_prefix . "admin_user ";
    $requete .= " WHERE LOWER(username) = '" . $t_user . "' ";
    $requete .= " AND is_active= 1 ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-T115b]", $requete);
    if ( mysql_num_rows($result) == 1 )
    {
      list ($login_extern, $pass_extern) = mysql_fetch_row ($result);
      if ( ($login_extern == $t_user)
      {
        $salt = strstr($pass_extern, ':');
        $pass_extern = substr($pass_extern, 0, strlen($pass_extern) - strlen($salt));
        $salt = substr($salt, 1, strlen($salt)-1);
        if (md5($salt . $t_pass) == $pass_extern) $t_verif_pass = "OK";
      }
    }
  }
  //
  if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
  {
    mysql_close($id_connect_extern);
    require("sql.2.inc.php");
  }
  //
  return $t_verif_pass;
}
?>