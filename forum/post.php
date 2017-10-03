<?php
// **************************************************************************
// Configuration de param�tres d'affichage du bloc permettant de poster un
// message :
// Modifiez les param�tres ci-dessous en n'oubliant pas de refermer
// les guillemets et le point virgule
// **************************************************************************

// === Param�tres d'affichage du bloc "poster un message" ===
$largeurBloc="80%";               // Largeur du bloc
$couleurBordureBloc="#000000";    // Couleur de la bordure du bloc
$couleurFondEntete="#FFEF39";     // Couleur de fond de l'Ent�te
$policeEntete="Verdana";          // Police utilis�e dans l'ent�te
$couleurPoliceEntete="#000000";   // Couleur de la police utilis�e dans l'Ent�te
$couleurFondZoneRedac="#DCFCFC";  // Couleur de fond de la zone de R�dac
$policeZoneRedac="Verdana";       // Police utilis�e dans la zone R�dac
$couleurPoliceRedac="#000000";    // Couleur de la police utilis�e dans la zone R�dac

// #########################################################################
// *****************************************************************************
// Cr�ation du fichier "index.dat" s'il n'existe pas encore
// *****************************************************************************
$repforum="../data/forum/".$_SESSION["membre"];
if (!file_exists("${repforum}/index.dat")) {
  $crfic=fopen("${repforum}/index.dat","w+");
  fputs($crfic,"Fichier Index. Ne pas �diter !");
  fclose($crfic);
}

// #########################################################################
// *************************************************************************
// Prise en compte de la valeur "$refer", correspondant
// � l'identifiant du message r�f�rant �ventuel
// *************************************************************************
// ==================================================================================
// Tests et r�cup�ration du nom du fichier correspondant au message � afficher
// ==================================================================================

$refer=$_GET["refer"];
if(!isset($refer)) $refer="";

// --- Test : le message r�f�rant existe-t-il ? ---

if($refer and (!file_exists("${repforum}/msg".$refer.".dat"))) {
  print("<font face=\"$policeZoneRedac\" size=\"-1\"> \n");
  print("<center> \n");
  print LANGFORUM7." <br> \n";
  print("<a href=\"forum.php\">".LANGFORUM8."</a><br> \n");
  print("</center \n");
  print("</font> \n");
}

else {
// --- le message r�f�rant existe bien ou est �gal � "" ---

  if($refer) {
   $nomfichiermsg="${repforum}/msg".$refer.".dat";

    // ======== Lecture du fichier msg__.dat et stockage des donn�es ========
    // ========               dans le tableau "$message"             ========

    $tabmessage=file("$nomfichiermsg");
    $nlignes=count($tabmessage)-1;

    // Rappel : le sujet est stock� dans la 4�me ligne

    $sujetMsgRef=$tabmessage[4];

    // Rappel : les lignes de texte du message proprement dit sont stock�es dans
    // les valeurs $tabmessage[5], $tabmessage[6]... jusqu'� $tabmessage[$nlignes]

    $texteMsgRef=LANGFORUM9."\n";

    for($compt=5;$compt<=$nlignes;$compt++) {
      $texteMsgRef=$texteMsgRef."~ ".$tabmessage[$compt];
    }

    // Note : le texte du message r�f�rant est stock� dans la variable $texteMsgRef
  }
  print "&nbsp;";
  print("<BR><table border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"$couleurBordureBloc\" width=\"$largeurBloc\"> \n");
  print("<tr><td> \n");
  print("<table border=\"0\" width=\"100%\" cellspacing=\"1\" align=\"center\" cellpadding=\"5\"> \n");


     print("<tr><td align=\"center\" bgcolor=\"$couleurFondZoneRedac\"> \n");

     $val=ucwords($_SESSION["prenom"])." ".strtoupper($_SESSION["nom"]);
     if ($_SESSION["membre"] == "menuparent") {
          		$val="Parent de ".ucwords($_SESSION["prenom"])." ".strtoupper($_SESSION["nom"]);
     }
     if ($_SESSION["membre"] == "menueleve") {
	    		$val="El�ve - ".ucwords($_SESSION["prenom"])." ".strtoupper($_SESSION["nom"]);
     }

     print("
      <form method=\"POST\" action=\"confirmpost.php\">
      <center>

        <table border=\"0\" cellpadding=\"2\" cellspacing=\"0\">

          <tr><td>&nbsp;</td></tr>

          <tr>
          <td>".LANGFORUM10." :</td>

          <td><input type=\"text\" name=\"nom\" size=\"24\" value=\"$val\" onfocus=\"this.blur()\" STYLE=\"font-family: Arial;font-size:10px;color:#CC0000;background-color:#CCCCFF;font-weight:bold;\" ></td>
          </tr>

         <!-- <tr>
          <td>".LANGFORUM11." : &nbsp;</td>
          <td><input type=\"text\" name=\"adel\" size=\"30\"></td>
          </tr>
	-->
          <tr>
          <td>".LANGFORUM12." :</td>
          <td>

     ");

  // ********************************************************************************
  // Prise en compte de la valeur "$refer" / Citation du sujet du message r�f�rant
  // ********************************************************************************

  if ($refer) {
    print("<input type=\"text\" name=\"sujet\" maxlength=\"40\" size=\"30\" value=\"Re : ".htmlentities(stripslashes(strip_tags($sujetMsgRef)))."\"> \n");
  }

  else {
    print("<input type=\"text\" name=\"sujet\" maxlength=\"40\" size=\"30\"> \n");
  }

  // ********************************************************************************
  // Suite de l'impression du code correspondant au formulaire html
  // ********************************************************************************

  print("
          </td>
          </tr>
        </table>
    </center>
    <br>
  ");

  // ********************************************************************************
  // Prise en compte de la valeur "$refer" / Citation du sujet du message r�f�rant
  // ********************************************************************************

  print("<center> \n");

  if ($refer) {
    print("<textarea rows=\"10\" name=\"texte\" cols=\"70\" wrap=\"virtual\">");
    print(htmlentities(stripslashes(strip_tags($texteMsgRef))));
    print("</textarea> \n");
  }

  else {
    print("<textarea rows=\"10\" name=\"texte\" cols=\"70\" wrap=\"virtual\">");
    print("</textarea> \n");
  }

  print("</center> \n");

  // ************************************************************************
  // Prise en compte de la valeur "$refer" correspondant
  // � l'identifiant du message r�f�rant �ventuel
  // ************************************************************************

  if ($refer) {
    print("<input type=\"hidden\" name=\"refer\" value=\"$refer\"> \n");
  }

  // ********************************************************************************
  // Suite de l'impression du code correspondant au formulaire html
  // ********************************************************************************

  print("
  <br>
  <center><input type=\"submit\" value=\"".LANGFORUM13."\" name=\"B1\"></center>
  </form>
  </td></tr>
  ");
  print("</table> \n");
  print("</td></tr> \n");
  print("</table> \n");

  print("<br> \n");

  print("<center> \n");
  print("<a href=\"forum.php\">".LANGFORUM14."</a><br> \n");
  print("</center> \n");
}
// ################################################################################
?>
