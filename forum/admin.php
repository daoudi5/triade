<html>
<head>
<title>Interface d'administration du forum Triade</title>
<META http-equiv="CacheControl" content = "no-cache">
<META http-equiv="pragma" content = "no-cache">
<META http-equiv="expires" content = -1>
<meta name="Copyright" content="Triade�, 2001">
<LINK TITLE="style" TYPE="text/CSS" rel="stylesheet" HREF="../librairie_css/css.css">
<script language="JavaScript" src="../librairie_js/clickdroit2.js"></script>
<script language="JavaScript" src="../librairie_js/function.js"></script>
</head>
<body bgcolor="#ffffff">

<?php


// #############################################################################
// =============================================================================
// FouleTexte 1.5 - (c) 2000 Thierry Arsicaud (deltascripts@ifrance.com)
// =============================================================================
//
//
// *****************************************************************************
// Cr�ation du fichier "index.dat" s'il n'existe pas encore
// *****************************************************************************

global $repForum;

if (isset($_GET["repforum"])) {
	$repForum=$_GET["repforum"];
}
if (isset($_POST["repforum"])) {
	$repForum=$_POST["repforum"];
}

if ( ! file_exists("../data/forum") ) {
	@mkdir("../data/forum",0755);
	$text="<Files \"*\">\n";
	$text.="Order Deny,Allow\n";
	$text.="Deny from all\n";
	$text.="</Files>";
	$fp = fopen("../data/forum/.htaccess", "w");
	fwrite($fp,$text);
	fclose($fp);
}

$reperForum="../data/forum/$repForum";

if ( ! file_exists($reperForum) ) {
	@mkdir("$reperForum",0755);
	$text="<Files \"*\">\n";
	$text.="Order Deny,Allow\n";
	$text.="Deny from all\n";
	$text.="</Files>";
	$fp = fopen("${reperForum}/.htaccess", "w");
	fwrite($fp,$text);
	fclose($fp);
}


if (!file_exists("${reperForum}/index.dat")) {
  $crfic=fopen("${reperForum}/index.dat","w+");
  fputs($crfic,"Fichier Index. Ne pas �diter !");
  fclose($crfic);
}

if (isset($_POST["mdputil"])) { $mdputil=$_POST["mdputil"]; }
if (isset($_POST["idaction"])) {$idaction=$_POST["idaction"]; }
if (isset($_POST["pass"])) { $pass=$_POST["pass"]; }
if (isset($_POST["idmsgsup"])) { $idmsgsup=$_POST["idmsgsup"]; }
if (isset($_POST["rangsupmin"])) { $rangsupmin=$_POST["rangsupmin"]; }
if (isset($_POST["rangsupmax"])) { $rangsupmax=$_POST["rangsupmax"]; }


if(!isset($_POST["idaction"])) $idaction="";
if(!isset($_POST["pass"])) $pass="";


// #############################################################################
// *****************************************************************************
// D�finition de diverses fonctions, utilis�es par la suite dans le script
// *****************************************************************************
// =============================================================================
// D�finition de la fonction ROT13, utilis�e pour le codage/d�codage du mot de passe
// =============================================================================

 function ROT13($chaine) {
  $chaine=strtolower($chaine);
  $chainecod="";
  $longueurchaine=strlen($chaine);
  for ($compt=0;$compt<$longueurchaine;$compt++) {
    $caract1=substr($chaine,$compt,1);
    $codecaract1=ord($caract1);
    if (($codecaract1>=97) and ($codecaract1<=122)) {
      if ($codecaract1<=109) {
        $codecaract2=$codecaract1+13;
      }
      else {
        $codecaract2=$codecaract1-13;
      }
    }
    else {
      $codecaract2=$codecaract1;
    }
    $caract2=chr($codecaract2);
    $chainecod=$chainecod.$caract2;
  }
  return($chainecod);
}

// =============================================================================
// D�finition de la fonction "tabulation", utilis�e pour mat�rialiser
// la hierarchie du forum
// =============================================================================

function tabulation($n=1) {
  $espacevide=(30*($n-1)+40);
  return($espacevide);
}

// =============================================================================
// D�finition de la fonction ImprimFormInterrogMDP() qui imprime le formulaire
// correspondant � la demande "Veuillez entrer le mot de passe"
// =============================================================================

