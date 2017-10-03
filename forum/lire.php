<?php
session_start();
/***************************************************************************
 *                              T.R.I.A.D.E
 *                            ---------------
 *
 *   begin                : Janvier 2000
 *   copyright            : (C) 2000 E. TAESCH - T. TRACHET - F. ORY
 *   Site                 : http://www.triade-educ.com
 *
 *
 ***************************************************************************/
/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/
// **************************************************************************
// Configuration de param�tres d'affichage des 4 tableaux utilis�s pour la mise
// en forme de la page :
//
// TableauA : Affiche l'ent�te "Message post�"
// (1 ligne, 1 colonne)
// TableauB : Affiche des indications sur le message post� (auteur, sujet,date),
// le texte proprement dit et un lien "Poster une r�ponse"
// (3 lignes, 1 colonne)
// TableauC : Affiche l'intitul� du message pr�c�dent, sil existe
// (2 lignes, 1 colonne)
// TableauD : Affiche le(s) intitul�(s) des messages suivants, s'ils existent
// (n lignes avec alternance de couleur de fond, 1 colonne)
//
// Modifiez les param�tres ci-dessous en n'oubliant pas de refermer
// les guillemets et le point virgule
// **************************************************************************

// === Param�tres d'affichage du TableauA (ent�te "Message post�") ===

$largeurTableauxAB="90%";         // Largeur du TableauA
$couleurBordTableauA="#000000";   // Couleur de la bordure du TableauA
$couleurFondTableauA="#FFEF39";   // Couleur de fond du tableauA
$policeTableauA="Verdana";        // Police de caract�res utilis�e dans le TableauA
$couleurPoliceTableauA="#000000"; // Couleur de la police de caract�res utilis�e dans le TableauA

// === Param�tres d'affichage du TableauB (indications et texte du message � afficher) ===

// Note : la largeur du tableauB est identique � celle du TableauA
$couleurBordTableauB="#111111";        // Couleur de la bordure du TableauB
$couleurFondLign1TableauB="#D3FBFB";   // Couleur de fond de la premi�re ligne du TableauB (indications sur le message)
$policeLign1TableauB="Verdana";        // Police de caract�res utilis�e dans la premi�re ligne du TableauB
$couleurPoliceLign1TableauB="#000000"; // Couleur de la police de caract�res utilis�e dans la premi�re ligne du TableauB
$couleurFondLign2TableauB="#E3FFFF";   // Couleur de fond de la deuxi�me ligne du TableauB (texte proprement dit)
$policeLign2TableauB="Times";          // Police de caract�res utilis�e dans la deuxi�me ligne du TableauB
$couleurPoliceLign2TableauB="#000000"; // Couleur de la police de caract�res utilis�e dans la deuxi�me ligne du TableauB
$couleurFondLign3TableauB="#C5FFEF";   // Couleur de fond de la troisi�me ligne du TableauB (lien "poster une r�ponse)
$policeLign3TableauB="Verdana";        // Police de caract�res utilis�e dans la troisi�me ligne du TableauB
$couleurPoliceLign3TableauB="#000000"; // Couleur de la police de caract�res utilis�e dans la troisi�me ligne du TableauB

// === Param�tres d'affichage du TableauC et du TableauD(intitul�s des messages pr�c�dents/suivants, s'ils existent) ===

$largeurTableauxCD="90%";                 // Largeur des Tableaux C et D
$couleurBordureTableauxCD="#000000";      // Couleur de la bordure des Tableaux C et D
$couleurFondEnteteTableauxCD="#FFEF39";   // Couleur de fond des ent�tes des Tableaux C et D
$policeEnteteTableauxCD="Verdana";        // Police de caract�res utilis�e dans les ent�tes des Tableaux C et D
$couleurPoliceEnteteTableauxCD="#000000"; // Couleur de la police de caract�res utilis�e dans les ent�tes des Tableaux C et D
$couleurFondInt1TableauxCD="#EBFFFD";     // Couleur1 de fond des lignes d'affichage des intitul�s de messages (en alternance)
$couleurFondInt2TableauxCD="#FFFBEB";     // Couleur2 de fond des lignes d'affichage des intitul�s de messages (en alternance)
$policeIntTableauxCD="Arial";             // Police de caract�res utilis�es pour l'affichage des intitul�s de messages
$couleurPoliceIntTableauxCD="#000000";    // Couleur de la police de caract�res utilis�e l'affichage des intitul�s de messages

