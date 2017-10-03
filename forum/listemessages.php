<?php


// === Param�tres d'affichage du Tableau ===
$largeurTableau="90%";                 // Largeur du tableau
$couleurBordureTableau="#000000";      // Couleur de la bordure du tableau
$couleurFondEnteteTableau="#FFEF39";   // Couleur de fond de l'ent�te du tableau
$policeEnteteTableau="Verdana";        // Police de caract�res utilis�e dans l'ent�te du tableau
$couleurPoliceEnteteTableau="#000000"; // Couleur de la police de caract�res utilis�e dans l'ent�te du tableau
$couleurFondInt1Tableau="#EBFFFD";     // Couleur1 de fond des lignes d'affichage des intitul�s de messages (en alternance)
$couleurFondInt2Tableau="#FFFBEB";     // Couleur2 de fond des lignes d'affichage des intitul�s de messages (en alternance)
$policeIntTableau="Arial";             // Police de caract�res utilis�es pour l'affichage des intitul�s de messages
$couleurPoliceIntTableau="#000000";    // Couleur de la police de caract�res utilis�e pour l'affichage des intitul�s de messages

$NombreMsgParPage=30;              // Nombre maximum de messages � afficher par page
$NombreMaxPages=1;                // Nombre maximum de pages de messages susceptibles d'�tre affich�es

// === Mise en valeur des n derniers messages post�s ===

$nombreNouveauxMessagesSignales=5;           // Nombre de messages r�cents � signaler, en mettant leur date en surbrillance (la valeur 0 est possible)
$couleurNouveauxMessagesSignales="#000080";  // Couleur de la date des messages r�cents � signaler


// ###########################################################################
// *****************************************************************************
// Cr�ation du fichier "index.dat" s'il n'existe pas encore
// *****************************************************************************
$repforum="../data/forum/".$_SESSION["membre"];

if (!file_exists("${repforum}/index.dat")) {
  $crfic=fopen("${repforum}/index.dat","w+");
  fputs($crfic,"Fichier Index. Ne pas �diter !");
  fclose($crfic);
}

// **************************************************************************
// Lecture du fichier "index.dat" et stockage des donn�es (identifiant,
// niveau, date, nom et sujet) dans le tableau "$index"
// **************************************************************************

$tabindex=file("${repforum}/index.dat");
$nombremsgs=count($tabindex)-1;

for($compt=1;$compt<=$nombremsgs;$compt++) {
  $index[$compt][1]=strtok($tabindex[$compt],"#"); // identifiant du message
  $index[$compt][2]=strtok("#");                   // niveau du message
  $chainetemp=strtok("#");                         // chaine date+nom+sujet
  $index[$compt][3]=strtok($chainetemp,"|");       // date
  $index[$compt][4]=strtok("|");                   // nom de l'auteur
  $index[$compt][5]=strtok("|");                   // sujet
}

// ###########################################################################
// =======================================================================
// D�finition de fonctions utiles pour l'affichage des r�sultats dans un tableau
// =======================================================================
// =======================================================================
// D�finition de la fonction couleuralt, qui alterne les couleurs
// d'affichage des lignes du tableau
// =======================================================================

