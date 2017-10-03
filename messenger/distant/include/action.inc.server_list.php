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
//
if ( !defined('INTRAMESSENGER') )
{
  exit;
}
//
if ( (!isset($_GET['ip'])) or (!isset($_GET['v'])) ) die();
//
$ip = 			  f_decode64_wd($_GET['ip']);
$n_version = 	intval($_GET['v']);
//
if ( ($n_version > 0) and ($ip != "") )
{
  require ("../common/acces.inc.php");
  f_verif_ip($ip);
  //
  if (_SERVERS_STATUS == "")
  {
    die(">F89#KO#2#"); // 2: Not allowed (option not activated)
  }
  //
  require ("../common/sql.inc.php");
  //
  $requete  = " SELECT ID_SERVER, SRV_NAME ";
  $requete .= " FROM " . $PREFIX_IM_TABLE . "SRV_SERVERSTATE ";
  $requete .= " ORDER BY UPPER(SRV_NAME) ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-80a]", $requete);
  $nb_lig = mysql_num_rows($result);
  if ( $nb_lig > 0 )
  {
    echo ">F89#OK#" . $nb_lig . "###|";
    while( list ($id_srv, $srv_name) = mysql_fetch_row ($result) )
    {
      $msg = "#" . $id_srv . "#" . $srv_name . "#";
      $msg = f_encode64($msg);
      echo $msg . "|"; // séparateur de ligne : '|' (pipe).
    }
  }
  else
  {
    // renvoie : la shout est vide.
    echo ">F89#OK#0##";
  }
  //
  mysql_close($id_connect);
}
?>