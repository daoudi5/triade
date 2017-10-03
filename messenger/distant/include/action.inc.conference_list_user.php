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
if ( (!isset($_GET['u'])) or (!isset($_GET['s'])) or (!isset($_GET['id'])) or (!isset($_GET['ip'])) ) die();
//
$id_user =	  intval(f_decode64_wd($_GET['u']));
$id_user = 		(intval($id_user) - intval($action));
$id_session = intval(f_decode64_wd($_GET['s']));
$ip = 			  f_decode64_wd($_GET['ip']);
$version =    intval($_GET['v']);
$id_conf = 		intval(f_decode64_wd($_GET['id']));
//
if (preg_match("#[^0-9]#", $id_user)) $id_user = "";
if (preg_match("#[^0-9]#", $id_session)) $id_session = "";
if (preg_match("#[^0-9]#", $id_conf)) $id_conf = "";
//
if ( ($id_user > 0) and ($id_session > 0) and ($id_conf > 0) )
{
  require ("../common/acces.inc.php");
  f_verif_ip($ip);
  //
  require ("../common/sql.inc.php");
  require ("../common/sessions.inc.php");
  //
  if (f_verif_id_session_id_user($id_user, $id_session) != 'OK') 
  {
    die(">F52#KO#1#"); // 1:session non ouverte.
  }
  if (_ALLOW_CONFERENCE == '')
    die(">F52#KO#5#"); // 5:non autorisé
  //
  $res = "";
  $nb = 0;
  $tbug = "";
  if ($id_conf > 0)
  {
    $requete  = " select CNF.ID_CONFERENCE ";
    $requete .= " FROM " . $PREFIX_IM_TABLE . "CNF_CONFERENCE CNF, " . $PREFIX_IM_TABLE . "USC_USERCONF USC ";
    $requete .= " WHERE CNF.ID_CONFERENCE = USC.ID_CONFERENCE ";
    $requete .= " AND USC.ID_USER = " . $id_user . " ";
    //$requete .= " AND ID_CONFERENCE = " . $id_conf . " "; 
    //$requete .= " AND USC_ACTIVE = 0 "; // en attente de validation
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-62a]", $requete);
    if ( mysql_num_rows($result) == 1 ) // normalement pas plus...
    {
      list ($t) = mysql_fetch_row ($result);
      if ($t == $id_conf)
      {
        $requete  = " select USR.USR_USERNAME, USR.ID_USER, USC.USC_ACTIVE ";
        $requete .= " FROM " . $PREFIX_IM_TABLE . "USC_USERCONF USC, " . $PREFIX_IM_TABLE . "USR_USER USR ";
        $requete .= " WHERE USR.ID_USER = USC.ID_USER ";
        $requete .= " AND USR.ID_USER <> " . $id_user . " ";
        $requete .= " AND USC.ID_CONFERENCE = " . $id_conf . " "; 
        //$requete .= " AND USC.USC_ACTIVE = 1 "; // validés
        $result = mysql_query($requete);
        if (!$result) error_sql_log("[ERR-62b]", $requete);
        if ( mysql_num_rows($result) > 0 )
        {
          while( list ($usr_name, $usr_id, $usc_active) = mysql_fetch_row ($result) )
          {
            $res .= f_encode64($usr_name) . "#" . f_encode64($usr_id) . "#" . $usc_active . "#";
            $nb++;
          }
        }
      }
    }
    else
      $tbug ="A";
  }
  //
  if ( ($res != "") and ($nb > 0) )
    echo ">F52#OK#" . $nb . "#x#" . $res; // x x pour le cas ou
  else
    echo ">F52#KO#" . $tbug . "#####"; 
  //
  mysql_close($id_connect);
}
?>