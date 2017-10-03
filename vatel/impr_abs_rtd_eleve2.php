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
 
include_once("entete.php");
include_once("menu.php");
include_once("../common/config2.inc.php");
include_once("../librairie_php/lib_note.php"); 
$cnx=cnx2();
validerequete("menuadmin");
$_COOKIE["anneeScolaire"]="";

if ($_SESSION["membre"] == "menuadmin") {
	
	if (isset($_POST["modif_date"])) {
		$date=$_POST["saisie_date"];
	}else{
		$date=dateDMY();
	}

	if (isset($_POST["sClasseGrp"])) {
		$filtreCLasse=$_POST["sClasseGrp"];
	}else{
		$filtreCLasse="tous";
	}	

?>
	<script language="JavaScript" >
	function print_abs_rtd_du_jour(){
		var ok=confirm(langfunc3);
		if (ok) {
			open('../gestion_abs_retard_du_jour_print.php?id=<?php print dateFormBase($date) ?>&filtre=<?php print $filtreCLasse?>','_blank','');		
		}
	}

	function print_abs_rtd_du_jour_2(){
		var ok=confirm(langfunc3);
		if (ok) {
			open('../gestion_abs_retard_du_jour_print.php?id=<?php print dateFormBase($date) ?>&filtre=<?php print $filtreCLasse?>&inconnu=1','_blank','');		
		}
	}
	</script>
	<script language="JavaScript" src="./librairie_js/lib_absrtdplanifier.js"></script>

	<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print "Gestion Absences / Retards"  ?></span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='gestionABSRtdSanc.php' ><?php print LANGVATEL21 ?></a></li>
				<li style="visibility:visible" ><a href='consulterABSRtd.php' ><?php print LANGBT28."/".LANGPER30 ?></a></li>
				<li style="visibility:visible" ><a href='impr_abs_rtd_eleve.php' ><?php print LANGVATEL264 ?></a></li>
				<li style="visibility:visible" ><a href='alerteAbsRtd.php' ><?php print "Alerte Absences" ?></a></li>
                                <li style="visibility:visible" ><a href='alerteAbsRtdSMS.php' ><?php print "Alerte SMS" ?></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
<br><br>

<?php
$dateDebut=dateFormBase($_POST["saisie_date_debut"]);
$dateFin=dateFormBase($_POST["saisie_date_fin"]);
$idClasse=$_POST["saisie_classe"];
$absrtd=$_POST["absrtd"];

define('FPDF_FONTPATH','../librairie_pdf/fpdf/font/');
include_once('../librairie_pdf/fpdf/fpdf.php');
include_once('../librairie_pdf/html2pdf.php');

include("../librairie_php/class.writeexcel_workbook.inc.php");
include("../librairie_php/class.writeexcel_worksheet.inc.php");

$fichierxls="../data/fichier_ASCII/export_abs_".$_SESSION["id_pers"].".xls";
@unlink($fichierxls);
// $fname = tempnam("/tmp", "$fichier");
	
$workbook = &new writeexcel_workbook($fichierxls);
$worksheet =& $workbook->addworksheet("Listing Abs Rtd");

$header =& $workbook->addformat();
$header->set_color('white');
$header->set_align('center');
$header->set_align('vcenter');
$header->set_pattern();
$header->set_fg_color('blue');

$center =& $workbook->addformat();
$center->set_align('left');

$worksheet->set_column('A:B',10);
$worksheet->set_column('B:C',20);
$worksheet->set_column('C:D',20);
$worksheet->set_column('D:E',30);
$worksheet->set_column('E:F',30);
$worksheet->set_column('F:G',30);
$worksheet->set_column('G:H',50);
$worksheet->set_column('H:I',20);
$worksheet->set_column('I:J',20);
$worksheet->set_column('J:K',20);
$worksheet->set_column('K:L',20);
$worksheet->set_column('L:M',20);
$worksheet->set_column('M:N',20);
$worksheet->set_column('N:O',20);
$worksheet->set_column('O:P',20);
$worksheet->set_column('P:Q',20);
$worksheet->set_column('Q:R',20);
$worksheet->set_column('R:S',20);

$worksheet->write('A1',"Id Etudiant",$header);
$worksheet->write('B1',LANGELE2." Etudiant",$header);
$worksheet->write('C1',LANGELE3." Etudiant",$header);
$worksheet->write('D1',"Absent le",$header);
$worksheet->write('E1',"Durant",$header);
$worksheet->write('F1',LANGVATEL265,$header);
$worksheet->write('G1',LANGABS12,$header);

$worksheet->write('H1', "Rattrapage le Date ", $header);
$worksheet->write('I1', "Rattrapage le Heure ", $header);
$worksheet->write('J1', "Rattrapage Durée ", $header);
$worksheet->write('K1', "Rattrapage Effectué ", $header);
$worksheet->write('L1', "Rattrapage le Date ", $header);
$worksheet->write('M1', "Rattrapage le Heure ", $header);
$worksheet->write('N1', "Rattrapage Durée ", $header);
$worksheet->write('O1', "Rattrapage Effectué ", $header);
$worksheet->write('P1', "Rattrapage le Date ", $header);
$worksheet->write('Q1', "Rattrapage le Heure ", $header);
$worksheet->write('R1', "Rattrapage Durée ", $header);
$worksheet->write('S1', "Rattrapage Effectué ", $header);






$pdf=new PDF();  // declaration du constructeur


include_once('../librairie_php/recupnoteperiode.php');

$listclasse=affClasse();

for($c=0;$c<count($listclasse);$c++) {
	$idClasse=$listclasse[$c][0];
	if (($_POST["saisie_classe"] != $idClasse) && ($_POST["saisie_classe"] != "tous")) { continue; }


	$eleveT=recupEleve($idClasse);      // recup liste eleve
	$classe=chercheClasse_nom($idClasse);
	$nbeleve=count($eleveT);
	
	$idsite=chercheIdSite($idClasse);	
	$dataInfo=visu_paramViaIdSite($idsite);
	$nom_etablissement=trim($dataInfo[0][0]);
	$adresse=trim($dataInfo[0][1]);
	$postal=trim($dataInfo[0][2]);
	$ville=trim($dataInfo[0][3]);
	$tel=trim($dataInfo[0][4]);
	$mail=trim($dataInfo[0][5]);
	$directeur=trim($dataInfo[0][6]);
	$urlsite=trim($dataInfo[0][7]);



	$pdf->SetTitle("Abs/Retard - $classe");
	$pdf->SetCreator("T.R.I.A.D.E.");
	$pdf->SetSubject("Abs/Retard - $classe"); 
	$pdf->SetAuthor("T.R.I.A.D.E. - www.triade-educ.com"); 

	$H=2;

	for($i=0;$i<count($eleveT);$i++) {
	
		$xcoor0="5";
		$ycoor0="5";
		$pdf->AddPage();

		$pdf->SetFont('Arial','',12);
		$pdf->SetXY($xcoor0,$ycoor0);
		$pdf->WriteHTML("$nom_etablissement");
	
		$pdf->SetXY(175,$ycoor0);
		$pdf->WriteHTML(dateDMY());

		$ycoor0+=10;
		$pdf->SetXY($xcoor0,$ycoor0);

		if ($absrtd == "tous") $tt="LISTE DES ABSENCES ET RETARDS";
		if ($absrtd == "abs") $tt="LISTE DES ABSENCES";
		if ($absrtd == "rtd") $tt="LISTE DES RETARDS";

		$pdf->WriteHTML("$tt");
		$ycoor0+=10;
		$pdf->SetXY($xcoor0,$ycoor0);
		$info=LANGASS26.". : ".$_POST["saisie_date_debut"]." au ".$_POST["saisie_date_fin"];
		$pdf->MultiCell(90,7,"$info",0,'L',0);

		$idEleve=$eleveT[$i][4];
		$nomEleve=strtoupper($eleveT[$i][0]);
		$prenomEleve=ucfirst($eleveT[$i][1]);
		$nomprenomEleve=trunchaine("$nomEleve $prenomEleve",25);

		$absNonJustifie=nombre_absNonJustifie($idEleve,$dateDebut,$dateFin);
		$absJustifie=nombre_absJustifie($idEleve,$dateDebut,$dateFin);
		$rtdNonJustifie=nombre_retardNonJustifie($idEleve,$dateDebut,$dateFin);
		$rtdJustifie=nombre_retardJustifie($idEleve,$dateDebut,$dateFin);
		$absJustifieMaladie=nombre_absJustifieMaladie($idEleve,$dateDebut,$dateFin);

		$pdf->SetXY($xcoor0+90,$ycoor0);
		$pdf->MultiCell(100,7,"Nom ".INTITULEELEVE." : $nomprenomEleve",0,'L',0);
		$ycoor0+=10;

		if (($absrtd == "tous") || ($absrtd == "abs")) {
			// Absent le  Pendant   Créneaux  Motif
			$pdf->SetFillColor(230,230,255);
			$pdf->SetXY($xcoor0,$ycoor0);
			$pdf->MultiCell(30,7,"Absent le",1,'L',1);
			$pdf->SetXY($xcoor0+=30,$ycoor0);
			$pdf->MultiCell(30,7,"Durant",1,'L',1);
			$pdf->SetXY($xcoor0+=30,$ycoor0);
			$pdf->MultiCell(30,7,LANGVATEL265,1,'L',1);
			$pdf->SetXY($xcoor0+=30,$ycoor0);
			$pdf->MultiCell(110,7,LANGABS12,1,'L',1);

			// elev_id, date_ab, date_saisie, origin_saisie, duree_ab ,date_fin, motif, duree_heure, id_matiere, time, justifier,creneaux
			$listeabs=affAbsence2_via_date($idEleve,$_POST["saisie_date_debut"],$_POST["saisie_date_fin"]);
			$ycoor0+=7;
			for($j=0;$j<count($listeabs);$j++) {
				$xcoor0="5";
	
				$dateabs=dateForm($listeabs[$j][1]);
				$pendant=$listeabs[$j][4];
				if ($pendant > 0) { $pendant.=" Jour(s)"; }
				if ($pendant == -1) { $pendant=$listeabs[$j][7]." Heure(s)"; }
				$creneaux=$listeabs[$j][11];
				list($null,$deb,$fin)=split("#",$creneaux); 
				$creneaux="$deb - $fin";
				$motif=$listeabs[$j][6];
				if (trim($creneaux) == ": - :") { $creneaux=LANGVATEL266; }
	
	
				$dataRattrapage=recupRattrappage($listeabs[$j][12]); // date,heure_depart,duree,valider
		                $infoRattrapage="";
        		        for($k=0;$k<count($dataRattrapage);$k++) {
	                	        $rattragefait=($dataRattrapage[$k][3] == 1) ? LANGOUI : LANGNON;
	                        	$infoRattrapage.="\n- Rattrapage le ".dateForm($dataRattrapage[$k][0])." à ".timeForm($dataRattrapage[$k][1])." durant ".timeForm($dataRattrapage[$k][2])." Effectuer : $rattragefait";
		                }
	
				$pdf->SetXY($xcoor0,$ycoor0);	
				$pdf->MultiCell(30,7,"$dateabs",1,'L',0);
				$pdf->SetXY($xcoor0+=30,$ycoor0);
				$pdf->MultiCell(30,7,"$pendant",1,'L',0);
				$pdf->SetXY($xcoor0+=30,$ycoor0);
				$pdf->MultiCell(30,7,"$creneaux",1,'L',0);
				$pdf->SetXY($xcoor0+=30,$ycoor0);
				$pdf->SetFont('Arial','',9);
				$pdf->MultiCell(110,7,trunchaine("$motif",80),1,'L',0);
				$pdf->SetFont('Arial','',12);
				if ($infoRattrapage != "") {
					$pdf->SetXY($xcoor0,$ycoor0+=7);
					$pdf->MultiCell(110,4*$k,'',1,'L',0);
					$pdf->SetXY($xcoor0,$ycoor0-2);
					$pdf->SetFont('Arial','',9);
						$pdf->MultiCell(110,3,"$infoRattrapage",0,'L',0);
					$ycoor0+=4*$k;
				}else{
					$ycoor0+=7;
				}
				$pdf->SetFont('Arial','',12);
		
				if ($ycoor0 >= 250) { $pdf->AddPage(); $ycoor0=10; }
	
				$H++;
					$worksheet->write("A$H","$idEleve",$center);
				$worksheet->write("B$H","$nomEleve",$center);
					$worksheet->write("C$H","$prenomEleve",$center);
				$worksheet->write("D$H","Absent le $dateabs",$center);
				$worksheet->write("E$H","$pendant",$center);
					$worksheet->write("F$H","$creneaux",$center);
				$worksheet->write("G$H","$motif",$center);
				
					$B=7;
	        	        for($k=0;$k<count($dataRattrapage);$k++) {
	                      		$date=$dataRattrapage[$k][0];
						$heure_depart=$dataRattrapage[$k][1];
					$duree=$dataRattrapage[$k][2];
					$valider=$dataRattrapage[$k][3];
	        	                	$date=dateForm($date);
	                        	$heure_depart=timeForm($heure_depart);
	                        	$duree=timeForm($duree);
	        	                	$worksheet->write($H, $B, "$date", $center);
	                        	$B++;
	        	                	$worksheet->write($H, $B, "$heure_depart", $center);
	                        	$B++;
	                        	$worksheet->write($H, $B, "$duree", $center);
		                        	$B++;
	                        	$valider = ($valider == 1) ? LANGOUI : LANGNON;
	                        	$worksheet->write($H, $B, "$valider", $center);
		                        	$B++;
	              		}
			}
		}

		if (($absrtd == "tous") || ($absrtd == "rtd")) {

		// Absent le  Pendant   Créneaux  Motif
		$ycoor0+=20;
		$xcoor0=5;
		$pdf->SetFillColor(230,230,255);
		$pdf->SetXY($xcoor0,$ycoor0);
		$pdf->MultiCell(30,7,"Retard le",1,'L',1);
		$pdf->SetXY($xcoor0+=30,$ycoor0);
		$pdf->MultiCell(30,7,"Durant",1,'L',1);
		$pdf->SetXY($xcoor0+=30,$ycoor0);
		$pdf->MultiCell(30,7,LANGVATEL265,1,'L',1);
		$pdf->SetXY($xcoor0+=30,$ycoor0);
		$pdf->MultiCell(110,7,LANGABS12,1,'L',1);

		$listeabs=affRetard_via_date($idEleve,$_POST["saisie_date_debut"],$_POST["saisie_date_fin"]); 
		//elev_id, heure_ret, date_ret, date_saisie, origin_saisie, duree_ret, motif, idmatiere,justifier,heure_saisie,creneaux, idrattrapage
		$ycoor0+=7;
		for($j=0;$j<count($listeabs);$j++) {
			$xcoor0="5";

			$dateabs=dateForm($listeabs[$j][2]);
			$pendant=$listeabs[$j][5];
			$creneaux=$listeabs[$j][10];
			list($null,$deb,$fin)=split("#",$creneaux); 
			$creneaux="$deb - $fin";
			$motif=$listeabs[$j][6];
			if (trim($creneaux) == ": - :") { $creneaux=LANGVATEL266; }


			$dataRattrapage=recupRattrappage($listeabs[$j][11]); // date,heure_depart,duree,valider
	                $infoRattrapage="";
        	        for($k=0;$k<count($dataRattrapage);$k++) {
                	        $rattragefait=($dataRattrapage[$k][3] == 1) ? LANGOUI : LANGNON;
                        	$infoRattrapage.="\n- Rattrapage le ".dateForm($dataRattrapage[$k][0])." à ".timeForm($dataRattrapage[$k][1])." durant ".timeForm($dataRattrapage[$k][2])." Effectuer : $rattragefait";
	                }

			$pdf->SetXY($xcoor0,$ycoor0);	
			$pdf->MultiCell(30,7,"$dateabs",1,'L',0);
			$pdf->SetXY($xcoor0+=30,$ycoor0);
			$pdf->MultiCell(30,7,"$pendant",1,'L',0);
			$pdf->SetXY($xcoor0+=30,$ycoor0);
			$pdf->MultiCell(30,7,"$creneaux",1,'L',0);
			$pdf->SetXY($xcoor0+=30,$ycoor0);
			$pdf->SetFont('Arial','',9);
			$pdf->MultiCell(110,7,trunchaine("$motif",70),1,'L',0);
			$pdf->SetFont('Arial','',12);
                     	if ($infoRattrapage != "") {
                                $pdf->SetXY($xcoor0,$ycoor0+=7);
                                $pdf->MultiCell(110,4*$k,'',1,'L',0);
                                $pdf->SetXY($xcoor0,$ycoor0-2);
                                $pdf->SetFont('Arial','',9);
                                $pdf->MultiCell(110,3,"$infoRattrapage",0,'L',0);
                                $ycoor0+=4*$k;
                        }else{
                                $ycoor0+=7;
                        }
                        $pdf->SetFont('Arial','',12);

			if ($ycoor0 >= 250) { $pdf->AddPage(); $ycoor0=10; }

			$H++;
			$worksheet->write("A$H","$idEleve",$center);
			$worksheet->write("B$H","$nomEleve",$center);
			$worksheet->write("C$H","$prenomEleve",$center);
			$worksheet->write("D$H","Retard le $dateabs",$center);
			$worksheet->write("E$H","$pendant",$center);
			$worksheet->write("F$H","$creneaux",$center);
			$worksheet->write("G$H","$motif",$center);
			$B=7;
        	        for($k=0;$k<count($dataRattrapage);$k++) {
                      		$date=$dataRattrapage[$k][0];
				$heure_depart=$dataRattrapage[$k][1];
				$duree=$dataRattrapage[$k][2];
				$valider=$dataRattrapage[$k][3];
                        	$date=dateForm($date);
                        	$heure_depart=timeForm($heure_depart);
                        	$duree=timeForm($duree);
                        	$worksheet->write($H, $B, "$date", $center);
                        	$B++;
                        	$worksheet->write($H, $B, "$heure_depart", $center);
                        	$B++;
                        	$worksheet->write($H, $B, "$duree", $center);
                        	$B++;
                        	$valider = ($valider == 1) ? LANGOUI : LANGNON;
                        	$worksheet->write($H, $B, "$valider", $center);
                        	$B++;
                	}
		    }
		}
	}
}


$workbook->close();




if ($_POST["saisie_classe"] == "-10") { $classe="Toutes_Les_classes"; }
$classe=TextNoAccent($classe);
$classe=TextNoCarac($classe);
$classe_nom=ereg_replace("/","_",$classe);
$fichier=urlencode($fichier);
if (!is_dir("../data/pdf_abs/")) { mkdir("../data/pdf_abs/"); }
$fichier="../data/pdf_abs/${classe}_abscomplet2_".$dateDebut."_".$dateFin.".pdf";
@unlink($fichier); // destruction avant creation
$pdf->output($fichier);
$pdf->close();

$url="visu_pdf_admin.php";

?>

<input class='btn btn-primary btn-sm  vat-btn-footer' type='button' onclick="open('<?php print $url?>?id=<?php print $fichier?>','_blank','');" value="<?php print LANGVATEL231  ?>"  >&nbsp;&nbsp;
<input class='btn btn-primary btn-sm  vat-btn-footer' type='button' onclick="open('visu_document.php?fichier=<?php print $fichierxls?>','_blank','');" value="<?php print LANGMESS225 ?>"  >


		</section>
		</div>
		</div>
	</div>
<?php 
} 
Pgclose();
include_once("piedpage.php");
include_once("connexionEnCours.php");
?>
</body>
</html>
