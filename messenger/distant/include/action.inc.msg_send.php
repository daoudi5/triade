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
if ( (!isset($_GET['u1'])) or (!isset($_GET['u2'])) or (!isset($_GET['s'])) or (!isset($_GET['m'])) or (!isset($_GET['ip'])) or (!isset($_GET['v'])) ) die();
//
$id_u_1 =	    intval(f_decode64_wd($_GET['u1']));
$id_u_1 = 		(intval($id_u_1) - intval($action));
$id_u_2 = 		intval(f_decode64_wd($_GET['u2']));
$id_session = intval(f_decode64_wd($_GET['s']));
$ip = 			  f_decode64_wd($_GET['ip']);
$n_version =	intval($_GET['v']);
$msg =        $_GET['m'];
if (isset($_GET['cr'])) $cr = $_GET['cr']; else $cr = ""; // optionnel (peut être vide, donc non déclaré)
//
if (preg_match("#[^0-9]#", $id_u_1)) $id_u_1 = "";
if (preg_match("#[^0-9]#", $id_u_2)) $id_u_2 = "";
if (preg_match("#[^0-9]#", $id_session)) $id_session = "";
//
if ( ($id_u_1 > 0) and ($id_u_2 > 0) and ($id_session > 0) and ($n_version > 0) and ($msg != "") and ($ip != "") )
{
  require ("../common/acces.inc.php");
  f_verif_ip($ip);
  //
  require ("../common/sql.inc.php");
  require ("../common/sessions.inc.php");
  //
  //if ( (f_verif_id_session_id_user($id_u_1, $id_session) != 'OK') or (f_verif_id_session_id_user($id_u_2, $id_ses2) != 'OK') )
  // ne plus tester la session, mais juste si 'online' (en cas de changement rapide de session)
  //
  if (f_verif_id_session_id_user($id_u_1, $id_session) != 'OK') 
  {
    die(">F40#KO#1#"); // 1:session non ouverte.
  }
  if ($id_u_2 <= 0)
      die(">F40#KO#6#"); // 6:pas de destinataire.
  //
  $is_offline = "";
  if (f_get_id_session_id_user($id_u_2) == 0)
  {
    if (_ALLOW_SEND_TO_OFFLINE_USER == '') 
      die(">F40#KO#1#"); // 1:session non ouverte.
    else
      $is_offline = "X";
  }
  //
  $msg_original = "";
  $msg_cr = $msg;
  if ($cr == '64') 
  {
    if ( (_CRYPT_MESSAGES == '') and ( (_CENSOR_MESSAGES != '') or (_LOG_MESSAGES != '') ) )
    {
      $msg = f_decode64_wd($msg);
      $msg_original = $msg;
      $msg_cr = "";
      $cr = "";
    }
  }
  else
  {
    $msg = str_replace("'", "`", $msg);
    $msg = str_replace('"', '`', $msg);
    $msg = str_replace("/", "", $msg);
  }
  $msg = trim($msg);
  //
  require ("../common/constant.inc.php");
  if ( $n_version < intval(_CLIENT_VERSION_MINI) )
  {
    die(">F40#KO#3#"); // 3:version incorrecte.
  }
  //
  $ok_send = "OK";
  $priv_u_1 = '';
  $priv_u_2 = '';
  //
  // on récupère l'état de privilège de l'auteur chez le contact destinataire :
  $requete  = " select CNT_STATUS ";
  $requete .= " from " . $PREFIX_IM_TABLE . "CNT_CONTACT ";
  $requete .= " WHERE ID_USER_1 = " . $id_u_2 . " ";
  $requete .= " and ID_USER_2 = " . $id_u_1 . " ";
  //$requete .= " and CNT_STATUS = 2 "; // si VIP chez le contact distant
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-50a]", $requete);
  if ( mysql_num_rows($result) == 1 )
  {
    list ($priv_u_2) = mysql_fetch_row ($result);
  }
  //
  if ( (_SPECIAL_MODE_OPEN_COMMUNITY == "") and (_SPECIAL_MODE_GROUP_COMMUNITY == "") )
  {
      if (intval($priv_u_2) <= 0)
        die(">F40#KO#7#"); // 7:pas dans ses contacts.
  }
  //
  // si mode invisible autorisé, et que les offlines ne sont pas autorisés.
  #if ( (_ALLOW_INVISIBLE != '') and (_ALLOW_SEND_TO_OFFLINE_USER == '') )
  #
  // si mode invisible autorisé
  if (_ALLOW_INVISIBLE != '')
  {
    // on récupère l'état de privilège du destinataire :
    $requete  = " select CNT_STATUS ";
    $requete .= " from " . $PREFIX_IM_TABLE . "CNT_CONTACT ";
    $requete .= " WHERE ID_USER_1 = " . $id_u_1 . " ";
    $requete .= " and ID_USER_2 = " . $id_u_2 . " ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-50b]", $requete);
    if ( mysql_num_rows($result) == 1 )
    {
      list ($priv_u_1) = mysql_fetch_row ($result);
    }
    //
    // si on est masqué pour le destinataire, on ne peut pas lui écrire (non mais).
    if ($priv_u_1 == '5')
    {
      echo ">F40#KO#4#";  // 4:utilisateur ne peut pas vour voir.
      $ok_send = "Ko";
    }
  }
  if ($ok_send == "OK")
  {
    $requete  = " select SES_STATUS, ID_SESSION ";
    $requete .= " FROM " . $PREFIX_IM_TABLE . "SES_SESSION SES, " . $PREFIX_IM_TABLE . "USR_USER USR ";
    $requete .= " WHERE SES.ID_USER = USR.ID_USER and USR.ID_USER = " . $id_u_2 . " ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-50c]", $requete);
    if ( mysql_num_rows($result) == 1 )
    {
      list ($etat_num, $id_ses) = mysql_fetch_row ($result);
      if ( ($etat_num != '1') and ($etat_num != '2') and ($etat_num != '3') )
      {
        if ($etat_num == '4') // si en mode ne pas dérange (rouge), on vérifie si VIP
        {
          if ($priv_u_2 != '2') // si n'est pas VIP chez le distant
            $ok_send = "Ko";
        }
        else
        {
          if (_ALLOW_SEND_TO_OFFLINE_USER == '') // si on a pas autorisé à envoyer en offline.
          {
            echo ">F40#KO#2#";  // 2:utilisateur indisponible.
            $ok_send = "Ko";
          }
        }
      }
    }
    else
    {
      if (_ALLOW_SEND_TO_OFFLINE_USER == '') // si on a pas autorisé à envoyer en offline.
      {
        echo(">F40#KO#1#"); // 1:session non ouverte.
        $ok_send = "Ko";
      }
      else
      {
        $get_offline = 0;
        $requete  = " select USR_GET_OFFLINE_MSG ";
        $requete .= " from " . $PREFIX_IM_TABLE . "USR_USER ";
        $requete .= " WHERE ID_USER = " . $id_u_2 . " ";
        $result = mysql_query($requete);
        if (!$result) error_sql_log("[ERR-50d]", $requete);
        if ( mysql_num_rows($result) == 1 )
        {
          list ($get_offline) = mysql_fetch_row ($result);
        }
        if ( (intval($get_offline) <= 0) or ( (intval($get_offline) == 1) and ($priv_u_2 != '2') ) )
        {
          echo(">F40#KO#2#"); // 2:utilisateur indisponible.
          $ok_send = "Ko";
        }
        // if $get_offline == 2 : OK.
      }
    }
  }
  //
  if ($ok_send == "OK")
  {
    // on censure les mots interdits par l'administrateur :
    if ( (_CRYPT_MESSAGES == '') and (_CENSOR_MESSAGES != '') and ($msg_original != "") )
    {
      if (is_readable("../common/config/censure.txt"))
      {
        require ("../common/words_filtering.inc.php");
        $msg = textCensure($msg, "../common/config/censure.txt");
      }
      //
      // si on veut s'amuser à traduire en ch'it :
      # require ("../common/words_chti.inc.php");
      # $msg = textChti($msg);
      //
    }
    //
    if ($cr == "")
    {
      $msg_cr = f_encode64($msg);
      $cr = "64";
    }
    //
    //
    //
    $requete = "INSERT INTO " . $PREFIX_IM_TABLE . "MSG_MESSAGE ( ID_USER_AUT, ID_USER_DEST, MSG_TEXT, MSG_CR, MSG_TIME, MSG_DATE) ";
    $requete .= "VALUES (" . $id_u_1 . ", " . $id_u_2 . ", '" . $msg_cr . "', '" . $cr . "', CURTIME(), CURDATE() ) ";
    $result = mysql_query($requete);
    if (!$result) error_sql_log("[ERR-50e]", $requete);
    //
    echo ">F40#OK#" . date("H:i:s") . "#"; // message bien envoyé
    if ( ($msg_original != "") and ($msg != $msg_original) ) echo $msg; // si le texte a été modifié, on le renvoit pour l'afficher tel que réellement envoyé.
    echo "#";
    if ($is_offline != "") echo "OL"; // OffLine
    echo "####";
    //
    //
    // si option de log (archivage) des messages échangé activé :
    if ( (_LOG_MESSAGES != '') and (_CRYPT_MESSAGES == '') )
    {
      // on récupère le username expéditeur :
      $username_1 = f_get_username_of_id($id_u_1);
      // on récupère le username destinataire :
      $username_2 = f_get_username_of_id($id_u_2);
      //
      $ip = $_SERVER['REMOTE_ADDR'];	
      //$username_and_domaine = gethostbyaddr("$ip") . ";";   //. gethostbyaddr("");
      $plus = $ip ; // .";". $username_and_domaine ;
      //
      $chemin = "log/" . "messages_log.txt" ;
      $fp = fopen($chemin, "a");
      if (flock($fp, 2));
      {
        fputs($fp,date("d/m/Y;H:i:s") . ";" . $username_1 . ";" . $username_2 . ";" . $msg . ";" . $plus ."\r\n");
      }
      flock($fp, 3);
      fclose($fp);
    }
    //
    update_last_activity_user($id_u_1);
    //
    if (_STATISTICS != "")
    {
      if (!function_exists('stats_inc')) require ("../common/stats.inc.php");
      stats_inc("STA_NB_MSG"); // nb messages send by days
    }
    //
  }
  else
    die(">F40#KO#0#"); // 0: car on ne sait pas pourquoi (au cas où)...
  //
  mysql_close($id_connect);
}
?>