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
if ( (!isset($_GET['u1'])) or (!isset($_GET['u2'])) or (!isset($_GET['s'])) or (!isset($_GET['ip'])) or (!isset($_GET['v'])) or (!isset($_GET['c'])) ) die();
//
$id_u_1 =	    intval(f_decode64_wd($_GET['u1']));
$id_u_1 = 		(intval($id_u_1) - intval($action));
$id_u_2 = 		intval(f_decode64_wd($_GET['u2']));
$id_session = intval(f_decode64_wd($_GET['s']));
$ip = 			  f_decode64_wd($_GET['ip']);
$check = 			f_decode64_wd($_GET['c']);
$version =	  intval($_GET['v']);
// optionnel :
if (isset($_GET['dt_f'])) $dt_f = $_GET['dt_f'];  else  $dt_f = "";  
//
$user_2 = "";
//if (isset($_GET['u_2'])) $user_2 = $_GET['u_2'];  // beta 2.0 (to remove later) /*-GIC
if (isset($_GET['u3']))  $user_2 = f_decode64_wd($_GET['u3']);
//
$id_conf = 0;
//if (isset($_GET['id_conf'])) $id_conf = intval($_GET['id_conf']); // beta 2.0 (to remove later) /*-GIC
if (isset($_GET['ic'])) $id_conf = intval(f_decode64_wd($_GET['ic']));
//
$check = Trim($check);
//
if (preg_match("#[^0-9]#", $id_u_1)) $id_u_1 = "";
if (preg_match("#[^0-9]#", $id_u_2)) $id_u_2 = "";
if (preg_match("#[^0-9]#", $id_session)) $id_session = "";
//
if ( ($id_u_1 > 0) and ($id_session > 0) and ($ip != "") )
{
  require ("../common/acces.inc.php");
  f_verif_ip($ip);
  //
  require ("../common/sql.inc.php");
  require ("../common/sessions.inc.php");
  //
  #if (!ctype_alnum($check))   $check = "";
  if (!ctype_alnum($dt_f))    $dt_f = "";  // apr�s functions.inc.php !
  //
  if (f_verif_id_session_id_user($id_u_1, $id_session) != 'OK')
  {
    die(">F42#KO#1#"); // la session est d�j� ferm�e (de celui qui consulte, donc presque impossible).
  }
  //
  $user_2  = f_clean_name($user_2); // apr�s functions.inc.php !
  if (f_verif_check_user_only($id_u_1, $check) == 'OK')
  {
    //
    // MODE Conf�rence
    //
    if ( ($id_conf > 0) and ($id_u_2 <= 0) )
    {
      // on v�rifie que le receveur est bien dans la conf�rence, et actif.
      $requete  = " select ID_USER ";
      $requete .= " FROM " . $PREFIX_IM_TABLE . "USC_USERCONF ";
      $requete .= " WHERE ID_CONFERENCE = " . $id_conf;
      $requete .= " AND ID_USER = " . $id_u_1;
      $requete .= " AND USC_ACTIVE = 1 "; // 
      $result = mysql_query($requete);
      if (!$result) error_sql_log("[ERR-51a]", $requete);
      if ( mysql_num_rows($result) == 1 ) // normalement pas plus...
      {
        $requete  = " SELECT MSG_TEXT, MSG_TIME, MSG_DATE, ID_MESSAGE, ID_USER_AUT, MSG_CR ";
        $requete .= " FROM " . $PREFIX_IM_TABLE . "MSG_MESSAGE ";
        $requete .= " where ID_CONFERENCE = " . $id_conf ; // message de conf�rence.
        $requete .= " and ID_USER_DEST = " . $id_u_1;
        $requete .= " order by ID_MESSAGE ";
        $result = mysql_query($requete);
        if (!$result) error_sql_log("[ERR-51b]", $requete);
        if ( mysql_num_rows($result) > 0 )
        {
          list ($msg, $heure, $dt_msg, $id_msg, $id_u_2, $cr) = mysql_fetch_row ($result);  // on ne parcours pas pour n'en afficher qu'un � la fois.
          $dt_form = "d/m/Y"; // FR
          if ($dt_f == 'EN') $dt_form = "m-d-Y";
          $dt_msg = date($dt_form, strtotime($dt_msg));
          if ($cr == "")
          {
            $cr = "64";
            $msg = f_encode64($msg);
          }
          //$user_2 = f_get_username_of_id($id_u_2); // oblig� en message de conf�rence.
          if ( f_is_deja_in_contacts_id($id_u_1, $id_u_2) <= 0 ) $id_u_2 = f_get_username_of_id($id_u_2); // conf�rence, hors contact.
          //
          // si exp�di� un autre jour (peut propable en conf�rence)
          if ( $dt_msg != date($dt_form) )
            echo ">F42#OK#" . $msg . "#" . $dt_msg . "#" . f_encode64($id_u_2) . "#" . $cr . "##"; 
          else
            echo ">F42#OK#" . $msg . "#" . $heure  . "#" . f_encode64($id_u_2) . "#" . $cr . "##"; 
          //
          // on efface le message dans la foul�e qu'on la envoy�
          $requete = "delete from " . $PREFIX_IM_TABLE . "MSG_MESSAGE ";
          $requete .= "where ID_MESSAGE = " . $id_msg . " ";
          $result = mysql_query($requete);
          if (!$result) error_sql_log("[ERR-51c]", $requete);
        }
        else
        {
          echo ">F42#OK###"; // pas de message 
        }
      }
    }
    else
    {
      //
      // MODE dialogue direct (hors conf�rence)
      //
      if ($id_u_2 <= 0) // si expediteur offline
      {
        if ($user_2 != '')
        {
          // on recherche l'id par rapport au pseudo
          $id_u_2 = f_get_id_nom_user($user_2);
          // si pas trouv� le username, ou essai avec le pseudo
          if ($id_u_2 <= 0)
            $id_u_2 = f_get_id_of_renamed_nickname($user_2);
          //
          // par mesure de s�curit�, vu que c'est pour r�cup�rer un message offline, il v�rifie qu'il est bien offline
          if (intval(f_get_id_session_id_user($id_u_2)) > 0)
            $id_u_2 = 0;
        }
      }
      //
      if ($id_u_2 > 0)
      {
        $requete  = " SELECT MSG_TEXT, MSG_TIME, MSG_DATE, ID_MESSAGE, MSG_CR ";
        $requete .= " FROM " . $PREFIX_IM_TABLE . "MSG_MESSAGE ";
        $requete .= " where ID_USER_AUT = " . $id_u_2;
        $requete .= " and ID_USER_DEST = " . $id_u_1;
        $requete .= " and ID_CONFERENCE = 0 ";
        $requete .= " order by ID_MESSAGE ";
        $result = mysql_query($requete);
        if (!$result) error_sql_log("[ERR-51d]", $requete);
        if ( mysql_num_rows($result) > 0  )
        {
          list ($msg, $heure, $dt_msg, $id_msg, $cr) = mysql_fetch_row ($result);  // on ne parcours pas pour n'en afficher qu'un � la fois.
          $dt_form = "d/m/Y"; // FR
          if ($dt_f == 'EN') $dt_form = "m-d-Y";
          $dt_msg = date($dt_form, strtotime($dt_msg));
          if ($cr == "")
          {
            $cr = "64";
            $msg = f_encode64($msg);
          }
          //
          // si exp�di� un autre jour
          if ($dt_msg != date($dt_form) )
            echo ">F42#OK#" . $msg . "#" . $dt_msg . "##" . $cr .  "##"; 
          else
            echo ">F42#OK#" . $msg . "#" . $heure  . "##" . $cr .  "##"; 
          //
          // on efface le message dans la foul�e qu'on la envoy�
          $requete  = " delete from " . $PREFIX_IM_TABLE . "MSG_MESSAGE ";
          $requete .= " where ID_MESSAGE = " . $id_msg;
          $result = mysql_query($requete);
          if (!$result) error_sql_log("[ERR-51e]", $requete);
        }
        else
        {
          $etat_num = 0;
          $etat_away = 0;
          // si pas de message, alors on indique qu'il n'y a pas de message en attente, et on r�cup�re l'�tat du correspondant.
          $requete  = " select SES_STATUS, SES_AWAY_REASON ";
          $requete .= " FROM " . $PREFIX_IM_TABLE . "SES_SESSION SES, " . $PREFIX_IM_TABLE . "USR_USER USR ";
          $requete .= " WHERE SES.ID_USER = USR.ID_USER ";
          $requete .= " and USR.ID_USER = " . $id_u_2;
          $result = mysql_query($requete);
          if (!$result) error_sql_log("[ERR-51f]", $requete);
          if ( mysql_num_rows($result) == 1 )
          {
            list ($etat_num, $etat_away) = mysql_fetch_row ($result);
          }
          echo ">F42#OK##h#" . $etat_num . "#" . $etat_away . "####"; // pas de message : attention, renvoyer OK suivi de vide (##) (h pour l'heure, on s'en fou) et surtout l'�tat.
        }
        //
        update_last_activity_user($id_u_1);
      }
      else
      {
        echo ">F42#OK###"; // pas de message 
      }
    }
  }
  else
    write_log("error_check_get_msg", $id_u_1 . "   " . $check);
  //
  mysql_close($id_connect);
}
?>