// === Option permettant d'appliquer ou non les �ventuelles portions de code html ins�r�es dans les messages des utilisateurs (pour l'insertion directe de liens hypertextes par exemple) ===

$optionCodeHtml=0;  // 0 si vous ne souhaitez pas que le code html ins�r� soit appliqu� (recommand� pour des raisons de s�curit�)
                    // 1 si vous souhaitez que le code html ins�r� soit appliqu�

// ###########################################################################
?>
<HTML>
<HEAD>
<META http-equiv="CacheControl" content = "no-cache">
<META http-equiv="pragma" content = "no-cache">
<META http-equiv="expires" content = -1>
<meta name="Copyright" content="Triade�, 2001">
<LINK TITLE="style" TYPE="text/CSS" rel="stylesheet" HREF="../librairie_css/css.css">
<script language="JavaScript" src="../librairie_js/acces.js"></script>
<script language="JavaScript" src="../librairie_js/clickdroit2.js"></script>
<script language="JavaScript" src="../librairie_js/function.js"></script>
<title>Triade - Forum </title>
</head>
<body  id='bodyforum'  marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" >
<?php include("../librairie_php/lib_licence_forum.php"); ?>
<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="85">
<tr id='coulBar0' ><td height="2"><b><font   id='menumodule1' ><?php print LANGFORUM24 ?></font></b></td>
</tr>
<tr id='cadreCentral0'>
<td >
<!-- // fin  -->

<?php
// #############################################################################
// *****************************************************************************
// Cr�ation du fichier "index.dat" s'il n'existe pas encore
// *****************************************************************************
$repforum="../data/forum/".$_SESSION["membre"];
if (!file_exists("${repforum}/index.dat")) {
  $crfic=fopen("${repforum}/index.dat","w+");
  fputs($crfic,"Fichier Index. Ne pas �diter !");
  fclose($crfic);
}

// *****************************************************************************
// Lecture du fichier index.dat et stockage des donn�es
// dans le tableau "$index"
// *****************************************************************************

$tabindex=file("${repforum}/index.dat");
$nombremsgs=count($tabindex)-1;

for($compt=1;$compt<=$nombremsgs;$compt++) {
  $index[$compt][1]=strtok($tabindex[$compt],"#"); // identifiant du message
  $index[$compt][2]=strtok("#");                   // niveau du message
  $chainetemp=strtok("#");            // chaine date+nom+sujet
  $index[$compt][3]=strtok($chainetemp,"|");       // date
  $index[$compt][4]=strtok("|");                   // nom de l'auteur
  $index[$compt][5]=strtok("|");                   // sujet
}
// #############################################################################
?>

<?php
// #############################################################################
// *****************************************************************************
// Cas de figure o� le script est appel� sans renseignements sur la valeur $msg.
// Par d�faut, $msg prend la valeur de l'identifiant du premier message post�
//  dans le forum.
// *****************************************************************************

$msg=$_GET["msg"];

if(!isset($msg)) $msg="";

if(!$msg) {
  if(isset($index)) $msg=$index[$compt][1]; // identifiant du premier message post� dans le forum
}

// *****************************************************************************
// R�cup�ration du nom du fichier correspondant au message � afficher
// *****************************************************************************

$nomfichiermsg="${repforum}/msg".$msg.".dat";

// ============================================================================
// Cas de figure o� le message appel� n'existe pas ou n'existe plus
// (suppression par l'administrateur du forum)
// ============================================================================

