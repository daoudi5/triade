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

$idpers=$mySession[Spid];

validerequete("3");


?>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL138 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param10.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a href='emargement.php' ><?php print LANGVATEL153 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
<?php
if (isset($_POST["saisie_groupe"])) {
	$idgroupe=$_POST["saisie_groupe"];
	$nomClasse=chercheGroupeNom($idgroupe);
	$CLASSE="GROUPE";
}else{
	$idClasse=$_POST["saisie_classe"];
	$nomClasse=chercheClasse_nom($idClasse);
	$CLASSE="CLASSE";
}

define('FPDF_FONTPATH','../librairie_pdf/fpdf/font/');
include_once('../librairie_pdf/fpdf/fpdf.php');
include_once('../librairie_pdf/html2pdf.php');

config_param_ajout($_POST["hauteur"],"hauteuremarg");

$pdf=new PDF();  // declaration du constructeur

$pdf->AddPage();
$pdf->SetTitle("Emargement -");
$pdf->SetCreator("T.R.I.A.D.E.");
$pdf->SetSubject("Emargement "); 
$pdf->SetAuthor("T.R.I.A.D.E. - www.triade-educ.com"); 

$hauteur=$_POST["hauteur"];

$X=0;
$Y=5;
$pdf->SetXY($X,$Y);
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(210,6,"FEUILLE DE PRESENCE EN $CLASSE DE \n $nomClasse",0,'C',0);
$pdf->SetFont('Arial','',9);
$pdf->SetXY($X+=5,$Y+=15);
$pdf->SetFillColor(230,230,255);
if (EMARGEMENT == "STANDARD" ) {
	$pdf->RoundedRect($X, $Y, 120, 25, 3.5, 'DF');
}else{
	$pdf->RoundedRect($X, $Y, 120, 28, 3.5, 'DF');
}
$pdf->SetFillColor(255);
$pdf->SetXY($X+2,$Y+=2);
$pdf->MultiCell(130,3,"Objet  : .................................................................................................................... ",0,'L',0);
$pdf->SetXY($X+2,$Y+=5);
$pdf->MultiCell(130,3,"Date : ................ ".LANGVATEL155." : ..............  ".LANGVATEL156." : ..............   ".LANGABS21." : ........... ",0,'L',0);
$pdf->SetXY($X+2,$Y+=5);
$pdf->MultiCell(130,3,"Enseignant : ............................................................................................................ ",0,'L',0);
if (EMARGEMENT == "STANDARD" ) {
	$pdf->SetXY($X+2,$Y+=5);
	$pdf->MultiCell(130,3,LANGVATEL157." : ..................................................................................................... ",0,'L',0);
}else{
	$pdf->SetXY($X+2,$Y+=5);
	$pdf->MultiCell(130,3,"P.E : ........................................................................................................................ ",0,'L',0);
	$pdf->SetXY($X+2,$Y+=5);
	$pdf->MultiCell(130,3,LANGASS18." : .................................................................................................................. ",0,'L',0);
}

$pdf->SetXY($X+=95,$Y+=10);
$pdf->SetFont('Arial','',6);
$pdf->MultiCell(10,$hauteur,"Présent",1,'C',1);
$pdf->SetXY($X+=10,$Y);
$pdf->MultiCell(10,$hauteur,"Absent",1,'C',1);
$pdf->SetXY($X+=10,$Y);
$pdf->MultiCell(40,$hauteur,"Emargement Etudiant",1,'C',1);
$pdf->SetXY($X+=40,$Y);
$pdf->MultiCell(45,$hauteur,"Observation",1,'C',1);

$Y+=$hauteur;


include_once('../librairie_php/recupnoteperiode.php');
if ($idgroupe == 0) {
	$eleveT=recupEleve($idClasse); // recup liste eleve
}else{
	$tabEleveT=listeEleveDansGroupe($idgroupe);
	$i=0;
	foreach ($tabEleveT as $key=>$value) {
		$sql="SELECT nom,prenom,lv1,lv2,elev_id,date_naissance,lieu_naissance,adr1,code_post_adr1,commune_adr1,telephone,numero_eleve,tel_fixe_eleve FROM ${prefixe}eleves WHERE elev_id='$value' ";
		$curs=execSql($sql);
		$liste=chargeMat($curs);
		$eleveT[$i][0]=$liste[0][0];
		$eleveT[$i][1]=$liste[0][1];
		$eleveT[$i][2]=$liste[0][2];
		$eleveT[$i][3]=$liste[0][3];
		$eleveT[$i][4]=$liste[0][4];
		$eleveT[$i][5]=$liste[0][5];
		$eleveT[$i][6]=$liste[0][6];
		$eleveT[$i][7]=$liste[0][7];
		$eleveT[$i][8]=$liste[0][8];
		$eleveT[$i][9]=$liste[0][9];
		$eleveT[$i][10]=$liste[0][10];
		$eleveT[$i][11]=$liste[0][11];
		$eleveT[$i][12]=$liste[0][12];
		$i++;
	}
}


for($j=0;$j<count($eleveT);$j++) {  // variable eleve
	$nomEleve=strtoupper($eleveT[$j][0]);
	$prenomEleve=ucfirst($eleveT[$j][1]);
	$nomprenom=trunchaine("$nomEleve $prenomEleve",25);
	$idEleve=$eleveT[$j][4];
	$numEleve=$eleveT[$j][11];
	$X=0;
	$pdf->SetFont('Arial','',8);
	$pdf->MultiCell(100,$hauteur,"$nomprenom",1,'L',0);
	$pdf->SetXY($X+=100,$Y);
//	$pdf->MultiCell(40,$hauteur,"N° $numEleve",1,'L',1);
//	$pdf->SetXY($X+=40,$Y);
	$pdf->MultiCell(10,$hauteur,"",1,'C',0);
	$pdf->SetXY($X+=10,$Y);
	$pdf->MultiCell(10,$hauteur,"",1,'C',0);
	$pdf->SetXY($X+=10,$Y);
	$pdf->MultiCell(40,$hauteur,"",1,'C',0);
	$pdf->SetXY($X+=40,$Y);
	$pdf->MultiCell(45,$hauteur,"",1,'C',0);
	$Y+=$hauteur;
	if ($Y >= 260) {
		$pdf->AddPage(); 
		$Y=10;
	}
}
$pdf->SetFont('Arial','B',8);
$pdf->SetXY($X=150,$Y+=3);
$pdf->MultiCell(55,15,"",1,'L',0);
$pdf->SetXY($X,$Y+1);
$pdf->MultiCell(45,3,"Signature de l'enseignant : ",0,'L',0);

$pdf->SetFont('Arial','',8);
$pdf->SetXY($X=10,$Y);
$pdf->MultiCell(130,15,"",1,'L',0);
$pdf->SetXY($X,$Y+1);
$pdf->MultiCell(100,3,"Observations générales",0,'L',0);




$fichier="../data/pdf_certif/emargementvierge_".$idClasse.".pdf";
@unlink($fichier); // destruction avant creation
$pdf->output($fichier);
$pdf->close();
$bttexte=LANGPARAM33;
?>
<br><br>
<center>
<?php 
$url="visu_pdf_scolaire.php";
if ($_SESSION["membre"] == "menuprof") { $url="visu_pdf_prof.php"; }	
?>
<input type=button onclick="open('<?php print $url?>?id=<?php print $fichier?>','_blank','');" value="<?php print $bttexte ?>"  class='btn btn-primary btn-sm  vat-btn-footer' >
</center>
	
			
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