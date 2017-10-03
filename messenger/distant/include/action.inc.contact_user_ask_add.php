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
if ( (!isset($_GET['iu'])) or (!isset($_GET['s'])) or (!isset($_GET['i2'])) or (!isset($_GET['ip'])) or (!isset($_GET['c'])) or (!isset($_GET['v'])) ) die();
if (strlen($_GET['v']) > 3) die();
//
$id_user_1 =	  intval(f_decode64_wd($_GET['iu']));
$id_user_1 = 		(intval($id_user_1) - intval($action));
$id_user_2 =	  intval(f_decode64_wd($_GET['i2']));
$id_session =   intval(f_decode64_wd($_GET['s']));
$ip = 			    f_decode64_wd($_GET['ip']);
$check = 		    f_decode64_wd($_GET['c']);
$check = 		    trim($check);
$version =      intval($_GET['v']);
if (isset($_GET['m'])) $msg = $_GET['m'];  else  $msg = ""; // message optionnel
if (isset($_GET['ad'])) $ad = $_GET['ad']; else  $ad = "";  // ajout par nickname
#if (!ctype_alnum($check)) $check = "";
//
if (preg_match("#[^0-9]#", $id_user_1)) $id_user_1 = "";
if (preg_match("#[^0-9]#", $id_user_2)) $id_user_2 = "";
if (preg_match("#[^0-9]#", $id_session)) $id_session = "";
//
require ("../common/sql.inc.php");
//
if ( (intval($id_user_2) <= 0) and ($ad != "") )  
  $id_user_2 = f_get_id_nom_user(f_decode64_wd($ad));
