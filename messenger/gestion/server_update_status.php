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
//
if (isset($_GET['status'])) $status = intval($_GET['status']);  else $status = 0;
if (isset($_GET['id_srv'])) $id_srv = intval($_GET['id_srv']);  else $id_srv = 0;
if (isset($_GET['srvname'])) $srvname = $_GET['srvname'];  else $srvname = "";
if (isset($_GET['lang'])) $lang = $_GET['lang']; else $lang = "";
//
$url = "list_servers_status.php?lang=" . $lang . "&";
$repertoire  = getcwd() . "/"; 
if ( (substr_count($repertoire, "/admin_demo/") == 0) and (substr_count($repertoire, "\admin_demo/") == 0) ) 
{
  if ( ($id_srv > 0) and (!preg_match("#[^0-9]#", $id_srv)) and (!preg_match("#[^0-9]#", $status)) )
  {
    define('INTRAMESSENGER',true);
    require ("../common/sql.inc.php");
    //
    $requete  = " update " . $PREFIX_IM_TABLE . "SRV_SERVERSTATE ";
    $requete .= " set SRV_STATE = " . $status . " , ";
    $requete .= " SRV_STATE_DATE = CURDATE() , SRV_STATE_TIME = CURTIME() ";
    $requete .= " where ID_SERVER = " . $id_srv;
    $requete .= " LIMIT 1 "; // (to protect)
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-W6a]", $requete);
    //
    write_log("log_server_status", $id_srv . ";" . $srvname . ";"  . $status);
    //
    mysql_close($id_connect);
  }
  //
  header("location:" . $url);
}
else
  require("redirect_acp_demo.inc.php");
?>