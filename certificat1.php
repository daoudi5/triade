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
include_once("./common/config.inc.php");
include_once("./librairie_php/lib_get_init.php");
$id=php_ini_get("safe_mode");
if ($id != 1) {
      set_time_limit(0);
}
?>
<HTML>
<HEAD>
<META http-equiv="CacheControl" content = "no-cache">
<META http-equiv="pragma" content = "no-cache">
<META http-equiv="expires" content = -1>
<meta name="Copyright" content="Triade�, 2001">
<LINK TITLE="style" TYPE="text/CSS" rel="stylesheet" HREF="./librairie_css/css.css">
<script language="JavaScript" src="./librairie_js/verif_creat.js"></script>
<script language="JavaScript" src="./librairie_js/lib_defil.js"></script>
<script language="JavaScript" src="./librairie_js/clickdroit.js"></script>
<script language="JavaScript" src="./librairie_js/function.js"></script>
<title>Triade - Compte de <?php print "$_SESSION[nom] $_SESSION[prenom] "?></title>
</head>
<body id='bodyfond' marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" onload="Init();" >
<?php include("./librairie_php/lib_licence.php"); ?>
<?php include("./librairie_php/lib_attente.php"); ?>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/".$_SESSION[membre].".js'>" ?></SCRIPT>
<?php include("./librairie_php/lib_defilement.php"); ?>
</TD><td width="472" valign="middle" rowspan="3" align="center">
<div align='center'><?php top_h(); ?>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/".$_SESSION[membre]."1.js'>" ?></SCRIPT>
<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="85">
<tr id='coulBar0' ><td height="2"><b><font   id='menumodule1' ><?php print LANGTITRE33?></font></b></td></tr>
<tr id='cadreCentral0' >
<td >
<!-- // fin  --><br> <br>
<?php
include_once('librairie_php/db_triade.php');
include_once('librairie_php/timezone.php');
include_once("librairie_php/recupnoteperiode.php");
$cnx=cnx();

// recupe du nom de la classe
if (isset($_POST["idclasse"])) {
	$data=chercheClasse($_POST["idclasse"]);
	$classeNom=$data[0][1];
	$classeNomLong=$data[0][2];
	$idClasse=$_POST["idclasse"];
	$laclasse=1;
	$fic="classe".$idclasse;
	$num_certif=$_POST["num_certif"];
}

if (isset($_GET["eid"])) {
	$ideleve=$_GET["eid"];
	$nomEleve=trim(strtoupper(recherche_eleve_nom($ideleve)));
	$prenomEleve=trim(ucwords(strtolower(recherche_eleve_prenom($ideleve))));
	$idclasse=chercheIdClasseDunEleve($ideleve);
	$data=chercheClasse($idclasse);
	$dateNaissanceEleve=dateForm(chercheDateNaissance($ideleve));
	$classeNom=$data[0][1];
	$classeNomLong=$data[0][2];
	$adresseEleve=rechercheAdresseEleve($ideleve);
	$CodePostalEleve=rechercheCodePostalEleve($ideleve);
	$VilleEleve=rechercheVilleEleve($ideleve);
	$eleve=$ideleve."-".$idclasse;
	$laclasse=0;
	$LieuDeNaissance=rechercheLieuNaissanceEleve($ideleve);
	$Nationalite=rechercheNationaliteEleve($ideleve);
	$num_certif=$_GET["num_certif"];
}


$paramScolaire=visu_param(); // nom_ecole,adresse,postal,ville,tel,email,directeur,urlsite,academie,pays,departement,annee_scolaire
$anneeScolaire=$paramScolaire[0][11];
$datedujour=dateDMY();

// creation PDF
// -----------
define('FPDF_FONTPATH','./librairie_pdf/fpdf/font/');
include_once('./librairie_pdf/fpdf/fpdf.php');
include_once('./librairie_pdf/html2pdf.php');

$pdf=new PDF();  // declaration du constructeur


