<?php
session_start();
$anneeScolaire=$_COOKIE["anneeScolaire"];
if (isset($_POST["anneeScolaire"])) {
        $anneeScolaire=$_POST["anneeScolaire"];
        setcookie("anneeScolaire",$anneeScolaire,time()+36000*24*30);
}
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
include_once("../common/config.inc.php"); // futur : auto_prepend_file
include_once("../librairie_php/db_triade.php");



include_once("entete.php");
include_once("menu.php");

$cnx=cnx2();

// Sn : variable de Session nom
// Sp : variable de Session prenom
// Sm : variable de Session membre
// Spid : variable de Session pers_id
$ident=array('nom','Sn','prenom','Sp','membre','Sm','id_pers','Spid');
$mySession=hashSessionVar($ident);
unset($ident);
// données DB utiles pour cette page
$mys=$mySession[Spid];

$anneeScolaire=$_POST['anneeScolaire'];
$idclasse=$_POST['sClasseGrp'];
$nomclasse=chercheClasse_nom($idclasse);

?> 
	<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGMESS250 ?> <?php print $nomclasse ?>  / <?php print $anneeScolaire ?></span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px" >

<?php
if ($_POST["sClasseGrp"] > 0) {
	$saisie_classe=$_POST["sClasseGrp"];

	$sql=" SELECT s.* FROM ( SELECT libelle,elev_id,nom,prenom,date_naissance,regime,numero_eleve,code_compta,nomtuteur,prenomtuteur,civ_1,telephone,email FROM ${prefixe}eleves ,${prefixe}classes  WHERE classe='$saisie_classe' AND code_class='$saisie_classe' AND annee_scolaire='$anneeScolaire' UNION ALL SELECT c.libelle,e.elev_id,e.nom,e.prenom,e.date_naissance,e.regime,e.numero_eleve,e.code_compta,e.nomtuteur,e.prenomtuteur,e.civ_1,e.telephone,e.email FROM ${prefixe}eleves e ,${prefixe}classes c, ${prefixe}eleves_histo h WHERE h.idclasse='$saisie_classe' AND e.elev_id=h.ideleve AND h.idclasse=c.code_class AND h.annee_scolaire='$anneeScolaire') s  ORDER BY s.nom";

	$res=execSql($sql);
	$data=chargeMat($res);

	// ne fonctionne que si au moins 1 élève dans la classe
	// nom classe
	$cl=$data[0][0];

	if( count($data) > 0 ) {
		$fic=$_POST["sClasseGrp"];
		$fichierpdf="../data/pdf_certif/Classe_".suppCaracFichier($cl).".pdf";
		$fichierpdf2="../data/pdf_certif/Classe2_".suppCaracFichier($cl).".pdf";
		define('FPDF_FONTPATH','../librairie_pdf/fpdf/font/');
		include_once('../librairie_pdf/fpdf/fpdf.php');
		include_once('../librairie_pdf/html2pdf.php');
		include_once("../librairie_php/timezone.php");
	
		$pdf=new PDF();  // declaration du constructeur
		$pdf->AddPage();

		
		$pdf2=new PDF();  // declaration du constructeur
		$pdf2->AddPage();

		$date=dateDMY();
		// insertion de la Annee SCOLAIRE
		$Pdate="En classe $cl -  $date - (".LANGBULL3." : $anneeScolaire)";
		$pdf->SetFont('Courier','',12);
		$pdf2->SetFont('Courier','',12);
		$xcoor0=30;
		$ycoor0=20;
		$xcoor20=30;
		$ycoor20=10;
		$pdf->SetXY($xcoor0,$ycoor0);
		$pdf->WriteHTML($Pdate);
		
		$pdf2->SetXY($xcoor20,$ycoor20);
		$pdf2->WriteHTML($Pdate);

		$xcoor0+=20;
		$ycoor0+=10;
		$xcoor20=10;
		$ycoor20+=10;
		$j=0;
		for($i=0;$i<count($data);$i++) { // libelle,elev_id,nom,prenom,date_naissance,regime,numero_eleve,code_compta,nomtuteur,prenomtuteur,civ_1,telephone,email,nom_resp2,prenom_resp2,civ_2
			if ($ii == 45) {
	                	$pdf->AddPage();
				$ii=0;
				$xcoor0=50;
				$ycoor0=20;
			}

			if ($ii2 == 45) {
	                	$pdf2->AddPage();
				$ii2=0;
				$xcoor20=10;
				$ycoor20=20;
			}

			$ii++;
			$ii2++;

			$j++;

			$eleve=$j.") ".strtoupper($data[$i][2])." ".trunchaine(ucwords($data[$i][3]),50);

			$datenaissance=utf8_decode(" Né(e) le ").dateForm($data[$i][4]);
			$regime=utf8_decode("Régime :").$data[$i][5];
			$ine="Code INE : ".$data[$i][6];
			$compta=utf8_decode("Code Comptabilité : ").$data[$i][7];

			$nomtuteur=strtoupper($data[$i][8]);
			$prenomtuteur=ucwords($data[$i][9]);
			$nom_resp_2=strtoupper($data[$i][13]);
			$prenom_resp_2=ucwords($data[$i][14]);

			if ($data[$i][15] != "") $civ_2=civ($data[$i][15]);
			if ($data[$i][10] != "") $civ_1=civ($data[$i][10]);
			$telephone=preg_replace('/ /','.',$data[$i][11]);
			$email=$data[$i][12];
			$nomprenomresp="Responsable : $civ_1 $nomtuteur $prenomtuteur - $civ_2 $nom_resp_2 $prenom_resp_2";
			$telresp=utf8_decode("Tél : $telephone");
			$emailresp="Email : $email";

			$eleve2=strtoupper($data[$i][2])." ".trunchaine(ucwords($data[$i][3]),50).$datenaissance;

			$pdf->SetXY($xcoor0,$ycoor0);
			$pdf->WriteHTML($eleve);

			
			$photo=image_bulletin($data[$i][1]);
			if (($photo == "../data/image_eleve/") || ($photo == "")) { 
				$photo="../image/commun/photo_vide.jpg"; 
				$h=18;$l=18;
			}else{
				list($width, $height, $type, $attr) = getimagesize("$photo");
				$l=$height/6;
				$h=$width/6;
			}
			
			$pdf2->SetFont('Courier','',9);
			//$pdf2->Image($photo,$xcoor20,$ycoor20,$h,$l);
			$pdf2->SetXY($xcoor20+19,$ycoor20-=1);
			$pdf2->WriteHTML($eleve2);
		//	$pdf2->SetXY($xcoor20+19,$ycoor20+4);
			//$pdf2->WriteHTML("$regime / $ine / $compta");
		//	$pdf2->SetXY($xcoor20+19,$ycoor20+8);
			//$pdf2->WriteHTML("$nomprenomresp ");
		//	$pdf2->SetXY($xcoor20+19,$ycoor20+12);
			//$pdf2->WriteHTML("$telresp / $emailresp");
			$pdf2->SetFont('Courier','',12);

			$ycoor0+=5;
			$ycoor20+=5;



		}
		if (file_exists($fichierpdf))  {  @unlink($fichierpdf); }
		$pdf->output($fichierpdf);
		if (file_exists($fichierpdf2))  {  @unlink($fichierpdf2); }
		$pdf2->output($fichierpdf2);

	}
}

?>

<input  class="btn btn-primary btn-sm  vat-btn-footer"  type='button' onClick="open('tronbinoscope-impr-pdf.php?idclasse=<?php print $idclasse ?>&anneeScolaire=<?php print $anneeScolaire ?>','_blank','')" value="<?php print LANGASS38." (PDF)" ?> " />
<input  class="btn btn-primary btn-sm  vat-btn-footer"  type='button' onClick="open('visu_pdf_prof.php?id=<?php print $fichierpdf2 ?>','_blank','')" value="<?php print "Listing (PDF)" ?>" />


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
