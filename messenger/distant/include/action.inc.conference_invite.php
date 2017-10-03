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
if ( (!isset($_GET['u1'])) or (!isset($_GET['u2'])) or (!isset($_GET['s'])) or (!isset($_GET['ip'])) ) die();
//
$id_u_1 =	    intval(f_decode64_wd($_GET['u1']));
$id_u_1 = 		(intval($id_u_1) - intval($action));
$id_u_2 =     intval(f_decode64_wd($_GET['u2']));
$id_session = intval(f_decode64_wd($_GET['s']));
$ip = 			  f_decode64_wd($_GET['ip']);
$version =    intval($_GET['v']);
//
if (preg_match("#[^0-9]#", $id_u_1)) $id_u_1 = "";
if (preg_match("#[^0-9]#", $id_u_2)) $id_u_2 = "";
if (preg_match("#[^0-9]#", $id_session)) $id_session = "";
//
if ( ($id_u_1 > 0) and ($id_u_2 > 0) and ($id_session > 0) )
{
  require ("../common/acces.inc.php");
  f_verif_ip($ip);
  //
  require ("../common/sql.inc.php");
  require ("../common/sessions.inc.php");
  //
  if (f_verif_id_session_id_user($id_u_1, $id_session) != 'OK') 
  {
    die(">F50#KO#1#"); // 1:session non ouverte.
  }
  // Si destinataire non "en ligne"
  if (f_get_id_session_id_user($id_u_2) == 0)
  {
    die(">F50#KO#2#"); // 2:session non ouverte (utilisateur distant indisponbile)
  }
  if (_ALLOW_CONFERENCE == '')
    die(">F50#KO#5#"); // 5:non autorisé
  //
  $ok_send = "OK";
  $priv_u_1 = '';
  //
  // si mode invisible autorisé.
  if (_ALLOW_INVISIBLE != '')
  {
    // on récupère l'état de privilège du destinataire :
    $requete = "select CNT_STATUS from " . $PREFIX_IM_TABLE . "CNT_CONTACT ";
    $requete .= "WHERE ID_USER_1 = " . $id_u_1 . " ";
    $requete .= "and ID_USER_2 = " . $id_u_2 . " ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-60a]", $requete);
    if ( mysql_num_rows($result) == 1 )
    {
      list ($priv_u_1) = mysql_fetch_row ($result);
    }
    //
    // si on est masqué pour le destinataire, on ne peut pas lui écrire (non mais).
    if ($priv_u_1 == '5')
    {
      echo ">F50#KO#4#";  // 4:utilisateur ne peut pas vour voir.
      $ok_send = "Ko";
    }
  }
  if ($ok_send == "OK")
  {
    $ok_send = "Ko";
    $requete = "select SES_STATUS, ID_SESSION ";
    $requete .= "FROM " . $PREFIX_IM_TABLE . "SES_SESSION SES, " . $PREFIX_IM_TABLE . "USR_USER USR ";
    $requete .= "WHERE SES.ID_USER = USR.ID_USER and USR.ID_USER = " . $id_u_2 . " ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-60b]", $requete);
    if ( mysql_num_rows($result) == 1 )
    {
      list ($etat_num, $id_ses) = mysql_fetch_row ($result);
      //if ($etat_num == '1') // seuls les utilisateurs dispos peuvent être invités à une conférence.
      if ( ($etat_num == '1') or ($etat_num == '2') or ($etat_num == '3') )
      {
        $ok_send = "OK"; 
      }
    }
  }
  //
  //
  if ($ok_send == "OK")
  {
    // On supprime ses attentes de confirmation aux autres conférences.
    $requete  = " DELETE FROM " . $PREFIX_IM_TABLE . "USC_USERCONF ";
    $requete .= " WHERE ID_USER = " . $id_u_2 . " ";
    $requete .= " AND USC_ACTIVE = 0 "; // en attente de validation
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-60c]", $requete);
    //
    // On vérifie si l'utilisateur n'est pas déjà ACTIF dans une autre conférence.
    $requete  = " select USC.ID_CONFERENCE, USC.USC_ACTIVE ";
    $requete .= " FROM " . $PREFIX_IM_TABLE . "CNF_CONFERENCE CNF, " . $PREFIX_IM_TABLE . "USC_USERCONF USC ";
    $requete .= " WHERE CNF.ID_CONFERENCE = USC.ID_CONFERENCE and USC.ID_USER = " . $id_u_2 . " ";
    $requete .= " AND USC_ACTIVE = 1 "; // actif
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-60d]", $requete);
    if ( mysql_num_rows($result) > 0 )
    {
      $ok_send == "Ko";
    }
  }
  //
  if ($ok_send == "OK")
  {
    // On vérifie si la conférence existe (si ce n'est pas la 1ère personne que l'on invite).
    $id_conf = 0;
    $requete  = " select CNF.ID_CONFERENCE ";
    $requete .= " FROM " . $PREFIX_IM_TABLE . "CNF_CONFERENCE CNF, " . $PREFIX_IM_TABLE . "USC_USERCONF USC ";
    $requete .= " WHERE CNF.ID_CONFERENCE = USC.ID_CONFERENCE and USC.ID_USER = " . $id_u_1 . " ";
    //$requete .= " AND USC_ACTIVE = 1 ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-60e]", $requete);
    if ( mysql_num_rows($result) == 1 ) // normalement pas plus...
    {
      list ($id_conf) = mysql_fetch_row ($result);
    }
    //
    // Si la conférence n'existe pas, on la créé.
    if (intval($id_conf) <= 0)
    {
      $requete = "INSERT INTO " . $PREFIX_IM_TABLE . "CNF_CONFERENCE (ID_USER, CNF_DATE_CREAT, CNF_TIME_CREAT) ";
      $requete .= "VALUES (" . $id_u_1 . ", CURDATE(), CURTIME() ) ";
      $result = mysql_query($requete);
      if (!$result) error_sql_log("[ERR-60f]", $requete);
      //
      $id_conf = 0;
      $requete  = " select max(ID_CONFERENCE) ";
      $requete .= " FROM " . $PREFIX_IM_TABLE . "CNF_CONFERENCE ";
      $requete .= " WHERE ID_USER = " . $id_u_1 . " ";
      $result = mysql_query($requete);
      if (!$result) error_sql_log("[ERR-60g]", $requete);
      if ( mysql_num_rows($result) == 1 ) // normalement une seule conf, mais pas toujours ! (donc max et purge plus bas de la participation dans autres conférences)
      {
        list ($id_conf) = mysql_fetch_row ($result);
      }
      //
      // Comme on vient de créer la conférence, il saut s'y ajouter comme participant (et actif).
      if (intval($id_conf) > 0)
      {
        // on ajoute le demandeur, en compte validé (1).
        $requete  = " INSERT INTO " . $PREFIX_IM_TABLE . "USC_USERCONF (ID_CONFERENCE, ID_USER, USC_ACTIVE) ";
        $requete .= " VALUES (" . $id_conf . ", " . $id_u_1 . " , 1 ) ";
        $result = mysql_query($requete);
        if (!$result) error_sql_log("[ERR-60h]", $requete);
        //
        // pour le cas où, on supprime sa participation dans les autres conférences.
        $requete  = " DELETE FROM " . $PREFIX_IM_TABLE . "USC_USERCONF ";
        $requete .= " WHERE ID_USER = " . $id_u_1;
        $requete .= " AND ID_CONFERENCE <> " . $id_conf;
        $result = mysql_query($requete);
        if (!$result) error_sql_log("[ERR-60i]", $requete);
      }
    }
    //
    if (intval($id_conf) > 0)
    {
      // on ajoute le correspondant, en compte non validé (0).
      $requete = "INSERT INTO " . $PREFIX_IM_TABLE . "USC_USERCONF (ID_CONFERENCE, ID_USER, USC_ACTIVE) ";
      $requete .= "VALUES (" . $id_conf . ", " . $id_u_2 . " , 0 ) ";
      $result = mysql_query($requete);
      if (!$result) error_sql_log("[ERR-60k]", $requete);
      //
      echo ">F50#OK#" . $id_conf . "#####"; // conférence bien créée
    }
    else
      echo ">F50#KO######";
    //
  }
  else
    die(">F50#KO#0###");
  //
  mysql_close($id_connect);
}
?>