if ($laclasse == 1) {
	$eleveT=recupEleve($idClasse);      // nom,prenom,lv1,lv2,elev_id,date_naissance
	for($j=0;$j<count($eleveT);$j++) {  // premiere ligne de la creation PDF
	
		$nomEleve=trim(strtoupper($eleveT[$j][0]));
		$prenomEleve=trim(ucwords(strtolower($eleveT[$j][1])));
		$dateNaissanceEleve=dateForm(chercheDateNaissance($eleveT[$j][4]));
		$adresseEleve=rechercheAdresseEleve($eleveT[$j][4]);
		$CodePostalEleve=rechercheCodePostalEleve($eleveT[$j][4]);
		$VilleEleve=rechercheVilleEleve($eleveT[$j][4]);
		$Nationalite=rechercheNationaliteEleve($ideleve);
		$data=config_param_visu("param_certifica$num_certif");
		$texte=$data[0][0];
		$texte=ereg_replace("NomEleve","$nomEleve",$texte);
		$texte=ereg_replace("PrenomEleve","$prenomEleve",$texte);
		$texte=ereg_replace("ClasseEleveLong",$classeNomLong,$texte);
		$texte=ereg_replace("ClasseEleve","$classeNom",$texte);
		$texte=ereg_replace("DateNaissanceEleve","$dateNaissanceEleve",$texte);
		$texte=ereg_replace("AdresseEleve","$adresseEleve",$texte);
		$texte=ereg_replace("CodePostalEleve","$CodePostalEleve",$texte);
		$texte=ereg_replace("VilleEleve",ucwords($VilleEleve),$texte);
		$texte=ereg_replace("LieuDeNaissance",ucwords($LieuDeNaissance),$texte);
		$texte=ereg_replace("AnneeScolaire",$anneeScolaire,$texte);
		$texte=ereg_replace("DateDuJour",$datedujour,$texte);
		$texte=ereg_replace("Nationalite",$Nationalite,$texte);

		$pdf->AddPage();
		$pdf->SetXY(0,0);
		$pdf->WriteHTML($texte);

	}

	print " &nbsp;&nbsp;".LANGPARAM5." ".$classeNom." ".LANGPARAM5bis.".<br><br>";
	$fichierpdf="./data/pdf_certif/certificat-scolarite_".$fic.".pdf";
	if (file_exists($fichierpdf))  {  @unlink($fichierpdf); }
	$pdf->output($fichierpdf);

}else {

	$data=config_param_visu("param_certifica$num_certif");
	$texte=$data[0][0];
	$texte=ereg_replace("NomEleve","$nomEleve",$texte);
	$texte=ereg_replace("PrenomEleve","$prenomEleve",$texte);
	$texte=ereg_replace("ClasseEleveLong",$classeNomLong,$texte);
	$texte=ereg_replace("ClasseEleve","$classeNom",$texte);
	$texte=ereg_replace("DateNaissanceEleve","$dateNaissanceEleve",$texte);
	$texte=ereg_replace("AdresseEleve","$adresseEleve",$texte);
	$texte=ereg_replace("CodePostalEleve","$CodePostalEleve",$texte);
	$texte=ereg_replace("VilleEleve",ucwords($VilleEleve),$texte);
	$texte=ereg_replace("LieuDeNaissance",ucwords($LieuDeNaissance),$texte);
	$texte=ereg_replace("AnneeScolaire",$anneeScolaire,$texte);
	$texte=ereg_replace("DateDuJour",$datedujour,$texte);
	$texte=ereg_replace("Nationalite",$Nationalite,$texte);

	print " &nbsp;&nbsp;".LANGCERTIF1." ".$nomEleve." ".$prenomEleve." ".LANGCERTIF1bis.".<br><br>";
	$fic=$eleve;

	$pdf->AddPage();
	$pdf->SetXY(0,0);
	$pdf->WriteHTML($texte);

	$fichierpdf="./data/pdf_certif/certificat-scolarite_".$fic.".pdf";
	if (file_exists($fichierpdf))  {  @unlink($fichierpdf); }
	$pdf->output($fichierpdf);

}
?>


<br>
<ul><ul>
<input type=button onclick="open('visu_pdf_admin.php?id=<?php print $fichierpdf?>','_blank','');" value="<?php print LANGPER5?>"  STYLE="font-family: Arial;font-size:10px;color:#CC0000;background-color:#CCCCFF;font-weight:bold;">
</ul></ul>
<br /><br />
<!-- // fin  -->
</td></tr></table>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/".$_SESSION[membre]."2.js'>" ?></SCRIPT>
</BODY></HTML>
<?php
Pgclose();
?>
