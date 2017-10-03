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
// connexion
if ((empty($_SESSION["nom"])) && (empty($_SESSION["membre"]) ) ) { header("Location:./acces_refuse.php"); exit; }
include_once("../common/config.inc.php");
include_once("../librairie_php/db_triade.php");
validerequete("menuprof");
include_once("../common/config2.inc.php");
$cnx=cnx2();
// nom classe

if (isset($_GET["anneeScolaire"])) {
	$anneeScolaire=$_GET["anneeScolaire"];
	list($saisie_classe,$null)=preg_split('/:/',$_GET["idclasse"]);
	$cid=$saisie_classe;
	$sql="(SELECT e.elev_id, e.nom,e.prenom,e.classe  FROM ${prefixe}eleves e WHERE e.classe='$cid' AND e.annee_scolaire = '$anneeScolaire' ) UNION (SELECT e.elev_id,e.nom,e.prenom,e.classe FROM ${prefixe}eleves e , ${prefixe}eleves_histo h WHERE h.idclasse='$cid' AND h.annee_scolaire = '$anneeScolaire' AND e.elev_id=h.ideleve group by elev_id ) ORDER BY nom";
        $res=execSql($sql);
        $data=chargeMat($res);
        $cl=chercheClasse_nom($idclasse);
}

if ((isset($_GET["idclasse"])) && ($_GET["anneeScolaire"] == ""))  {
	$saisie_classe=$_GET["idclasse"];
	$sql="SELECT elev_id,nom,prenom FROM ${prefixe}eleves,${prefixe}classes WHERE classe='$saisie_classe' AND code_class='$saisie_classe' ORDER BY nom";
	$res=execSql($sql);
	$data=chargeMat($res);
	$cl=chercheClasse_nom($idclasse);
}


if (isset($_GET['nomregime'])) {
	$regime=$_GET["nomregime"];
	$sql="SELECT elev_id,nom,prenom FROM ${prefixe}eleves,${prefixe}classes  WHERE regime='$regime' AND code_class=classe  ";
	$res=execSql($sql);
        $data=chargeMat($res);
	$cl=$regime;
}


// ne fonctionne que si au moins 1 �l�ve dans la classe
// nom classe

define('FPDF_FONTPATH','../librairie_pdf/fpdf/font/');
include_once('../librairie_pdf/fpdf/fpdf.php');
include_once('../librairie_pdf/html2pdf.php');
$pdf=new PDF();  // declaration du constructeur
$pdf->AddPage();
$pdf->SetTitle("Trombinoscope - $cl");
$pdf->SetCreator("T.R.I.A.D.E.");
$pdf->SetSubject("Trombinoscope - $cl "); 
$pdf->SetAuthor("T.R.I.A.D.E. - www.triade-educ.com"); 
$x=0;$y=10;

$pdf->SetFont('Arial','B',12);
$pdf->SetXY($x,$y);
$pdf->MultiCell(210,5,"$cl",0,'C',0);
$y+=10;

$x=7;
$nbp=1;

$pdf->SetFont('Arial','',8);
for($i=0;$i<count($data);$i++) {

	$logo="../data/image_eleve/".$data[$i][0].".jpg";
	if (!file_exists($logo)) { $logo="../image/commun/photo_vide.jpg"; }
	$pdf->Image($logo,$x,$y,20,20);
	$pdf->SetXY($x+20,$y);
	$nomprenom=strtoupper($data[$i][1])."\n".ucwords($data[$i][2]);
	$pdf->MultiCell(30,5,"$nomprenom",0,'L',0);	
	$x+=50;
	if ($x >= 200) {
		$x=7;
		$y+=25;
	}
	if ($y >= 270) {
		$pdf->AddPage();
		$x=7;
		$y=10;
	}
}
Pgclose();
$fic="../data/pdf_certif/trombinoscope-$cl.pdf";
@unlink($fic);
$pdf->output($fic);

header("Content-disposition: attachment; filename=trombinoscope-$cl.pdf");
header("Content-Type: application/force-download");
header("Content-Transfer-Encoding: application/pdf\n"); // Surtout ne pas enlever le \n
header("Content-Length: ".filesize($fic));
if (HTTPS == "oui") {
	header("Cache-Control: public"); 
	header("Pragma:"); 
	header("Expires: 0");
}else{
	header("Pragma: no-cache");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0, public");
	header("Expires: 0");
}
readfile($fic);


?>