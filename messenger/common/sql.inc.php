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
//

if ( !defined('INTRAMESSENGER') )
{
  exit;
}

## Parametre Mysql
require_once("config/mysql.config.inc.php");

if (isset($dbport))
{
  if (intval($dbport) > 0) $dbhost = $dbhost . ":" . intval($dbport);
}

## Connection serveur mysql
$id_connect = mysql_connect($dbhost, $dbuname, $dbpass) or die("Unable to connect to MySQL server: " . mysql_error());
mysql_select_db($database, $id_connect) or die("Unable to select database: " . mysql_error());

unset($dbpass);


//if (!function_exists("write_log"))
require("log.inc.php");


//if (!function_exists("error_sql_log"))  {
Function error_sql_log($txt, $qry)
{
  if ( (mysql_error() == "Query execution was interrupted") or (mysql_error() == "Lost connection to MySQL server during query") or (mysql_error() == "MySQL server has gone away") )
    write_log("error_log_connection", $txt . "\n" . $qry . "\n" . mysql_error() );
  else
    write_log("error_log", $txt . "\n" . $qry . "\n" . mysql_error() );
  //
  die ($txt . " Invalid request (Requête invalide) : " . mysql_error() . " <BR>");
}

?>