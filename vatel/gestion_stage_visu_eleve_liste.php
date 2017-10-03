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
<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL217 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param13.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

<table width=100% border=1 bordercolor="#000000" >
<tr bgcolor="black" > 
<td  >&nbsp;<font class='T22'><?php print LANGELE2." ".LANGELE3 ?></font></td>
<td  >&nbsp;<font class='T22'><?php print LANGELE3 ?></font></td>
<td  >&nbsp;<font class='T22'><?php print LANGSTAGE74 ?></font></td>
</tr>
<!-- // debut  -->
<?php
$fichier="gestion_stage_visu_eleve_liste.php?tous=".$_GET['tous'];
$table="stage_eleve";
$champs="";
$iddest="$destinataire";
$nbaff=20;
if (isset($_GET["nba"])) {
	$depart=$_GET["limit"];
}else {
	$depart=0;
}



$data=liste_eleve_entreprise();
for($i=0;$i<count($data);$i++) {
	if (trim(recherche_eleve($data[$i][1])) == "") {
		deleteListeEleveEntr($data[$i][0]);
	}
}


// creation PDF
if (!is_dir("../data/pdf_bull/listingstage")) { mkdir("../data/pdf_bull/listingstage"); }
$fichier="../data/pdf_bull/listingstage/listingEntrepriseStage.pdf";

define('FPDF_FONTPATH','../librairie_pdf/fpdf/font/');
include_once('../librairie_pdf/fpdf/fpdf.php');
include_once('../librairie_pdf/html2pdf.php');
$pdf=new PDF();  // declaration du constructeur
$pdf->AddPage();
$pdf->SetTitle("Listing Etudiant en entreprise");
$pdf->SetCreator("T.R.I.A.D.E.");
$pdf->SetSubject("Compte Rendu de Stage"); 
$pdf->SetAuthor("T.R.I.A.D.E. - www.triade-educ.com"); 
$X=0;
$Y=0;

$date=anneeScolaire();


$pdf->SetFont('Arial','B',14);
$pdf->SetXY($X,$Y+=10);
$pdf->MultiCell(210,10,LANGAGENDA104." $date",0,'C',0);
$pdf->SetFont('Arial','B',12);
$pdf->SetXY($X,$Y+=10);
$pdf->MultiCell(210,10,"LISTE DES ETUDIANTS EN ENTREPRISE",0,'C',0);
$X=5;
$pdf->SetFillColor(240);
$pdf->SetFont('Arial','',12);
$pdf->SetXY($X,$Y+=20);
$pdf->MultiCell(30,10,"Etudiant",1,'C',1);
$pdf->SetXY($X+=30,$Y);
$pdf->MultiCell(30,10,"Classe",1,'C',1);
$pdf->SetXY($X+=30,$Y);
$pdf->MultiCell(70,10,"Entreprise",1,'C',1);
$pdf->SetXY($X+=70,$Y);
$pdf->MultiCell(70,10,"Lieu",1,'C',1);

$pdf->SetFillColor(255);
$pdf->SetFont('Arial','',9);
$data=liste_eleve_entreprise_limit($depart,$nbaff);
// id  id_eleve  id_entreprise  id_prof_visite  lieu_stage  visite_effectuer  ville_stage  code_p  tuteur_stage  jour_repos  info_plus  loger  nourri  passage_x_service  raison  date_visite_prof  num_stage  ,alternance ,jour_alternance ,dateDebutAlternance ,dateFinAlternance
for($i=0;$i<count($data);$i++) {
	$idclasse=chercheIdClasseDunEleve($data[$i][1]);
	$info=recherchedatestage3($data[$i][16],$idclasse);
	// idclasse,datedebut,datefin,numstage,id,nom_stage
	$datedebut=preg_replace('/-/','',$info[0][1]);
	$datefin=preg_replace('/-/','',$info[0][2]);
	$dateDebutAlternance=preg_replace('/-/','',$data[$i][19]);
	$dateFinAlternance=preg_replace('/-/','',$data[$i][20]);
	$datedujour=dateDMY2();
	$datedujour=preg_replace('/-/','',$datedujour);
	if ($datefin == "") $datefin="0";
	if ($datedebut == "") $datedebut="0";
	if ($_GET['tous'] != 1) { 
		    // print "( (($datefin >= $datedujour) && (".$data[$i][17]." == 0) &&  ($datedebut <= $datedujour)) || <br><br>  (($dateFinAlternance >= $datedujour) && (".$data[$i][17]." == 1) &&  ($dateDebutAlternance <= $datedujour)) )<hr>";
		if ( (($datefin < $datedujour) && ($data[$i][17] == 0)) || 
		     (($data[$i][17] == 0) &&  ($datedebut > $datedujour)) || 
		     (($dateFinAlternance <= $datedujour) && ($data[$i][17] == 1) &&  ($dateDebutAlternance >= $datedujour)) )  { 
		     continue; 
	        }
	}

	if ($Y >= 270) { $pdf->AddPage(); $Y=20; }

	$nomprenom=recherche_eleve($data[$i][1]);
	$nomclass=chercheClasse_nom(chercheIdClasseDunEleve($data[$i][1]));
	$nomentreprise=recherche_entr_nom_via_id($data[$i][2]);
	$lieu=$data[$i][4]." ".$data[$i][7]." ".$data[$i][6];
		
	$X=5;
	$pdf->SetXY($X,$Y+=10);
	$pdf->MultiCell(30,10,"",1,'L',0);
	$pdf->SetXY($X+1,$Y+1);
	$pdf->MultiCell(30,3,"$nomprenom",0,'L',0);

	$pdf->SetXY($X+=30,$Y);
	$pdf->MultiCell(30,10,"",1,'L',0);
	$pdf->SetXY($X+1,$Y+1);
	$pdf->MultiCell(30,3,"$nomclass",0,'L',0);


	$pdf->SetXY($X+=30,$Y);
	$pdf->MultiCell(70,10,"",1,'L',0);
	$pdf->SetXY($X+1,$Y+1);
	$pdf->MultiCell(70,3,"$nomentreprise",0,'L',0);

	$pdf->SetXY($X+=70,$Y);
	$pdf->MultiCell(70,10,"",1,'L',0);
	$pdf->SetXY($X+1,$Y+1);
	$pdf->MultiCell(70,3,"$lieu",0,'L',0);

	$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
	print "<tr bgcolor='$bgcolor' >\n";
?>
	<td  >&nbsp;<?php print $nomprenom ?></td>
	<td  >&nbsp;<?php print $nomclass ?></td>
	<td  >&nbsp;<?php print $nomentreprise ?></td>
	</tr>

<?php	
}

@unlink($fichier); // destruction avant creation
$pdf->output($fichier);

?>
</table>
<table width=100% border=0 >
<tr><td align=left width=33%><br>&nbsp;<?php precedent2VATEL($fichier,$table,$depart,$nbaff); ?><br><br></td>
<td width=33%>
</td><td><input type="button" value="<?php print LANGVATEL241 ?>" class='btn btn-primary btn-sm  vat-btn-footer'  onclick="open('visu_document.php?fichier=<?php print $fichier?>','_blank','');" /></td>
<td align=right width=33%><br><?php suivant2VATEL($fichier,$table,$depart,$nbaff); ?>&nbsp;<br><br></td>
</tr></table>

		
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