<?php
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
 
$anneeScolaire=$_COOKIE["anneeScolaire"];
if (isset($_POST["anneeScolaire"])) {
        $anneeScolaire=$_POST["anneeScolaire"];
        setcookie("anneeScolaire",$anneeScolaire,time()+36000*24*30);
}

include_once("entete.php");
include_once("menu.php");
include_once("../common/config2.inc.php");
include_once("../librairie_php/lib_note.php"); 
$cnx=cnx2();

// Sn : variable de Session nom
// Sp : variable de Session prenom
// Sm : variable de Session membre
// Spid : variable de Session pers_id
$ident=array('nom','Sn','prenom','Sp','membre','Sm','id_pers','Spid');
$mySession=hashSessionVar($ident);
unset($ident);

validerequete("menuadmin");
$idpers=$mySession[Spid];
?>
<script language="JavaScript" src="../librairie_js/verif_creat.js"></script>
		
<script language="JavaScript" src="../librairie_js/verif_creat.js"></script>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL160 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param10.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>
		
		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
			
<?php		
			
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
define('FPDF_FONTPATH','../librairie_pdf/fpdf/font/');
include_once('../librairie_pdf/fpdf/fpdf.php');
include_once('../librairie_pdf/html2pdf.php');

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
	$fichierpdf="../data/pdf_certif/certificat-scolarite_".$fic.".pdf";
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

	$fichierpdf="../data/pdf_certif/certificat-scolarite_".$fic.".pdf";
	if (file_exists($fichierpdf))  {  @unlink($fichierpdf); }
	$pdf->output($fichierpdf);

}
?>		

<br>
<ul><ul>
<input type=button onclick="open('visu_pdf_admin.php?id=<?php print $fichierpdf?>','_blank','');" value="<?php print LANGPER5?>"  class='btn btn-primary btn-sm  vat-btn-footer' >
</ul></ul>
<br /><br />


		</section>
		</div>
		</div>
	</div>
<?php
Pgclose();
include_once("piedpage.php");
include_once("connexionEnCours.php");
?>
</body>
</html>