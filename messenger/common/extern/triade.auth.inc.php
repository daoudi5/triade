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

define("_EXTERNAL_AUTHENTICATION_NAME", "Triade");

function f_external_authentication($t_user, $t_pass)
{
  $t_verif_pass = "Ko";
  $passcr = crypt(md5($t_pass),"T2");
  $nom = "";
  $prenom = "";
  $try_to_hack = "";
  //
  // le login est au format nom.prenom : on le décompose
  $t = strpos($t_user, ".");
  if (strval($t) > 1)
  {
    $nom = substr($t_user, 0, $t);
    $prenom = substr($t_user, $t+1, strlen($t_user) -$t);
    $nom = trim($nom);
    $prenom = trim($prenom);
    $nom = str_replace('_',' ',$nom);
    $prenom = str_replace('_',' ',$prenom);
    if ( ($nom != "") and ($prenom != "") )
    {
      require("../common/config/extern.config.inc.php");
      //
      if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
      {
        // Si Triade n'est pas sur le même serveur ou la même base de donnée.
        mysql_close();
        require("extern.sql.inc.php");
      }
      //
      if ($do_not_use_school_members == "")
      {
        $requete  = " select LOWER(nom), LOWER(prenom), passwd_eleve FROM " . $extern_prefix . "eleves ";
        $requete .= " WHERE LOWER(nom) = '" . $nom . "' ";
        $requete .= " and LOWER(prenom) = '" . $prenom . "' ";
        //
        $result = mysql_query($requete);
        if (!$result) error_sql_log("[ERR-T56b]", $requete);
        if ( mysql_num_rows($result) == 1 )
        {
          list ($nom_extern, $prenom_extern, $pass_extern) = mysql_fetch_row ($result);
          if ( ($nom_extern == $nom) and ($prenom_extern == $prenom) )
          {
            if ($pass_extern == $passcr) 
              $t_verif_pass = "OK";
            else
              $try_to_hack = "!!!";
          }
        }
      }
      //
      if ( ($do_not_use_student == "") and ($t_verif_pass != "OK") and ($try_to_hack == "") )
      {
        $requete  = " select LOWER(nom), LOWER(prenom), mdp FROM " . $extern_prefix . "personnel ";
        $requete .= " WHERE LOWER(nom) = '" . $nom . "' ";
        $requete .= " and LOWER(prenom) = '" . $prenom . "' ";
        //$requete .= " and (type_pers = 'ADM' or type_pers = 'ENS' or type_pers = 'MVS' or type_pers = 'TUT' ) ";
        //
        $result = mysql_query($requete);
        if (!$result) error_sql_log("[ERR-T56a]", $requete);
        if ( mysql_num_rows($result) > 0 )
        {
          while( list ($nom_extern, $prenom_extern, $pass_extern) = mysql_fetch_row ($result) )
          {
            if ( ($nom_extern == $nom) and ($prenom_extern == $prenom) and ($pass_extern == $passcr) )
              $t_verif_pass = "OK";
          }
        }
      }
      //
      if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
      {
        mysql_close($id_connect_extern);
        require("sql.2.inc.php");
      }
    }
  }
  //
  return $t_verif_pass;
}






function f_triade_auth_to_phenix($t_user, $t_pass)
{
  $user_phenix_triade = "";
  $passcr = crypt(md5($t_pass),"T2");
  $nom = "";
  $prenom = "";
  //
  // le login est au format nom.prenom : on le décompose
  $t = strpos($t_user, ".");
  if (strval($t) > 1)
  {
    $nom = substr($t_user, 0, $t);
    $prenom = substr($t_user, $t+1, strlen($t_user) -$t);
    $nom = trim($nom);
    $prenom = trim($prenom);
    $nom = str_replace('_',' ',$nom);
    $prenom = str_replace('_',' ',$prenom);
    if ( ($nom != "") and ($prenom != "") )
    {
      require("../common/config/extern.config.inc.php");
      //
      if ($phenix_include_in_triade != "")
      {
        if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
        {
          // Si Triade n'est pas sur le même serveur ou la même base de donnée.
          mysql_close();
          require("extern.sql.inc.php");
        }
        //
        if ($do_not_use_school_members == "")
        {
          $requete  = " select LOWER(nom), LOWER(prenom), passwd_eleve, elev_id FROM " . $extern_prefix . "eleves ";
          $requete .= " WHERE LOWER(nom) = '" . $nom . "' ";
          $requete .= " and LOWER(prenom) = '" . $prenom . "' ";
          //
          $result = mysql_query($requete);
          if (!$result) error_sql_log("[ERR-T56c]", $requete);
          if ( mysql_num_rows($result) == 1 )
          {
            list ($nom_extern, $prenom_extern, $pass_extern, $id_extern) = mysql_fetch_row ($result);
            if ( ($nom_extern == $nom) and ($prenom_extern == $prenom) and ($pass_extern == $passcr) )
            {
              $user_phenix_triade = "OK";
            }
          }
        }
        //
        if ( ($do_not_use_student == "") and ($user_phenix_triade != "OK") )
        {
          $requete  = " select LOWER(nom), LOWER(prenom), mdp, pers_id, type_pers FROM " . $extern_prefix . "personnel ";
          $requete .= " WHERE LOWER(nom) = '" . $nom . "' ";
          $requete .= " and LOWER(prenom) = '" . $prenom . "' ";
          //$requete .= " and (type_pers = 'ADM' or type_pers = 'ENS' or type_pers = 'MVS' or type_pers = 'TUT' ) ";
          //
          $result = mysql_query($requete);
          if (!$result) error_sql_log("[ERR-T56d]", $requete);
          if ( mysql_num_rows($result) > 0 )
          {
            while( list ($nom_extern, $prenom_extern, $pass_extern, $id_extern, $type_pers) = mysql_fetch_row ($result) )
            {
              if ( ($nom_extern == $nom) and ($prenom_extern == $prenom) and ($pass_extern == $passcr) )
              {
                $requete  = " select membre FROM " . $extern_prefix . "types_personnel ";
                $requete .= " WHERE type_pers = '" . $type_pers . "' "; 
                $result = mysql_query($requete);
                if (!$result) error_sql_log("[ERR-T56e]", $requete);
                if ( mysql_num_rows($result) == 1 )
                {
                  list ($type) = mysql_fetch_row ($result);
                  $user_phenix_triade = $type . $id_extern;
                }
              }
            }
          }
        }
        //
        if ( ($extern_dbhost != '') and ($extern_database != '') and ($extern_dbuname != '') )
        {
          mysql_close($id_connect_extern);
          require("sql.2.inc.php");
        }
      }
    }
  }
  //
  return $user_phenix_triade;
}
?>