function ImprimFormInterrogMDP() {
  global $repForum;
  print("<center> \n");
  print("<form method=\"POST\" action=\"admin.php\"> \n");
  print("Mot de passe :<br> \n");
  print("<input type=\"password\" name=\"mdputil\" size=\"30\"><input type=\"hidden\" name=\"repforum\" value=\"$repForum\"><br>");
  print("<input type=\"hidden\" name=\"idaction\" value=\"verifMDP\"> \n");
  print("<br> \n");
  print("<input type=\"submit\" value=\"Envoyer\" name=\"A1\">");
  print("</form>");
  print("</center>");
}

// =============================================================================
// D�finition de la fonction ImprimFormChoixMDP() qui imprime le formulaire correspondant
// � la demande "Veuillez choisir votre mot de passe"
// =============================================================================

function ImprimFormChoixMDP() {
  global $pass;  // en cas de demande de changement de mot de passe
  global $repForum;
  print("<center> \n");
  print("<form method=\"POST\" action=\"admin.php\"> \n");
  print("Choix du mot de passe : <br> \n");
  print("<input type=\"password\" name=\"mdputil1\" size=\"10\"><br> \n");
  print("Veuillez le ressaisir pour confirmation : <br> \n");
  print("<input type=\"password\" name=\"mdputil2\" size=\"10\"><br> \n");
  print("<input type=\"hidden\" name=\"pass\" value=\"$pass\"><input type=\"hidden\" name=\"repforum\" value=\"$repForum\"> \n");
  print("<input type=\"hidden\" name=\"idaction\" value=\"testChoixMDP\"> \n");
  print("<br><input type=\"submit\" value=\"Envoyer\" name=\"A1\">");
  print("</form>");
  print("</center>");
}
// #############################################################################
?>

<?php
// #############################################################################
// *****************************************************************************
// R�cup�ration du mot de passe (si un mot de passe a d�j� �t� choisi
// par l'administrateur du forum de discussion)
// *****************************************************************************

if(file_exists("../common/mdep.php")) {
  include("../common/mdep.php");
  // Note : le mot de passe est stock� dans la valeur "$MDP"
}
// #############################################################################
?>

<?php
// #############################################################################
// *****************************************************************************
// *****************************************************************************
// Modules de choix et de v�fification du mot de passe
// *****************************************************************************
// *****************************************************************************

// *****************************************************************************
// MODULE idaction=""
// cas de figure o� IDaction n'est pas renseign� (premier lancement du script) :
// V�rifie si un mot de passe a d�j� �t� choisi
// - si non : imprime le formulaire de choix de mot de passe
// - si oui : imprime le formulaire d'interrogation de mot de passe
// *****************************************************************************

if ($idaction=="") {

  if(!file_exists("../common/mdep.php")) {
  // aucun mot de passe n'a �t� choisi
    print("<center> \n");
    print("<br> \n");
    print("<font size=\"+1\"><b>Bienvenue sur l'interface d'administration<br>du forum de discussion</b></font> \n");
    print("<br><br> \n");
    print("Veuillez choisir le mot de passe administrateur. <br><br> \n");
    print("Ce mot de passe vous sera demand� chaque fois<br>que vous souhaiterez acc�der � cette interface, notamment<br> \n");
    print("si vous d�cidez de supprimer certains messages post�s par les utilisateurs. <br><br> \n");
    print("</center> \n");

    ImprimFormChoixMDP();
  }

  else {
  // un mot de passe a d�j� �t� choisi et enregistr�
    print("<center> \n");
    print("<br> \n");
    print("<font size=\"+1\"><b>Bienvenue sur l'interface d'administration<br>du forum de discussion</b></font> \n");
    print("<br><br> \n");
    print("Veuillez vous identifier SVP. <br> \n");
    print("</center> \n");
    print("<br> \n");
    ImprimFormInterrogMDP();
  }
}

// *****************************************************************************
// Module idaction="testChoixMDP" :
// V�rifie si les deux valeurs "Mot de Passe"  entr�es par l'utilisateur sont
// �quivalentes
// - si non : envoie un message d'avertissement et imprime � nouveau
// le formulaire de choix du mot de passe
// - si oui : enregistre le mot de passe dans le fichier mdep.php et cr�e
// la variable "$pass" n�cessaire pour acc�der au menu des actions possibles
// *****************************************************************************

