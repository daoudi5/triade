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
//
if (isset($_GET['id_admin'])) $id_admin = intval($_GET['id_admin']);  else $id_admin = 0;
if (isset($_GET['lang'])) $lang = $_GET['lang']; else $lang = "";
//
$url = "list_admin_acp.php?lang=" . $lang . "&";
$repertoire  = getcwd() . "/"; 
if ( (substr_count($repertoire, "/admin_demo/") == 0) and (substr_count($repertoire, "\admin_demo/") == 0) ) 
{
  if ( ($id_admin > 0) and (!preg_match("#[^0-9]#", $id_admin)) )
  {
    define('INTRAMESSENGER',true);
    require ("../common/sql.inc.php");
    //
    $requete  = " delete from " . $PREFIX_IM_TABLE . "ADM_ADMINACP ";
    $requete .= " where ID_ADMIN = " . $id_admin;
    $requete .= " LIMIT 1 "; // (to protect)
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-P1d]", $requete);
    //
    mysql_close($id_connect);
  }
  //
  header("location:" . $url);
}
else
  require("redirect_acp_demo.inc.php");
?>