function couleuralt() {
  global $couleurFondInt1Tableau;
  global $couleurFondInt2Tableau;
  static $numligne;
  if(!isset($numligne)) $numligne=0;
  if ($numligne%2=="1") {
    $numligne=$numligne+1;
    return($couleurFondInt1Tableau);
  }
  else {
    $numligne=$numligne+1;
    return($couleurFondInt2Tableau);
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


// **************************************************************************
// Cas de figure o� aucun message n'a  encore �t� post� dans le forum de discussion
// **************************************************************************

if($nombremsgs<1) {
  print("<center> \n");
  print("<font face=\"$policeEnteteTableau\" size=\"-1\"> \n");
  print LANGFORUM2." <br> \n";
  print LANGFORUM3." <a href=\"forumposter.php\"><b>".LANGFORUM3bis."</b></a> ".LANGFORUM3ter.". \n";
  print("</font> \n");
  print("</center> \n");
}

// **************************************************************************
// Cas de figure o� des messages ont �t� post�s dans le forum de discussion :
// Affichage des intitul�s des messages dans un tableau (utilisant les
// param�tres pr�cis�s plus haut)
// **************************************************************************

else {

  // ===================================================================
  // D�termination de l'identifiant du dernier message post�

  // cr�ation du tableau $tabidents, destin� � reccueillir les diff�rentes
  // valeurs des identifiants des messages

  for($compt=1;$compt<=$nombremsgs;$compt++) {
    $tabidents[$compt]=intval($index[$compt][1]);
  }

  // Tri du tableau dans l'ordre inverse des valeurs
  rsort($tabidents);

  // D�termination des valeurs minimum et maximum des identifiants � signaler
  @ $limMaxDerMessa=$tabidents[0];

  if($nombremsgs<=$nombreNouveauxMessagesSignales) {
    @ $limMinDerMessa=$tabidents[$nombremsgs-1];
  }
  else {
    $limMinDerMessa=$tabidents[$nombreNouveauxMessagesSignales-1];
  }

  if($nombremsgs==1) {  // Cas de figure o� un seul message a �t� post�
    $limMaxDerMessa=1;
    $limMinDerMessa=1;
  }

  // suppression du tableau $tabidents
  unset($tabidents);

  // **************************************************************************
  // Prise en compte de la valeur $p, sens�e indiquer le num�ro de la page
  // � afficher - D�termination des rangs min. et max. des messages � afficher
  // dans la page
  // **************************************************************************

  if(@ !$p) $p=1;
  $rangPMax=$nombremsgs-(($p-1)*$NombreMsgParPage);
  $rangPMin=max($nombremsgs-($p*$NombreMsgParPage)+1,1);

  // **************************************************************************
  // Note : l'option "chrono" des versions pr�c�dentes de FouleTexte n'est
  // d�sormais plus disponible : les messages sont maintenant automatiquement
  // affich�s des plus r�cents aux plus anciens
  // **************************************************************************

  print("<center> \n");
  print("<font face=\"$policeEnteteTableau\" size=\"-1\"> \n");
  print("&gt;&nbsp;<a href=\"forumposter.php\">".LANGFORUM4."</a>&nbsp;&lt;<br> \n");    print("</font> \n");
  print("</center> \n");
  print("<br> \n");

  print("<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"$largeurTableau\" align=\"center\" bgcolor=\"$couleurBordureTableau\"> \n");
  print("<tr><td> \n");

    print("<table border=\"0\" width=\"100%\" cellspacing=\"1\" align=\"center\" cellpadding=\"5\"> \n");

    for($rangC=$rangPMax;$rangC>=$rangPMin;$rangC--) {    //  *** D�finition du premier curseur ($rangC), progressant par incr�mentation n�gative ***
      if($index[$rangC][2]==1) {                   // Cas de figure o� le rang du message rencontr� vaut 1

        print("<tr> \n");
        print("<td bgcolor=\"".couleuralt()."\"> \n");
        // insertion d'un tableau � une ligne et deux colonnes
        // destin� � mat�rialiser la hierarche du forum
          print("<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"> \n");
          print("<tr> \n");
          print("<td width=\"".tabulation($index[$rangC][2]-1)."\"></td> \n");
          print("<td> \n");
          print("<img src='../image/on1.gif' width='8' height='8' align=center > \n");
          print("<a href=\"lire.php?msg=".$index[$rangC][1]."\">".stripslashes(htmlentities(strip_tags($index[$rangC][5])))."</a> - ");
          if(($nombreNouveauxMessagesSignales>0) and ($index[$rangC][1]>=$limMinDerMessa) and ($index[$rangC][1]<=$limMaxDerMessa)) {
            print("".stripslashes(htmlentities(strip_tags($index[$rangC][4])))." (".$index[$rangC][3].")  \n");
          }
          else {
            print("".stripslashes(htmlentities(strip_tags($index[$rangC][4])))." (".$index[$rangC][3].")  \n");
          }
          print("</td> \n");
          print("</tr> \n");
          print("</table> \n");
        print("</td> \n");
        print("</tr> \n");

        $rangP=$rangC+1;                 //  *** D�finition du second curseur ($rangP), progressant par incr�mentation positive ***
        while(@ $index[$rangP][2]>1) {     //  Cas de figure o� le rang du message rencontr� est sup�rieur � 1
          print("<tr> \n");
          print("<td bgcolor=\"".couleuralt()."\"> \n");
          // insertion d'un tableau � une ligne et deux colonnes
          // destin� � mat�rialiser la hierarche du forum
            print("<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"> \n");
            print("<tr> \n");
            print("<td width=\"".tabulation($index[$rangP][2]-1)."\"></td> \n");
            print("<td> \n");
            print("<font face=\"$policeIntTableau\" color=\"$couleurPoliceIntTableau\">&gt;</font> \n");
            print("<a href=\"lire.php?msg=".$index[$rangP][1]."\">".stripslashes(htmlentities(strip_tags($index[$rangP][5])))."</a> - ");
            if(($nombreNouveauxMessagesSignales>0) and ($index[$rangP][1]>=$limMinDerMessa) and ($index[$rangP][1]<=$limMaxDerMessa)) {
              print("".stripslashes(htmlentities(strip_tags($index[$rangP][4])))." (".$index[$rangP][3].")   \n");
            }
            else {
              print("".stripslashes(htmlentities(strip_tags($index[$rangP][4])))." (".$index[$rangP][3].")   \n");
            }
            print("</td> \n");
            print("</tr> \n");
            print("</table> \n");
          print("</td> \n");
          print("</tr> \n");

          $rangP++;                    // Incr�mentation de $rangP
        }

      }
    }

    print("</table> \n");

  print("</td></tr> \n");
  print("</table>");

  print("<br> \n");



}


// ###########################################################################
?>