if ($idaction=="testChoixMDP") {

   // conversion des deux valeurs en minuscule
   $mdputil1=strtolower($mdputil1);
   $mdputil2=strtolower($mdputil2);

  if(file_exists("../common/mdep.php") and $pass!=ROT13($MDP)) {
    // protection contre des appels du script destin�s � "faire sauter"
    // le mot de passe
    print("Erreur : Veuillez vous <a href=\"admin.php\">identifier</a> � nouveau.");
    exit;
  }

  if($mdputil1=="") {
    // cas de figure o� l'utilisateur a valid� le formulaire pr�c�dent
    // sans entrer de valeurs
    print("<br> \n");
    print("<center> \n");
    print("Veillez recommencer l'op�ration SVP.");
    print("</center> \n");
    ImprimFormChoixMDP();
    exit;
  }

  if ($mdputil1!=$mdputil2) {
  // cas de figure o� les deux valeurs entr�es par l'utilisateur ne coincident pas
    print("<center> \n");
    print("<br> \n");
    print("Les deux valeurs que vous avez entr�es ne coincident pas. Veuiller recommencer SVP. <br> \n");
    print("</center>");
    ImprimFormChoixMDP();
  }

  else {
  // cas de figure o� les deux valeurs entr�es par l'utilisateur coincident

    // --- Enregistrement du mot de passe dans le fichier mdep.php
    $ficmdep=fopen("../common/mdep.php","w+");
    fputs($ficmdep,"<?php \n");
    fputs($ficmdep,"\$MDP=\"$mdputil1\"; \n");
    fputs($ficmdep,"?>");
    fclose($ficmdep);

    // D�finition de la valeur "$pass", qui sera n�cessaire pour les
    // op�rations de configuration ou de suppression de messages
    // Note : "$pass" est produit � partir du mot de passe (cod�)

    $MDP=$mdputil1;
    $MDPcode=ROT13($MDP);

    // --- Affichage d'un message de confirmation et impression
    // d'un bouton "Passage � la suite".

    print("<center> \n");
    print("<br> \n");
    print("Le mot de passe a bien �t� enregistr�. <br> \n");
    print("<form method=\"POST\" action=\"admin.php\"> \n");
    print("<input type=\"hidden\" name=\"idaction\" value=\"menuGen\"> \n");
    print("<input type=\"hidden\" name=\"pass\" value=\"$MDPcode\"><input type=\"hidden\" name=\"repforum\" value=\"$repForum\"> \n");
    print("<input type=\"submit\" value=\"Passer � la suite\" name=\"A1\"> \n");
    print("</form> \n");
    print("</center> \n");
  }
}

// *****************************************************************************
// MODULE idaction="verifMDP" :
// V�rifie si le mot de passe entr� par l'utilisateur est correct
// - si non : envoie un message d'avertissement et imprime � nouveau
// le formulaire d'interrogration du mot de passe
// - si oui : cr�e la variable "$pass" n�cessaire pour acc�der au menu
// des actions possibles
// *****************************************************************************

if ($idaction=="verifMDP") {

  // la valeur entr�e par l'utilisateur est convertie en minuscules
  $mdputil=$_POST["mdputil"];
  $mdputil=strtolower($mdputil);

  if(crypt(md5($mdputil),"T2")!=$MDP) {
  // cas de figure o� la valeur entr�e par l'utilisateur n'est pas correcte
    print("<center> \n");
    print("<br> \n");
    print("Le mot de passe entr� n'est pas valable. Veuillez � nouveau vous identifier.");
    print("</center> \n");
    ImprimFormInterrogMDP();
  }

  else {
  // cas de figure o� la valeur entr�e par l'utilisateur correspond au mot de passe
      $idaction="menuGen";
      $MDPcode=ROT13($MDP);
      $pass=$MDPcode;
  // -------------------------------------------
  // ------ On passe � la suite du script ------
  // -------------------------------------------
  }
}


// #############################################################################
// *****************************************************************************
// *****************************************************************************
// Modules correspondant aux fonctions d'administration
// *****************************************************************************
// *****************************************************************************

