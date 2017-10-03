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
if (!isset($_GET['ip'])) die();
//
$ip = f_decode64_wd($_GET['ip']);
$ip = trim($ip);
if (isset($_GET['v'])) $n_version = $_GET['v']; else $n_version = ""; // ajouté le 28/08/09
//
// If admin folder not renamed -> maintenance mode !
if (is_readable("../admin/index.php")) 
  die(">F02#KO#MAINTENANCE#NEED_TO_FINISH_CONFIG#"); // configuration not finished.
//
if (strlen($ip) < 7)
{
	sleep(rand(2,5));
	echo ">F02#KO#/#";
	write_log("error_acces_no_ip_log", $ip ); 
}
else
{
  require ("../common/sql.inc.php");
  //
  $requete  = " select count(*) ";
  $requete .= " FROM " . $PREFIX_IM_TABLE . "SES_SESSION ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-01a]", $requete);
  if ( mysql_num_rows($result) == 1 )
  {
    list ($nb_ses) = mysql_fetch_row ($result);
    //
    // Just test if install look to be finished
    $requete  = " select count(*) ";
    $requete .= " FROM " . $PREFIX_IM_TABLE . "USR_USER ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-01b]", $requete);
    if ( mysql_num_rows($result) == 1 )
    {
      if ( (intval($nb_ses) >= intval(_MAX_NB_SESSION)) and (intval(_MAX_NB_SESSION) > 0) )
      {
        sleep(rand(2,5));
        echo ">F02#KO#MAX#"; // nbre maxi atteint.
        write_log("cannot_acces_server_full", $ip); 
      }
      else
      {	
        require ("../common/constant.inc.php");
        //
        $url_ext = "";
        if ( (strlen(_EXTERN_URL_TO_REGISTER) > 10) and (_EXTERNAL_AUTHENTICATION != "") )
        {
          $url_ext = "64" . f_encode64(_EXTERN_URL_TO_REGISTER);
        }
        //
        $server_enterprise = "";
        if (_ENTERPRISE_SERVER != "") $server_enterprise = "SE";
        //
        $private_server = "";
        if ( strlen(_PASSWORD_FOR_PRIVATE_SERVER) > 5 ) $private_server = "PS";
        //
        $chang_srv = "";
        if ( strlen(_STOP_USE_THIS_SERVER_ADDRESS_NOW_USE_THIS_URL) > 15) $chang_srv = f_encode64(_STOP_USE_THIS_SERVER_ADDRESS_NOW_USE_THIS_URL);
        //
        // on renvoi OK : la connexion SQL a fonctionné (connect to SQL database : ok).
        echo ">F02#OK#" . $url_ext . "#" . $server_enterprise . "#" . $private_server . "#" . _CLIENT_VERSION_MINI . "#" . $chang_srv . "#####";
      }
    }
    else
      echo ">F02#KO#BUG#"; // bug
  }
  else
    echo ">F02#KO#BUG#"; // bug
  //
  mysql_close($id_connect);
}
?>