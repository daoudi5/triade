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
if ( (!isset($_GET['i1'])) or (!isset($_GET['i2'])) or (!isset($_GET['s'])) or (!isset($_GET['n'])) or (!isset($_GET['ip'])) or (!isset($_GET['c'])) or (!isset($_GET['v'])) ) die();
if ( (strlen($_GET['v']) > 3) or (strlen($_GET['c']) > 15) ) die();
//
$id_user_1 =	  intval(f_decode64_wd($_GET['i1']));
$id_user_1 = 		(intval($id_user_1) - intval($action));
$id_user_2 =	  intval(f_decode64_wd($_GET['i2']));
$id_session =   intval(f_decode64_wd($_GET['s']));
$note = 	      $_GET['n'];
$ip = 			    f_decode64_wd($_GET['ip']);
$version = 		  $_GET['v'];
$check = 		    $_GET['c'];
$check = 		    trim($check);
#if (!ctype_alnum($check)) $check = "";
//
if (preg_match("#[^0-9]#", $id_user_1)) $id_user_1 = "";
if (preg_match("#[^0-9]#", $id_user_2)) $id_user_2 = "";
if (preg_match("#[^0-9]#", $id_session)) $id_session = "";
//
if ( (_ALLOW_USER_RATING != "") and ($id_user_1 > 0) and ($id_session > 0) and ($check != "") and ($ip != "") )
{
  require ("../common/acces.inc.php");
  f_verif_ip($ip);
  //
  require ("../common/sql.inc.php");
  require ("../common/sessions.inc.php");
  //
  if (f_verif_id_session_id_user($id_user_1, $id_session) <> 'OK')
    die (">F25#KO#Session KO.#");
  //
  //
  if (f_verif_check_user_only($id_user_1, $check) == 'OK')
  {
    //
    // deja dans la liste (sinon, pas de vote possible)
    if ( f_is_deja_in_contacts_id($id_user_1, $id_user_2) > 0 )
    {
      // si le destinataire n'est pas d'un niveau hiérarchique supérieur
      /*
      if ( (_USER_HIEARCHIC_MANAGEMENT_BY_ADMIN != "") and (_SPECIAL_MODE_OPEN_COMMUNITY == "") )
      {
        if ( f_level_of_user($id_user_1) > f_level_of_user($id_user_2) )
        {
          die(">F25#KO#LEVEL####"); // niveau hiérarchique supérieur.
        }
      }
      */
      //
      $note = intval(f_decode64_wd($note));
      $requete  = " update " . $PREFIX_IM_TABLE . "CNT_CONTACT ";
      $requete .= " set CNT_RATING = " . $note;
      $requete .= " where ID_USER_1 = " . $id_user_1 . " and ID_USER_2 = " . $id_user_2;
      $requete .= " LIMIT 1 "; // (to protect)
      $result = mysql_query($requete);
      if (!$result) error_sql_log("[ERR-30a]", $requete);
      //
      echo ">F25#OK###"; // OK !
      //
      $requete  = " select sum(CNT_RATING), count(*) from " . $PREFIX_IM_TABLE . "CNT_CONTACT";
      $requete .= " where ID_USER_2 = " . $id_user_2 . " and CNT_RATING > 0 ";
      $result = mysql_query($requete);
      if (!$result) error_sql_log("[ERR-30b]", $requete);
      list ($som_vote, $nb_vote) = mysql_fetch_row ($result);
      //
      $note_moy = 0; // pas de moyenne, si pas assez de votants.
      if ($nb_vote > 2) $note_moy = round($som_vote / $nb_vote, 0);
      //
      $requete  = " update " . $PREFIX_IM_TABLE . "USR_USER ";
      $requete .= " set USR_RATING = " . $note_moy;
      $requete .= " where ID_USER = " . $id_user_2;
      $requete .= " LIMIT 1 "; // (to protect)
      $result = mysql_query($requete);
      if (!$result) error_sql_log("[ERR-30c]", $requete);
    }
    else
    {
      echo ">F25#KO####"; // pas dans la liste
    }
  }
  //
  mysql_close($id_connect);
}
?>