// *****************************************************************************
// Module idaction="menuGen" :
// Affiche le menu g�n�ral des actions possibles
// *****************************************************************************

if ($idaction=="menuGen") {
  if ($pass!=ROT13($MDP)) {
    print("Erreur : Veuillez vous <a href=\"admin.php\">identifier</a> � nouveau.");
  }
  else {
    print("<center> \n");
    print("<br> \n");
    print("<b>MENU GENERAL :</b><br><br> \n");
    print("Vous pouvez accomplir les actions d'administration suivantes : <br><br> \n");
    print("<form method=\"POST\" action=\"admin.php\"><input type=\"hidden\" name=\"idaction\" value=\"menuSupMsgs\"><input type=\"hidden\" name=\"pass\" value=\"$pass\"><input type=\"hidden\" name=\"repforum\" value=\"$repForum\"><input type=\"submit\" value=\"1/  Supprimer des messages\" name=\"A1\">
	    <br /><br /><input type=\"button\" value=\"2/  Quitter ce module\" onclick='parent.window.close();'>
	    </form> \n");
//    print("<form method=\"POST\" action=\"admin.php\"><input type=\"hidden\" name=\"idaction\" value=\"menuChangeMDP\"><input type=\"hidden\" name=\"pass\" value=\"$pass\"><input type=\"submit\" value=\"2/  Changer le mot de passe\" name=\"A2\"></form> \n");
    print("</center> \n");
  }
}

// *****************************************************************************
// Module idaction="menuSupMsgs" :
// Affiche le menu "Suppression de messages"
// *****************************************************************************

if ($idaction=="menuSupMsgs") {
  if ($pass!=ROT13($MDP)) {
    print("Erreur : Veuillez vous <a href=\"admin.php\">identifier</a> � nouveau.");
  }
  else {

    // ==========================================================================
    // Lecture du fichier "index.dat" et stockage des donn�es (identifiant,
    // niveau, date, nom et sujet) dans le tableau "$index"
    // ==========================================================================

    $tabindex=file("${reperForum}/index.dat");
    $nombremsgs=count($tabindex)-1;

    for($compt=1;$compt<=$nombremsgs;$compt++) {
      $index[$compt][1]=strtok($tabindex[$compt],"#"); // identifiant du message
      $index[$compt][2]=strtok("#");                   // niveau du message
      $chainetemp=strtok("#");                         // chaine date+nom+sujet
      $index[$compt][3]=strtok($chainetemp,"|");       // date
      $index[$compt][4]=strtok("|");                   // nom de l'auteur
      $index[$compt][5]=strtok("|");                   // sujet
    }

    // ==========================================================================
    // Cas de figure o� aucun message n'a  encore �t� post� dans le forum de discussion
    // ==========================================================================

    if($nombremsgs<1) {
      print("<br> \n");
      print("<center> \n");
      print("Aucun message n'a �t� post� dans ce forum de discussion. <br> \n");
      print("<form method=\"POST\" action=\"admin.php\"><input type=\"hidden\" name=\"idaction\" value=\"menuGen\"><input type=\"hidden\" name=\"pass\" value=\"$pass\"><input type=\"hidden\" name=\"repforum\" value=\"$repForum\"><input type=\"submit\" value=\"Retour au menu g�n�ral\" name=\"A1\"></form> \n");
      print("</center> \n");
      exit;
    }

    // ==========================================================================
    // Message d'explication destin� � l'utilisateur
    // ==========================================================================

    print("<br> \n");
    print("<center><b><font size=\"+1\">Suppression de messages</font></b></center><br> \n");

    print("<center>Le tableau suivant affiche la liste des messages post�s dans le forum de discussion.<br> \n");
    print("Note : les sujets de discussion sont affich�s ici <b>des plus anciens aux plus r�cents</b>.</center><br> \n");

    // ==========================================================================
    // Affichage des intitul�s des messages dans un tableau (utilisant les
    // param�tres pr�cis�s plus haut)
    // ==========================================================================

    print("<table border=\"1\" align=\"center\"> \n");

    print("<tr><td bgcolor=\"#eeeeee\"><center><b>&nbsp;Ident.&nbsp;</b></center></td><td bgcolor=\"#eeeeee\"><b><center>INTITULE du message</center></b></td></tr> \n");

      for($compt=1;$compt<=$nombremsgs;$compt++) {

        // insertion d'un tableau � une ligne et deux colonnes
        // destin� � mat�rialiser la hierarche du forum

        print("<tr> \n");

        print("<td bgcolor=\"#eeeeee\"> \n");
        print("<center>".$index[$compt][1]."</center>");
        print("</td> \n");

        print("<td> \n");
        print("<table border=\"0\"> \n");
        print("<tr> \n");
        print("<td width=\"".tabulation($index[$compt][2]-1)."\"></td> \n");
        print("<td> \n");
        if($index[$compt][2]==1) {
          print("# \n");
        }
        else {
          print("> \n");
        }
        print("<b>".stripslashes(htmlentities(strip_tags($index[$compt][5])))."</b> - ");
        print("<b>".stripslashes(htmlentities(strip_tags($index[$compt][4])))."</b> (".$index[$compt][3].") <br> \n");
        print("</td> \n");
        print("</tr> \n");
        print("</table> \n");
        print("</td> \n");

        print("</tr> \n");
      }

    print("</table> \n");

    // ==========================================================================
    // Impression d'un message d'avertissement et du formulaire de saisie
    // d'identifiant de message � supprimer
    // ==========================================================================

    print("<br> \n");
    print("<table cellpadding=\"5\" border=\"1\" bgcolor=\"#fffff0\" align=\"center\"> \n");
    print("<tr><td align=\"center\"> \n");
    print("Pour supprimer un message du forum,<br> entrez ici son <b>num�ro d'identification</b> : <br> \n");
    print("<form method=\"POST\" action=\"admin.php\"> \n");
    print("<input type=\"text\" name=\"idmsgsup\" size=\"5\"><br> \n");
    print("<input type=\"hidden\" name=\"idaction\" value=\"demandConfirmSuppMsg\"> \n");
    print("<input type=\"hidden\" name=\"pass\" value=\"$pass\"> \n");
    print("<input type=\"hidden\" name=\"repforum\" value=\"$repForum\"> \n");
    print("<br> \n");
    print("<input type=\"submit\" value=\"Envoyer\" name=\"A1\">");
    print("</form> \n");
    print("<b>Attention !</b> la suppression d'un message entraine automatiquement<br> la suppression des messages qui le suivent dans le fil de discussion<br>(m�me sujet de discussion). \n");
    print("</td></tr> \n");
    print("</table> \n");
    print("<br> \n");
    print("<center> \n");
    print("<form method=\"POST\" action=\"admin.php\"><input type=\"hidden\" name=\"idaction\" value=\"menuGen\"><input type=\"hidden\" name=\"pass\" value=\"$pass\"><input type=\"hidden\" name=\"repforum\" value=\"$repForum\"><input type=\"submit\" value=\"  Retour au menu g�n�ral  \" name=\"A1\"></form> \n");
    print("</center> \n");
  }
}

// *****************************************************************************
// Module idaction="demandConfirmSuppMsg" :
// Affiche la page de demande de confirmation de suppression
// *****************************************************************************

if ($idaction=="demandConfirmSuppMsg") {
  if ($pass!=ROT13($MDP)) {
    print("Erreur : Veuillez vous <a href=\"admin.php\">identifier</a> � nouveau.");
  }
  else {

    // ==========================================================================
    // Lecture du fichier "index.dat" et stockage des donn�es (identifiant,
    // niveau, date, nom et sujet) dans le tableau "$index"
    // ==========================================================================

    $tabindex=file("${reperForum}/index.dat");
    $nombremsgs=count($tabindex)-1;

    for($compt=1;$compt<=$nombremsgs;$compt++) {
      $index[$compt][1]=strtok($tabindex[$compt],"#"); // identifiant du message
      $index[$compt][2]=strtok("#");                   // niveau du message
      $chainetemp=strtok("#");                         // chaine date+nom+sujet
      $index[$compt][3]=strtok($chainetemp,"|");       // date
      $index[$compt][4]=strtok("|");                   // nom de l'auteur
      $index[$compt][5]=strtok("|");                   // sujet
    }


    // ==========================================================================
    // Cas de figure o� l'utilisateur a entr� une "valeur vide"
    // ==========================================================================

    if($idmsgsup=="") {
      print("<br> \n");
      print("<center> \n");
      print("Erreur ! Vous n'avez saisi aucune valeur. <br> \n");
      print("<form method=\"POST\" action=\"admin.php\"><input type=\"hidden\" name=\"idaction\" value=\"menuSupMsgs\"><input type=\"hidden\" name=\"pass\" value=\"$pass\"><input type=\"hidden\" name=\"repforum\" value=\"$repForum\"><input type=\"submit\" value=\"Retour au menu de suppression de messages\" name=\"A1\"></form> \n");
      print("</center> \n");
      exit;
    }

    // ==========================================================================
    // Cas de figure o� le num�ro de message � supprimer est aberrant
    // ==========================================================================

    if(($idmsgsup<0) or (!file_exists("${reperForum}/msg".$idmsgsup.".dat"))) {
      print("<br> \n");
      print("<center> \n");
      print("Erreur ! Ce message n'existe pas<br> ou a d�j� �t� supprim� par l'administrateur du forum de discussion. <br> \n");
      print("<form method=\"POST\" action=\"admin.php\"><input type=\"hidden\" name=\"idaction\" value=\"menuSupMsgs\"><input type=\"hidden\" name=\"pass\" value=\"$pass\"><input type=\"hidden\" name=\"repforum\" value=\"$repForum\"><input type=\"submit\" value=\"Retour au menu de suppression de messages\" name=\"A1\"></form> \n");
      print("</center> \n");
      exit;
    }

    // ==========================================================================
    // Cas de figure o� le message a d�j� �t� supprim� par l'administrateur
    // ==========================================================================

    if(!file_exists("${reperForum}/msg".$idmsgsup.".dat")) {
      print("Ce message a d�j� �t� supprim� par l'administrateur. <br> \n");
      print("<form method=\"POST\" action=\"admin.php\"><input type=\"hidden\" name=\"idaction\" value=\"menuSupMsgs\"><input type=\"hidden\" name=\"pass\" value=\"$pass\"><input type=\"hidden\" name=\"repforum\" value=\"$repForum\"><input type=\"submit\" value=\"Retour au menu de suppression de messages\" name=\"A1\"></form> \n");
      exit;
    }

    // ==========================================================================
    // Recherche du rang du premier message � supprimer
    // ==========================================================================

    $rangMsgSupP=1;

    while(@ $index[$rangMsgSupP][1]!=$idmsgsup) {
      $rangMsgSupP++;
    }

    // le rang du premier message � supprimer est stock� dans $rangMsgSupP

    // ==========================================================================
    // Recherche du rang du dernier message � supprimer
    // ==========================================================================

    $rangMsgSupD=$rangMsgSupP;

    while(@ $index[$rangMsgSupD+1][2]>$index[$rangMsgSupP][2]) {
      $rangMsgSupD++;
    }

    // le rang du dernier message � supprimer est stock� dans $rangMsgSupD

    // ==========================================================================
    // Affichage d'un message d'avertissement
    // ==========================================================================

    print("<br> \n");

    print("<table border=\1\" bgcolor=\"#fffff0\" align=\"center\" cellpadding=\"15\"> \n");
    print("<tr><td align=\"center\"> \n");
      print("<center><b>Vous �tes sur le point de supprimer le(s) message(s) suivant(s)</b> : </center><br> \n");

      // ==========================================================================
      // Affichage des intitul�s des messages � supprimer dans un tableau
      // ==========================================================================

      print("<table border=\"1\" align=\"center\" bgcolor=\"#ffffff\"> \n");

      print("<tr><td bgcolor=\"#eeeeee\"><center><b>&nbsp;Ident.&nbsp;</b></center></td><td bgcolor=\"#eeeeee\"><b><center>INTITULE du message</center></b></td></tr> \n");

        for($compt=$rangMsgSupP;$compt<=$rangMsgSupD;$compt++) {

          // insertion d'un tableau � une ligne et deux colonnes
          // destin� � mat�rialiser la hierarche du forum

          print("<tr> \n");

          print("<td bgcolor=\"#eeeeee\"> \n");
          print("<center>".$index[$compt][1]."</center>");
          print("</td> \n");

          print("<td> \n");
          print("<table border=\"0\"> \n");
          print("<tr> \n");
          print("<td width=\"".tabulation($index[$compt][2]-1)."\"></td> \n");
          print("<td> \n");
          if($index[$compt][2]==1) {
            print("# \n");
          }
          else {
            print("> \n");
          }
          print("<b>".stripslashes(htmlentities(strip_tags($index[$compt][5])))."</b> - ");
          print("<b>".stripslashes(htmlentities(strip_tags($index[$compt][4])))."</b> (".$index[$compt][3].") <br> \n");
          print("</td> \n");
          print("</tr> \n");
          print("</table> \n");
          print("</td> \n");

          print("</tr> \n");
        }

      print("</table> \n");

      // ==========================================================================
      // Affichage de la demande de confirmation
      // ==========================================================================

      print("<center> \n");
      print("<form method=\"POST\" action=\"admin.php\"> \n");
      print("<input type=\"hidden\" name=\"idaction\" value=\"suppresMsgs\"> \n");
      print("<input type=\"hidden\" name=\"pass\" value=\"$pass\"><input type=\"hidden\" name=\"repforum\" value=\"$repForum\"> \n");
      print("<input type=\"hidden\" name=\"rangsupmin\" value=\"$rangMsgSupP\"> \n");
      print("<input type=\"hidden\" name=\"rangsupmax\" value=\"$rangMsgSupD\"> \n");
      print("<input type=\"submit\" value=\"Confirmer la suppression\" name=\"A1\"> \n");
      print("</form> \n");
      print("</center> \n");

    print("</td></tr> \n");
    print("</table> \n");

    print("<center> \n");
    print("<form method=\"POST\" action=\"admin.php\"><input type=\"hidden\" name=\"idaction\" value=\"menuGen\"><input type=\"hidden\" name=\"pass\" value=\"$pass\"><input type=\"hidden\" name=\"repforum\" value=\"$repForum\"><input type=\"submit\" value=\"Annuler (retour au menu g�n�ral)\" name=\"A1\"></form> \n");
    print("</center> \n");
    print("</center> \n");

  }
}

// *****************************************************************************
// Module idaction="suppresMsgs" :
// Affiche la page de confirmation de suppression d�finitive de messages
// *****************************************************************************

if ($idaction=="suppresMsgs") {
  if ($pass!=ROT13($MDP)) {
    print("<br> \n");
    print("Erreur : Veuillez vous <a href=\"admin.php\">identifier</a> � nouveau.");
  }
  else {

    // ==========================================================================
    // Lecture du fichier "index.dat" et stockage des donn�es dans le tableau
    // $index
    // ==========================================================================

      $tabindex=file("${reperForum}/index.dat");
      $nombremsgs=count($tabindex)-1;

      for($compt=1;$compt<=$nombremsgs;$compt++) {
        $index[$compt][1]=strtok($tabindex[$compt],"#"); // identifiant du message
        $index[$compt][2]=strtok("#");                   // niveau du message
        $chainetemp=strtok("#");                         // chaine date+nom+sujet
        $index[$compt][3]=strtok($chainetemp,"|");       // date
        $index[$compt][4]=strtok("|");                   // nom de l'auteur
        $index[$compt][5]=strtok("|");                   // sujet
     }

    // ==========================================================================
    // Suppression des fichiers msg__.dat
    // ==========================================================================

    if($rangsupmax>$nombremsgs) {
      print("<br> \n");
      print("<center> \n");
      print("Vous avez probablement tent� d'actualiser la page de confirmation de suppression de message. <br> \n");
      print("Cette op�ration n'a pas eu de cons�quences dans ce cas pr�cis.<br> \n");
      print("Elle aurait toutefois pu causer une erreur et endommager la structure du forum de discussion.<br><br> \n");
      print("<form method=\"POST\" action=\"admin.php\"><input type=\"hidden\" name=\"idaction\" value=\"menuGen\"><input type=\"hidden\" name=\"pass\" value=\"$pass\"><input type=\"hidden\" name=\"repforum\" value=\"$repForum\"><input type=\"submit\" value=\"Retour au menu g�n�ral\" name=\"A1\"></form> \n");
      exit;
    }

    print("<br> \n");
    print("<center> \n");
    for($compt=$rangsupmin;$compt<=$rangsupmax;$compt++) {
      $testsup=unlink("${reperForum}/msg".$index[$compt][1].".dat");
      if($testsup) {
        print("Le message n� ".$index[$compt][1]." a bien �t� supprim�. <br> \n");
      }
      else {
       print("Impossible de supprimer le message n� ".$index[$compt][1].". <br> \n");
       print("<form method=\"POST\" action=\"admin.php\"><input type=\"hidden\" name=\"idaction\" value=\"menuGen\"><input type=\"hidden\" name=\"pass\" value=\"$pass\"><input type=\"hidden\" name=\"repforum\" value=\"$repForum\"><input type=\"submit\" value=\"Retour au menu g�n�ral\" name=\"A1\"></form> \n");
       exit;
      }
    }
    print("</center> \n");

   // ==========================================================================
    // Recopie du fichier "index.dat", avec omission des lignes concernant les
    // messages � supprimer
    // ==========================================================================

    $ficindex=fopen("${reperForum}/index.dat","w+");

    fputs($ficindex,"Fichier Index. Ne pas �diter !\n");

    // --- recopie des premi�res lignes du fichier index.dat ---

    for($compt=1;$compt<=$rangsupmin-1;$compt++) {
      fputs($ficindex,$tabindex[$compt]);
    }

    // --- recopie des derni�res lignes du fichier index.dat ---

    for($compt=$rangsupmax+1;$compt<=$nombremsgs;$compt++) {
      fputs($ficindex,$tabindex[$compt]);
    }

    fclose($ficindex);

    // ==========================================================================
    // V�rification du bon d�roulement de l'op�ration de r��criture
    // du fichier "index.dat"
    // ==========================================================================

    $tabindverif=file("${reperForum}/index.dat");
    $nombremsgsnouv=count($tabindverif)-1;

    if($nombremsgsnouv!=(($nombremsgs-($rangsupmax-$rangsupmin+1)))) {
      print("Erreur durant l'op�ration de mise � jour du fichier index.<br> \n");
      print("La structure du forum a peut-�tre �t� endommag�e.<br> \n");
      print("<form method=\"POST\" action=\"admin.php\"><input type=\"hidden\" name=\"idaction\" value=\"menuGen\"><input type=\"hidden\" name=\"pass\" value=\"$pass\"><input type=\"hidden\" name=\"repforum\" value=\"$repForum\"><input type=\"submit\" value=\"Annuler (retour au menu g�n�ral)\" name=\"A1\"></form> \n");
      exit;
    }

    else {
      print("<center> \n");
      print("Mise � jour de l'index termin�e.<br> \n");
      print("<br> \n");
      print("<form method=\"POST\" action=\"admin.php\"><input type=\"hidden\" name=\"idaction\" value=\"menuGen\"><input type=\"hidden\" name=\"pass\" value=\"$pass\"><input type=\"hidden\" name=\"repforum\" value=\"$repForum\"><input type=\"submit\" value=\"Retour au menu g�n�ral\" name=\"A1\"></form> \n");
      print("<form method=\"POST\" action=\"admin.php\"><input type=\"hidden\" name=\"idaction\" value=\"menuSupMsgs\"><input type=\"hidden\" name=\"pass\" value=\"$pass\"><input type=\"hidden\" name=\"repforum\" value=\"$repForum\"><input type=\"submit\" value=\"Retour au menu de suppression de messages\" name=\"A1\"></form> \n");
      print("</center> \n");
    }

  }
}

// *****************************************************************************
// Module idaction="menuChangeMDP" :
// Affiche le menu permettant de changer le mot de passe
// *****************************************************************************

if ($idaction=="menuChangeMDP") {
  if ($pass!=ROT13($MDP)) {
    print("Erreur : Veuillez vous <a href=\"admin.php\">identifier</a> � nouveau.");
  }
  else {
    print("<center> \n");
    print("<br> \n");
    print("<b>D�finition d'un nouveau mot de passe</b> <br> \n");
    ImprimFormChoixMDP();
    print("</center> \n");
  }
}

// #############################################################################
?>


</body>
</html>
