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
if (isset($_GET['lang'])) $lang = $_GET['lang']; else $lang = "";
if (isset($_GET['action'])) $action = $_GET['action']; else $action = "";
if (isset($_GET['dbengine'])) $dbengine = $_GET['dbengine']; else $dbengine = "";
//
define('INTRAMESSENGER',true);
require ("../common/sql.inc.php");
//
require ("../common/create_tables.inc.php");
//
mysql_close($id_connect);
//
if ($action == "noredirect")
{
  echo "Table(s) added.";
}
else
{
  //header("location:install.php?lang=" . $lang . "&");
  echo "<META http-equiv='refresh' content='1;url=check.php?lang=" . $lang . "&'>";
}
?>