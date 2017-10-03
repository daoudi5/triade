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
 
include_once("../librairie_php/lib_get_init.php");
$id=php_ini_get("safe_mode");
if ($id != 1) {
	set_time_limit(600);
} 
 
 
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

include_once("../librairie_php/ajax.php");
ajax_js();

?>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL215 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param13.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a href='gestion_stage_ent_visu.php' ><?php print LANGVATEL225 ?></a></li>
				<li style="visibility:visible" ><a href='gestion_stage_ent_ajout.php' ><?php print LANGASS8 ?></a></li>
				<li style="visibility:visible" ><a href='' ><?php print LANGMESS149 ?></a></li>
				<li style="visibility:visible" ><a href='' ><?php print LANGASS10 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

<?php
define('FPDF_FONTPATH','../librairie_pdf/fpdf/font/');
include_once('../librairie_pdf/fpdf/fpdf.php');
include_once('../librairie_pdf/html2pdf.php');

$pdf=new PDF();  // declaration du constructeur

$pdf->AddPage();
$pdf->SetTitle("Liste des entreprises");
$pdf->SetCreator("T.R.I.A.D.E.");
$pdf->SetSubject("Liste des entreprises"); 
$pdf->SetAuthor("T.R.I.A.D.E. - www.triade-educ.com"); 

$xcoor0="5";
$ycoor0="5";
$dateJour=dateDMY();

$pdf->SetFont('Arial','',12);
$pdf->SetXY($xcoor0,$ycoor0);
$pdf->WriteHTML(LANGVATEL233." $dateJour ");
$pdf->SetXY(5,$ycoor0+=5);
$pdf->WriteHTML("----------------------------------------------------------------------------------------------------------------------------------------");


$pdf->SetXY(5,$ycoor0+=5);



$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(230,230,255);
$pdf->SetXY($xcoor0,$ycoor0);
$pdf->MultiCell(30,6,LANGSTAGE95,1,'L',1);
$pdf->SetXY($xcoor0+=30,$ycoor0);
$pdf->MultiCell(40,6,LANGVATEL232,1,'L',1);
$pdf->SetXY($xcoor0+=40,$ycoor0);
$pdf->MultiCell(40,6,LANGSTAGE31,1,'L',1);
$pdf->SetXY($xcoor0+=40,$ycoor0);
$pdf->MultiCell(50,6,LANGAGENDA267,1,'L',1);
$pdf->SetXY($xcoor0+=50,$ycoor0);
$pdf->MultiCell(33,6,LANGSTAGE37,1,'L',1);

$ycoor0+=6;
$data=listingEntreprise();
// nom,contact,adresse,code_p,ville,secteur_ac,activite_prin,tel,fax,email,info_plus,bonus,contact_fonction,pays_ent
for($i=0;$i<count($data);$i++) { 
	$xcoor0=5;
	$societe=$data[$i][0];
	$addr=$data[$i][2];
	$ccp=$data[$i][3];
	$ville=$data[$i][4];
	$secteurAc=$data[$i][5];
	$activite_prin=$data[$i][6];
	$tel=$data[$i][7];
	$fax=$data[$i][8];
	$contact=$data[$i][1];
	$email=$data[$i][9];
	$fonction=$data[$i][12];
	$info=$data[$i][10];


	
	$pdf->SetFont('Arial','',7);
	$pdf->SetFillColor(255,255,255);
	
	$pdf->SetXY($xcoor0,$ycoor0);
	$pdf->MultiCell(30,3,"$societe",0,'L',0);
	$pdf->SetXY($xcoor0,$ycoor0);
	$pdf->MultiCell(30,10,"",1,'L',0);

	$pdf->SetXY($xcoor0+=30,$ycoor0);
	$pdf->MultiCell(40,3,"$addr / $ccp / $ville",0,'L',0);
	$pdf->SetXY($xcoor0,$ycoor0);
	$pdf->MultiCell(40,10,"",1,'L',0);


	$pdf->SetXY($xcoor0+=40,$ycoor0);
	$pdf->MultiCell(40,3,"$secteurAc",0,'L',0);
	$pdf->SetXY($xcoor0,$ycoor0);
	$pdf->MultiCell(40,10,"",1,'L',0);

	$pdf->SetXY($xcoor0+=40,$ycoor0);
	$pdf->MultiCell(50,3,"$contact $tel $email",0,'L',0);
	$pdf->SetXY($xcoor0,$ycoor0);
	$pdf->MultiCell(50,10,"",1,'L',0);

	$pdf->SetXY($xcoor0+=50,$ycoor0);
	$pdf->MultiCell(33,3,"$info",0,'L',0);
	$pdf->SetXY($xcoor0,$ycoor0);
	$pdf->MultiCell(33,10,"",1,'L',0);

	$ycoor0+=10;

	if ($ycoor0 > 260) {
		$pdf->AddPage();
		$ycoor0=20;
		$xcoor0=5;
		$pdf->SetFont('Arial','B',9);
		$pdf->SetFillColor(230,230,255);
		$pdf->SetXY($xcoor0,$ycoor0);
		$pdf->MultiCell(30,6,LANGSTAGE95,1,'L',1);
		$pdf->SetXY($xcoor0+=30,$ycoor0);
		$pdf->MultiCell(40,6,LANGVATEL232,1,'L',1);
		$pdf->SetXY($xcoor0+=40,$ycoor0);
		$pdf->MultiCell(40,6,LANGSTAGE31,1,'L',1);
		$pdf->SetXY($xcoor0+=40,$ycoor0);
		$pdf->MultiCell(50,6,LANGAGENDA267,1,'L',1);
		$pdf->SetXY($xcoor0+=50,$ycoor0);
		$pdf->MultiCell(33,6,LANGSTAGE37,1,'L',1);
		$ycoor0+=6;
	}
}

$fichier="../data/pdf_certif/listingEntreprise".$_SESSION["id_pers"].".pdf";
@unlink($fichier); // destruction avant creation
$pdf->output($fichier);
$pdf->close();

?>

<br><ul><ul>
<?php
if ($_SESSION["membre"] == "menuadmin") { ?>
	<input type=button onclick="open('visu_pdf_admin.php?id=<?php print $fichier ?>','_blank','');" value="<?php print LANGVATEL231 ?>"  class='btn btn-primary btn-sm  vat-btn-footer'  >
<?php }elseif($_SESSION["membre"] == "menuprof") { ?>
	<input type=button onclick="open('visu_pdf_prof.php?id=<?php print $fichier ?>','_blank','');" value="<?php print LANGVATEL231 ?>"  class='btn btn-primary btn-sm  vat-btn-footer' >
<?php }elseif(($_SESSION["membre"] == "menuparent") || ($_SESSION["membre"] == "menueleve")) { ?>
	<input type=button onclick="open('visu_document.php?id=<?php print $fichier ?>','_blank','');" value="<?php print LANGVATEL231 ?>"  class='btn btn-primary btn-sm  vat-btn-footer'  >
<?php }elseif($_SESSION["membre"] == "menupersonnel")  { ?>
	<input type=button onclick="open('visu_pdf_personnel.php?id=<?php print $fichier ?>','_blank','');" value="<?php print LANGVATEL231 ?>"  class='btn btn-primary btn-sm  vat-btn-footer'  >
<?php }else{ ?>
	<input type=button onclick="open('visu_pdf_admin.php?id=<?php print $fichier ?>','_blank','');" value="<?php print LANGVATEL231 ?>"  class='btn btn-primary btn-sm  vat-btn-footer' >


<?php } ?>
<br>
		
		
		
			
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