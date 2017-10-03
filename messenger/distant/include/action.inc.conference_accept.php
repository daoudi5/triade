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
if ( (!isset($_GET['u'])) or (!isset($_GET['s'])) or (!isset($_GET['id'])) or (!isset($_GET['at'])) or (!isset($_GET['ip'])) ) die();
//
$id_user =	  intval(f_decode64_wd($_GET['u']));
$id_user = 		(intval($id_user) - intval($action));
$id_session = intval(f_decode64_wd($_GET['s']));
$ip = 			  f_decode64_wd($_GET['ip']);
$version =    intval($_GET['v']);
$id_conf = 		intval($_GET['id']);
$action = 		$_GET['at'];
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
    die(">F51#KO#1#"); // 1:session non ouverte.
  }
  if (_ALLOW_CONFERENCE == '')
    die(">F51#KO#5#"); // 5:non autorisé
  //
  if (intval($id_conf) > 0)
  {
    $requete  = " select ID_CONFERENCE ";
    $requete .= " FROM " . $PREFIX_IM_TABLE . "CNF_CONFERENCE ";
    $requete .= " WHERE ID_CONFERENCE = " . $id_conf . " ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-61a]", $requete);
    if ( mysql_num_rows($result) == 1 ) 
    {
      // On supprime la présence dans d'éventuelles autres conférences
      $requete  = " delete from " . $PREFIX_IM_TABLE . "USC_USERCONF ";
      $requete .= " WHERE ID_CONFERENCE <> " . $id_conf;
      $requete .= " AND ID_USER = " . $id_user . " ";
      $result = mysql_query($requete);
      if (!$result) error_sql_log("[ERR-61b]", $requete);
      //
      $requete  = " select CNF.ID_CONFERENCE ";
      $requete .= " FROM " . $PREFIX_IM_TABLE . "CNF_CONFERENCE CNF, " . $PREFIX_IM_TABLE . "USC_USERCONF USC ";
      $requete .= " WHERE CNF.ID_CONFERENCE = USC.ID_CONFERENCE ";
      $requete .= " AND USC.ID_USER = " . $id_user . " ";
      //$requete .= " AND USC_ACTIVE = 0 "; // en attente de validation
      $result = mysql_query($requete);
      if (!$result) error_sql_log("[ERR-61c]", $requete);
      if ( mysql_num_rows($result) == 1 ) // normalement pas plus...
      {
        //
        if ($action == "NO") // rejet
        {
          $requete  = " delete from " . $PREFIX_IM_TABLE . "USC_USERCONF ";
          $requete .= " WHERE ID_CONFERENCE = " . $id_conf;
          $requete .= " AND ID_USER = " . $id_user . " ";
          $result = mysql_query($requete);
          if (!$result) error_sql_log("[ERR-61d]", $requete);
        }
        else
        {
          $requete  = " update " . $PREFIX_IM_TABLE . "USC_USERCONF ";
          $requete .= " SET USC_ACTIVE = 1 "; // VALIDE 
          $requete .= " WHERE ID_CONFERENCE = " . $id_conf;
          $requete .= " AND ID_USER = " . $id_user . " ";
          $requete .= " AND USC_ACTIVE = 0 "; // en attente de validation
          $result = mysql_query($requete);
          if (!$result) error_sql_log("[ERR-61e]", $requete);
        }
        //
        echo ">F51#OK####"; // conférence bien acceptée/refusée.
      }
      else
      {
        $requete  = "INSERT INTO " . $PREFIX_IM_TABLE . "USC_USERCONF (ID_CONFERENCE, ID_USER, USC_ACTIVE) ";
        $requete .= "VALUES (" . $id_conf . ", " . $id_user . " , 1 ) ";
        $result = mysql_query($requete);
        if (!$result) error_sql_log("[ERR-61f]", $requete);
        //
        echo ">F51#OK####"; // conférence bien acceptée.
      }
    }
    else
      echo ">F51#KO######"; // conférence bien créée
    //
  }
  else
    die(">F51#KO####");
  //
  mysql_close($id_connect);
}
?>