//
if ( ($id_user_1 > 0) and ($id_user_2 > 0) and ($id_session > 0) and ($check != "") and ($ip != "") )
{
  require ("../common/acces.inc.php");
  f_verif_ip($ip);
  //
  require ("../common/sessions.inc.php");
  //
  if (f_verif_id_session_id_user($id_user_1, $id_session) <> 'OK')
    die (">F20#KO#Session KO.#");
  //
  //
  if (f_verif_check_user_only($id_user_1, $check) == 'OK')
  {
    $msg = f_decode64_wd($msg);
    $msg =   str_replace("'", "`", $msg);
    $msg =   str_replace('"', '', $msg);
    //
    if ( f_is_deja_in_contacts_id($id_user_1, $id_user_2) > 0 )
    {
      echo ">F20#KO####"; // deja dans la liste (peut être simplement en attente)
    }
    else
    {
      // On fait aussi le ménage sur les contacts dont le user n'existe plus :
      //$requete = " delete from " . $PREFIX_IM_TABLE . "CNT_CONTACT where ID_USER_1=" . $id_user_1 . " and ID_USER_2 not in (select distinct ID_USER from " . $PREFIX_IM_TABLE . "USR_USER ) ";
      $requete  = " select distinct(ID_USER_2) ";
      $requete .= " from " . $PREFIX_IM_TABLE . "CNT_CONTACT LEFT JOIN " . $PREFIX_IM_TABLE . "USR_USER ON " . $PREFIX_IM_TABLE . "CNT_CONTACT.ID_USER_2 = " . $PREFIX_IM_TABLE . "USR_USER.ID_USER ";
      $requete .= " where " . $PREFIX_IM_TABLE . "USR_USER.ID_USER IS NULL ";
      $requete .= " and " . $PREFIX_IM_TABLE . "CNT_CONTACT.ID_USER_1 = " . $id_user_1 . " ";
      $result = mysql_query($requete);
      if (!$result) error_sql_log("[ERR-31a]", $requete);
      if ( mysql_num_rows($result) > 0 )
      {
        while( list ($id_user_to_delete) = mysql_fetch_row ($result) )
        {
          $requete_2  = " delete from " . $PREFIX_IM_TABLE . "CNT_CONTACT ";
          $requete_2 .= " where ID_USER_1 = " . $id_user_to_delete . " or ID_USER_2 = " . $id_user_to_delete . " ";
          $result2 = mysql_query($requete_2);
          if (!$result2) error_sql_log("[ERR-31b]", $requete_2);
        }
      }
      //
      //
      $ok = 'OK';
      if ( (_MAX_NB_CONTACT_BY_USER != '0') and (intval(_MAX_NB_CONTACT_BY_USER) > 0) )
      {
        //
        // vérifier si ne dépasse pas le nombre de contacts autorisé par utilisateur.
        // pour l'utilisateur qui demande :
        $requete  = " select count(*) from " . $PREFIX_IM_TABLE . "CNT_CONTACT ";
        $requete .= " where ID_USER_1=" . $id_user_1 . " ";
        $result = mysql_query($requete);
        if (!$result) error_sql_log("[ERR-31c]", $requete);
        list ($nb_cnt) = mysql_fetch_row ($result);
        //
        // vérifier si ne dépasse pas le nombre de contacts autorisé par utilisateur
        // pour celui qui recoit la demande :
        $requete  = " select count(*) from " . $PREFIX_IM_TABLE . "CNT_CONTACT ";
        $requete .= " where ID_USER_1=" . $id_user_2 . " ";
        $result = mysql_query($requete);
        if (!$result) error_sql_log("[ERR-31d]", $requete);
        list ($nb_cnt2) = mysql_fetch_row ($result);
        //
        if ($nb_cnt >= _MAX_NB_CONTACT_BY_USER)
        {
          // On récupère si on en a demandé qui n'ont pas encore accepté.
          $requete  = " select count(*) from " . $PREFIX_IM_TABLE . "CNT_CONTACT ";
          $requete .= " where ID_USER_1=" . $id_user_1;
          $requete .= " and CNT_STATUS = 0 ";
          $result = mysql_query($requete);
          if (!$result) error_sql_log("[ERR-31e]", $requete);
          list ($nb_cnt_wait) = mysql_fetch_row ($result);
          //
          $ok = 'KO';
          echo ">F20#KO#MAX#1#" . $nb_cnt_wait . "##"; // nbre maxi atteint (demandeur)
        }
        if ($nb_cnt2 >= _MAX_NB_CONTACT_BY_USER)
        {
          $ok = 'KO';
          echo ">F20#KO#MAX#2###"; // nbre maxi atteint (recepteur)
        }
      }
      //
      // si quota non dépassé
      if ( ($ok == 'OK') and (_USER_HIEARCHIC_MANAGEMENT_BY_ADMIN != "") and (_SPECIAL_MODE_OPEN_COMMUNITY == "") )
      {
        if ( f_level_of_user($id_user_1) > f_level_of_user($id_user_2) )
        {
          $ok = 'KO';
          echo ">F20#KO#LEVEL####"; // niveau hiérarchique supérieur.
        }
      }
      //
      // si le destinataire n'est pas d'un niveau hiérarchique supérieur
      if ($ok == 'OK')
      {
        $requete = "INSERT INTO " . $PREFIX_IM_TABLE . "CNT_CONTACT (ID_USER_1, ID_USER_2, CNT_STATUS, CNT_NEW_USERNAME) ";
        if (_SPECIAL_MODE_OPEN_COMMUNITY == "")
          $requete .= "VALUES (" . $id_user_1 . ", " . $id_user_2 . ", 0, '" . $msg . "') ";
        else
          $requete .= "VALUES (" . $id_user_1 . ", " . $id_user_2 . ", 5, '" . $msg . "') "; // on ajoute en masqué direct, sans attente validation
        //
        $result = mysql_query($requete);
        if (!$result) error_sql_log("[ERR-31f]", $requete);
        if ( f_is_deja_in_contacts_id($id_user_1, $id_user_2) == 1 )
          echo ">F20#OK####"; 
        else
          echo ">F20#KO####"; // deja dans la liste (peut être simplement en attente)
        //
        update_last_activity_user($id_user_1);
      }
    }
  }
  //
  mysql_close($id_connect);
}
?>