if(!file_exists($nomfichiermsg)) {
  if($nombremsgs<1) {
    print("<center> \n");
    print("<font face=\"$policeEnteteTableauxCD\" size=\"-1\"> \n");
    print LANGFORUM25."<br> \n";
    print LANGFORUM26." <a href=\"post.php\">".LANGFORUM26bis."</a> ".LANGFORUM26ter."<br> \n";
    print("</font> \n");
    print("</center> \n");
  }
  else {
    print("<center> \n");
    print("<font face=\"$policeEnteteTableauxCD\" size=\"-1\"> \n");
    print LANGFORUM27."\n";
    print("<a href=\"forum.php\">".LANGFORUM28."</a> \n");
    print("</font> \n");
    print("<center> \n");

  }
}

else {

// *****************************************************************************
// Affichage du message, et des intitul�s des �ventuels messages pr�c�dent et suivants
// *****************************************************************************

  // *****************************************************************************
  // Lecture du fichier msg__.dat et stockage des donn�es
  // dans le tableau "$message"
  // *****************************************************************************

  $tabmessage=file("$nomfichiermsg");
  $nlignes=count($tabmessage)-1;

  // ============================================================================
  // Stockage des donn�es dans le tableau "$message"
  // ============================================================================

  $message[1]=$tabmessage[1];      // date
  $message[2]=$tabmessage[2];      // nom de l'auteur
  $message[3]=$tabmessage[3];      // adresse �lectronique de l'auteur
  $message[4]=$tabmessage[4];      // sujet

  // Note : les lignes de texte du message proprement dit sont stock�es dans les
  // les valeurs $tabmessage[5], $tabmessage[6]... jusqu'� $tabmessage[$nlignes]


  // *****************************************************************************
  // Affichage du sujet du message,
  // du nom de son auteur, de son adresse �lectronique,
  // de la date de r�daction et du texte du message proprement dit.
  // Les donn�es sont affich�es dans un tableau.
  // *****************************************************************************



  print("<BR><table border=\"0\" cellspacing=\"1\" cellpadding=\"0\" width=\"$largeurTableauxAB\" align=\"center\" bgcolor=\"$couleurBordTableauB\"> \n");
  print("<tr><td> \n");

    print("<table border=\"0\" width=\"100%\" cellspacing=\"1\" align=\"center\" cellpadding=\"5\"> \n");

    // ==== Affichage du sujet ====
    print("<tr> \n");
    print("<td bgcolor=\"$couleurFondLign1TableauB\" height=\"25\"> \n");
    print("<font face=\"$policeLign1TableauB\" size=\"-1\" color=\"$couleurPoliceLign1TableauB\">".LANGFORUM12." : </font> \n");
    print("<font face=\"$policeLign1TableauB\" size=\"-1\" color=\"$couleurPoliceLign1TableauB\"><b>".stripslashes(htmlentities(strip_tags($message[4])))."</b> <br /></font> \n");

    // ==== Affichage du nom de l'auteur et prise en compte de l'adresse �lectronique ====

    if($message[3]=="noemail\n") {
      print("<font face=\"$policeLign1TableauB\" size=\"-1\" color=\"$couleurPoliceLign1TableauB\">".LANGFORUM30." :</font> \n");
      print("<font face=\"$policeLign1TableauB\" size=\"-1\" color=\"$couleurPoliceLign1TableauB\"><b>".stripslashes(htmlentities(strip_tags($message[2])))." </b></font> \n");
    }
    else {
      print("<font face=\"$policeLign1TableauB\" size=\"-1\" color=\"$couleurPoliceLign1TableauB\">".LANGFORUM30." :</font> \n");
      print("<font face=\"$policeLign1TableauB\" size=\"-1\" color=\"$couleurPoliceLign1TableauB\"><b><a href=\"mailto:".trim($message[3])."\">".trim($message[2])."</a></b></font> \n");
    }

    // === Affichage de la date ===
    print("<br> \n");
    print("<font face=\"$policeLign1TableauB\" size=\"-2\" color=\"$couleurPoliceLign1TableauB\">".LANGFORUM31." : </font> \n");
    print("<font face=\"$policeLign1TableauB\" size=\"-2\" color=\"$couleurPoliceLign1TableauB\">".$message[1]."</font> <br> \n");
    print("</td> \n");
    print("</tr> \n");

    // Affichage du texte proprement dit dans un *tableau* ins�r� dans une *nouvelle cellule*

    print("<tr><td bgcolor=\"$couleurFondLign2TableauB\"> \n");

    // ============    affichage des diff�rentes lignes de texte      ===============
    // =========   �ventuellement entrecoup�es de retours � la ligne ================
    // == Rappel : les lignes de texte sont stock�es dans le tableau "$tabmessage" ==

      // Insertion du tableau dans lequel est affich� le message

      print("<table width=\"90%\" align=\"center\"> \n");
      print("<tr><td> \n");

        print("<font size=3 face=\"$policeLign2TableauB\" color=\"$couleurPoliceLign2TableauB\">");
        for($compt=5;$compt<=$nlignes;$compt++) {
          if(!$optionCodeHtml) print(stripslashes(htmlentities(strip_tags($tabmessage[$compt])))."<br> \n");  // Prise en compte de la valeur de if $optionCodeHtml
          else print(stripslashes($tabmessage[$compt])."<br> \n");
        }
        print("</font> \n");

        print("</td></tr> \n");
      print("</table> \n");

    print("</td></tr> \n");

  // ========= Affichage du lien permettant de poster une r�ponse =========

    print("<tr> \n");
    print("<td bgcolor=\"$couleurFondLign3TableauB\"> \n");
    print("<center> \n");
    print("> <a href=\"forumposter.php?refer=$msg\">".LANGFORUM32." </a> < \n");
    print("</center> \n");
    print("</td></tr> \n");

    print("</table>");

  print("</tr></td> \n");
  print("</table>");
  print("<br>");

  // *****************************************************************************
  // Affichage du message pr�c�dent (s'il existe) dans un tableau
  // *****************************************************************************

  // =============================================================================
  // D�termination du rang du message affich� (identifiant $msg)
  // en vue de l'affichage des messages suivants et pr�c�dents �ventuels
  // =============================================================================

  $testrangmsg=1;
  while($index[$testrangmsg][1]!=$msg) {
    $testrangmsg++;
  }
  $rangmsg=$testrangmsg;

  // Note : le rang (dans l'index) du message est stock� dans $rangmsg

  // =======================================================================
  // test sur l'existence d'un �ventuel message pr�c�dent,
  // recherche de la r�f�rence de ce message pr�c�dent,
  // et affichage de son intitul�
  // =======================================================================

  // ---------- test sur l'existence du message pr�c�dent   ----------
  // ---------- et recherche de son rang                    ----------

  $testrangmsgMP=$rangmsg;

  if($index[$rangmsg][2]>1) {
    // --- le rang du message est sup�rieur � 1 ---
    $testrangmsgMP=$testrangmsgMP-1;
      while($index[$testrangmsgMP][2]>=$index[$rangmsg][2]) {
        $testrangmsgMP=$testrangmsgMP-1;
      }
    $rangmsgMP=$testrangmsgMP;

    // ---------- Affichage de l'intitul� du message pr�c�dent ----------
    // ----------    au format format "sujet - nom (date)"    ----------

    print("<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"$largeurTableauxCD\" align=\"center\" bgcolor=\"$couleurBordureTableauxCD\"> \n");
    print("<tr><td> \n");
      print("<table border=\"0\" width=\"100%\" cellspacing=\"1\" cellpadding=\"3\" align=\"center\" cellpadding=\"3\"> \n");
      print("<tr> \n");
      print("<td bgcolor=\"$couleurFondEnteteTableauxCD\" height=\"25\"> \n");
      print("<font face=\"$policeEnteteTableauxCD\" size=\"2\" color=\"$couleurPoliceEnteteTableauxCD\"> \n");
      print("<center>".LANGFORUM33." :</center> \n");
      print("</font> \n");
      print("</td> \n");
      print("</tr> \n");
      print("<tr> \n");
      print("<td bgcolor=\"$couleurFondInt1TableauxCD\"> \n");
      print("&nbsp;<a href=\"lire.php?msg=".$index[$rangmsgMP][1]."\">".stripslashes(htmlentities(strip_tags($index[$rangmsgMP][5])))."</a> - ");
      print("".stripslashes(htmlentities(strip_tags($index[$rangmsgMP][4])))." (".$index[$rangmsgMP][3].")  \n");
      print("</td> \n");
      print("</tr> \n");
      print("</table>");
    print("</tr></td> \n");
    print("</table>");
    print("<br>");
  }

  // *****************************************************************************
  // Affichage des messages suivants (s'ils existent) dans un tableau
  // *****************************************************************************

  // =======================================================================
  // D�finition de la fonction couleuralt, qui alterne les couleurs
  // d'affichage des lignes du tableau
  // =======================================================================

  function couleuralt() {
    global $couleurFondInt1TableauxCD;
    global $couleurFondInt2TableauxCD;
    static $numligne;
    if(!isset($numligne)) $numligne="";
    if ($numligne%2=="1") {
      $numligne=$numligne+1;
      return($couleurFondInt1TableauxCD);
    }
    else {
      $numligne=$numligne+1;
      return($couleurFondInt2TableauxCD);
    }
  }

  // =======================================================================
  // D�finition de la fonction "tabulation", utilis�e pour mat�rialiser
  // la hierarchie du forum
  // =======================================================================

  function tabulation($n=1) {
    $espacevide=(30*($n-1)+40);
    return($espacevide);
  }

  // =============================================================================
  // test sur l'existence d'�ventuels messages suivants,
  // recherche de leurs r�f�rences et affichage de leur intitul�
  // =============================================================================

  $rangmsgMS=$rangmsg+1;

  if(@ $index[$rangmsgMS][2]>$index[$rangmsg][2]) {

    // Affichage de la liste des messages suivants

    print("<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"$largeurTableauxCD\" align=\"center\" bgcolor=\"$couleurBordureTableauxCD\"> \n");
    print("<tr><td> \n");

      print("<table border=\"0\" width=\"100%\" cellspacing=\"1\" align=\"center\" cellpadding=\"3\"> \n");

      print("<tr> \n");
      print("<td bgcolor=\"$couleurFondEnteteTableauxCD\" height=\"25\"> \n");
      print("<font face=\"$policeEnteteTableauxCD\" size=\"2\" color=\"$couleurPoliceEnteteTableauxCD\"> \n");
      print("<center>".LANGFORUM34." :</center> \n");
      print("</font> \n");
      print("</td> \n");
      print("</tr> \n");

      while(@ $index[$rangmsgMS][2]>$index[$rangmsg][2]) {

        print("<tr> \n");
        print("<td bgcolor=\"".couleuralt()."\"> \n");

        // insertion d'un tableau � une ligne et deux colonnes
        // destin� � mat�rialiser la hierarche du forum

          print("<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"> \n");
          print("<tr> \n");
          print("<td width=\"".tabulation($index[$rangmsgMS][2]-$index[$rangmsg][2]-1)."\"></td> \n");
          print("<td> \n");
          print(" &gt;  \n");
          print("<a href=\"lire.php?msg=".$index[$rangmsgMS][1]."\">".stripslashes(htmlentities(strip_tags($index[$rangmsgMS][5])))."</a> - ");
          print("".stripslashes(htmlentities(strip_tags($index[$rangmsgMS][4])))." (".$index[$rangmsgMS][3].")   \n");
          print("</td> \n");
          print("</tr> \n");
          print("</table> \n");

        print("</td> \n");
        print("</tr> \n");

        $rangmsgMS++;
      }

      print("</table> \n");

    print("</tr></td> \n");
    print("</table>");
    print("<br>");
  }

  print("<center> \n");
  print("<a href=\"forumposter.php\">".LANGFORUM4."</a> \n");
  print("&nbsp;&nbsp; \n");
  print("<a href=\"forum.php\">".LANGFORUM8."</a><br> \n");
  print("</center> \n");
}

// #############################################################################
?>



</td></tr></table>
</BODY></HTML>
