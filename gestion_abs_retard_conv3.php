<?php
session_start();
/***************************************************************************
 *                              T.R.I.A.D.E
 *                            ---------------
 *
 *   begin                : Janvier 2000
 *   copyright            : (C) 2000 E. TAESCH - T. TRACHET - 
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
?>
<HTML>
<HEAD>
<META http-equiv="CacheControl" content = "no-cache">
<META http-equiv="pragma" content = "no-cache">
<META http-equiv="expires" content = -1>
<meta name="Copyright" content="Triade�, 2001">
<LINK TITLE="style" TYPE="text/CSS" rel="stylesheet" HREF="./librairie_css/css.css">
<script language="JavaScript" src="./librairie_js/acces.js"></script>
<script language="JavaScript" src="./librairie_js/lib_defil.js"></script>
<script language="JavaScript" src="./librairie_js/clickdroit.js"></script>
<script language="JavaScript" src="./librairie_js/lib_absrtdplanifier.js"></script>
<script language="JavaScript" src="./librairie_js/function.js"></script>
<title>Vie Scolaire - Triade - Compte de <?php print "$_SESSION[nom] $_SESSION[prenom]" ?></title>
</head>
<body id='bodyfond' marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" onload="Init();" >
<?php include("./librairie_php/lib_licence.php"); ?>
<?php
// connexion
include_once("librairie_php/db_triade.php");
$cnx=cnx();
?>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/$_SESSION[membre]".".js'>" ?></SCRIPT>
<?php include("./librairie_php/lib_defilement.php"); ?>
</TD><td width="472" valign="middle" rowspan="3" align="center">
<div align='center'><?php top_h(); ?>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/$_SESSION[membre]"."1.js'>" ?></SCRIPT>
<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="85">
<tr id='coulBar0' ><td height="2"><b><font   id='menumodule1' ><?php print LANGABS26 ?></font></b></td></tr>
<tr id='cadreCentral0'>
<td >
<!-- // fin  -->
<?php
$id=$_POST["saisie_id_champ"];
$motif="saisie_".$id;
$date="saisie_date_".$id;
$heure="saisie_heure_".$id;
$raison="saisie_motif_".$id;
$duree="saisie_duree_retourner_".$id;
$justifier="saisie_justifier_".$id;
$idmatiere="0";  // 0 si -x  alors planication pour etude
/*
print $_POST[$motif];
print "<BR>";
print $_POST[$heure];
$heure=$_POST[$heure].":00";
print "<BR>";
print $_POST[$duree];
print "<BR>";
print $_POST[$date];
print "<BR>";
print $_POST["saisie_pers"];
print "<BR>";
print "date de saisie ".date("Y-m-d");
print "Par ".$_SESSION[nom];
print $_POST[$justifier];
 */

?><BR>
<center><font class=T2><b><?php print LANGABS28?></b></font></center>
<BR><BR>
<?php
$heure=$_POST[$heure].":00";
if ($_POST[$motif] == "absent" ) {
	$refRattrapage="";
	$cr=create_absent($_POST[$duree],$_POST[$date],$_POST["rtd_ideleve"],dateDMY2(),$_SESSION["nom"],$_POST[$raison],'-1',$_POST[$justifier],'',$refRattrapage);
        if($cr == 1){
		//  alertJs("Donn�e enregistr�e -- Service Triade");
		//$duree=$_POST["rtd_duree"];
		//$modif=$_POST["rtd_modif"];
		//$justifier=$_POST["rtd_justifier"];
		$date_ret=$_POST["rtd_date_ret"];
		$heure_ret=$_POST["rtd_heure_ret"];
		$ideleve=$_POST["rtd_ideleve"];
		suppression_retard($ideleve,$heure_ret,$date_ret);
        }
}

        Pgclose();
?>

     <!-- // fin  -->
     </td></tr></table>
     <?php
       // Test du membre pour savoir quel fichier JS je dois executer
   if (($_SESSION["membre"] == "menuadmin") || ($_SESSION["membre"] == "menuscolaire")) :
       print "<SCRIPT language='JavaScript' ";
       print "src='./librairie_js/".$_SESSION[membre]."2.js'>";
       print "</SCRIPT>";
   else :
      print "<SCRIPT language='JavaScript' ";
      print "src='./librairie_js/".$_SESSION[membre]."22.js'>";
      print "</SCRIPT>";

      top_d();

      print "<SCRIPT language='JavaScript' ";
     print "src='./librairie_js/".$_SESSION[membre]."33.js'>";
     print "</SCRIPT>";

       endif ;
     ?>
   </BODY></HTML>
