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


$visu=0;
if ($_SESSION["membre"] == "menupersonnel") {
	if(verifDroit($_SESSION["id_pers"],"consultationRead")){ 
		$visu=1;
	}
}else{
	validerequete("2");
	$visu=1;
}


?>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL138 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param10.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

		<?php if ($visu == 1) { ?>

		<form method='post'>
		<font class="T2"><?php print LANGBULL3 ?> :</font>
        <select name='anneeScolaire' onChange="this.form.submit()" >
        <?php
        filtreAnneeScolaireSelectNote($anneeScolaire,8);
	    ?>
        </select>
	    <input type='hidden' name='saisie_classe' value="<?php print $_POST["saisie_classe"]?>" />
		</form>
	
		<form method=post onsubmit="return valide_consul_classe()" name="formulaire">
	       <font class=T2><?php print LANGPROFG?> :</font> <select id="saisie_classe" name="saisie_classe" onchange="this.form.submit()" >
<?php
if ($_POST["saisie_classe"] > "0") {
	print "<option id='select1' value='".$_POST["saisie_classe"]."' >".chercheClasse_nom($_POST["saisie_classe"])."</option>";
}
print "<option id='select0' >".LANGCHOIX."</option>";
select_classe(); // creation des options
?>
</select> <BR>
<UL>
<?php
if ($_POST["saisie_classe"] > 0) {
	$saisie_classe=$_POST["saisie_classe"];

	$sql=" SELECT s.* FROM ( SELECT libelle,elev_id,nom,prenom,date_naissance,regime,numero_eleve,code_compta,nomtuteur,prenomtuteur,civ_1,telephone,email FROM ${prefixe}eleves ,${prefixe}classes  WHERE classe='$saisie_classe' AND code_class='$saisie_classe' AND annee_scolaire='$anneeScolaire' UNION ALL SELECT c.libelle,e.elev_id,e.nom,e.prenom,e.date_naissance,e.regime,e.numero_eleve,e.code_compta,e.nomtuteur,e.prenomtuteur,e.civ_1,e.telephone,e.email FROM ${prefixe}eleves e ,${prefixe}classes c, ${prefixe}eleves_histo h WHERE h.idclasse='$saisie_classe' AND e.elev_id=h.ideleve AND h.idclasse=c.code_class AND h.annee_scolaire='$anneeScolaire') s  ORDER BY s.nom";

	//$sql="(SELECT libelle,elev_id,nom,prenom,date_naissance,regime,numero_eleve,code_compta,nomtuteur,prenomtuteur,civ_1,telephone,email FROM ${prefixe}eleves ,${prefixe}classes  WHERE classe='$saisie_classe' AND code_class='$saisie_classe' AND annee_scolaire='$anneeScolaire') UNION (SELECT c.libelle,e.elev_id,e.nom,e.prenom,e.date_naissance,e.regime,e.numero_eleve,e.code_compta,e.nomtuteur,e.prenomtuteur,e.civ_1,e.telephone,e.email FROM ${prefixe}eleves e ,${prefixe}classes c, ${prefixe}eleves_histo h WHERE h.idclasse='$saisie_classe' AND e.elev_id=h.ideleve AND h.idclasse=c.code_class AND h.annee_scolaire='$anneeScolaire'  ORDER BY e.nom)";
	$res=execSql($sql);
	$data=chargeMat($res);
	// ne fonctionne que si au moins 1 élève dans la classe
	// nom classe
	$cl=$data[0][0];
	print "<br><br>";
	if( count($data) > 0 ) {
		$fic=$_POST["saisie_classe"];
		$fichierpdf="../data/pdf_certif/Classe_".suppCaracFichier($cl).".pdf";
		$fichierpdf2="../data/pdf_certif/Classe2_".suppCaracFichier($cl).".pdf";
		if (($_SESSION["membre"] == "menuadmin") || ($_SESSION["membre"] == "menuscolaire")) {
			print "<script language=JavaScript>buttonMagicVATEL('".LANGMESS243." (1)','visu_pdf_admin.php?id=$fichierpdf','_blank','','');</script>";
			print "&nbsp;<script language=JavaScript>buttonMagicVATEL('".LANGMESS243." (2)','visu_pdf_admin.php?id=$fichierpdf2','_blank','','');</script>";
		}
		if ($_SESSION["membre"] == "menupersonnel") {
			print "<script language=JavaScript>buttonMagicVATEL('".LANGMESS243." (1)','visu_pdf_personnel.php?id=$fichierpdf','_blank','','');</script>";
			print "&nbsp;<script language=JavaScript>buttonMagicVATEL('".LANGMESS243." (2)','visu_pdf_personnel.php?id=$fichierpdf2','_blank','','');</script>";
		}		
		print "&nbsp;<script language=JavaScript>buttonMagicVATEL('".LANGMESS243." (3)','listingElevePdf.php?idClasse=$fic','_blank','','');</script>&nbsp;&nbsp;";

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

			if ($ii2 == 10) {
	                	$pdf2->AddPage();
				$ii2=0;
				$xcoor20=10;
				$ycoor20=20;
			}

			$ii++;
			$ii2++;

			$j++;

			$eleve=$j.") ".strtoupper($data[$i][2])." ".trunchaine(ucwords($data[$i][3]),50);

			$datenaissance=" né(e) le ".dateForm($data[$i][4]);
			$regime="Régime :".$data[$i][5];
			$ine="Code INE : ".$data[$i][6];
			$compta="Code Comptabilité : ".$data[$i][7];

			$nomtuteur=strtoupper($data[$i][8]);
			$prenomtuteur=ucwords($data[$i][9]);
			$nom_resp_2=strtoupper($data[$i][13]);
			$prenom_resp_2=ucwords($data[$i][14]);

			if ($data[$i][15] != "") $civ_2=civ($data[$i][15]);
			if ($data[$i][10] != "") $civ_1=civ($data[$i][10]);
			$telephone=preg_replace('/ /','.',$data[$i][11]);
			$email=$data[$i][12];
			$nomprenomresp=LANGSTAGE77." : $civ_1 $nomtuteur $prenomtuteur - $civ_2 $nom_resp_2 $prenom_resp_2";
			$telresp=LANGDISC17." : $telephone";
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
			$pdf2->Image($photo,$xcoor20,$ycoor20,$h,$l);
			$pdf2->SetXY($xcoor20+19,$ycoor20-=1);
			$pdf2->WriteHTML($eleve2);
			$pdf2->SetXY($xcoor20+19,$ycoor20+4);
			$pdf2->WriteHTML("$regime / $ine / $compta");
			$pdf2->SetXY($xcoor20+19,$ycoor20+8);
			$pdf2->WriteHTML("$nomprenomresp ");
			$pdf2->SetXY($xcoor20+19,$ycoor20+12);
			$pdf2->WriteHTML("$telresp / $emailresp");
			$pdf2->SetFont('Courier','',12);

			$ycoor0+=5;
			$ycoor20+=25;



		}
		if (file_exists($fichierpdf))  {  @unlink($fichierpdf); }
		$pdf->output($fichierpdf);
		if (file_exists($fichierpdf2))  {  @unlink($fichierpdf2); }
		$pdf2->output($fichierpdf2);
		
	}
}
?>
<?php
// affichage de la classe
if($_POST["saisie_classe"] > 0) { ?>
	<BR><BR><BR>
	<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" >
	<tr id='coulBar0' ><td height="2" colspan="3"><b><font   id='menumodule1' >
	<?php print LANGELE4?> : <font id="color2"><b><?php print $cl?></b></font>&nbsp;&nbsp; <?php print LANGCOM3 ?><font id="color2"><b><?php print count($data) ?></b> </font>/ <?php print LANGBULL3 ?> : <b><font id="color2"><?php print $anneeScolaire ?></font></b></font></font></td>
	</tr>
<?php 
	if( count($data) <= 0 ) {
		print("<tr><td align=center valign=center id='cadreCentral0'><font class=T2>".LANGRECH1."</font></td></tr>");
	} else { ?>
		<tr bgcolor='black' ><td><font color='#FFFFFF'><B><?php print ucwords(LANGIMP8)?></B></font></td><td><font color='#FFFFFF'><B><?php print ucwords(LANGIMP9)?></B></font></td></tr>
<?php
	for($i=0;$i<count($data);$i++) {
		$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
		print "<tr bgcolor='$bgcolor' >\n";
	?>
	<td><?php if (getInactifEleve($data[$i][1])) { print "<img src='../image/commun/img_ssl_mini.png' title='Inactif' />&nbsp;"; } ?>
	    <?php print strtoupper($data[$i][2]); ?></td>
	<td><?php print trunchaine(ucwords($data[$i][3]),30)?></td>
	</tr>
	<?php
	}
      }
print "</table>";
}else{ ?>
	<?php

	?>
	<BR><BR>
	<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" >
	<tr id='coulBar0' ><td height="2" colspan="3"><b><font   id='menumodule1' ><?php print LANGVATEL150 ?> <span id='nbeleve'></span> <?php print LANGBULL3 ?> : <b><?php print $anneeScolaire ?></b></font></td></tr>
	<tr id='cadreCentral0' >
	<td valign='top'>
	
<table border=1 bordercolor=#000000" align=center width='100%' style="border-collapse: collapse;" >
<TR bgcolor="black" >
<td  align=center><font color='#FFFFFF'><b><?php print ucwords(LANGPER25)?></b></font></td>
<td  align=center width=10><font color='#FFFFFF'><b><?php print "&nbsp;".LANGPER16."&nbsp;".ucwords(LANGBULL31)."&nbsp;"; ?></b></font></td>

<td align=center width=10 title="<?php print LANGHOM ?>" ><font color='#FFFFFF'><b><?php print LANGSEXEH ?></b></font></td>
<td align=center width=10 title="<?php print LANGFEM ?>" ><font color='#FFFFFF'><b><?php print LANGSEXEF ?></b></font></td>

<td align=center width=10><font color='#FFFFFF'><b><?php print LANGMESS366 ?></b></font></td>
<td align=center width=10><font color='#FFFFFF'><b><?php print LANGMESS365 ?></b></font></td>
<td align=center width=10><font color='#FFFFFF'><b><?php print LANGMESS367 ?></b></font></td>
<td align=center width=10><font color='#FFFFFF'><b><?php print LANGMESS368 ?></b></font></td>
<td align=center width=10><font color='#FFFFFF'><b><?php print LANGTMESS433 ?></b></font></td>

</TR>

<?php

define('FPDF_FONTPATH','../librairie_pdf/fpdf/font/');
include_once('../librairie_pdf/fpdf/fpdf.php');
include_once('../librairie_pdf/html2pdf.php');
$pdf=new PDF();  // declaration du constructeur

$pdf->AddPage();
$pdf->SetTitle("Emargement -");
$pdf->SetCreator("T.R.I.A.D.E.");
$pdf->SetSubject("Emargement "); 
$pdf->SetAuthor("T.R.I.A.D.E. - www.triade-educ.com"); 

$_COOKIE["anneeScolaire"]=$anneeScolaire;


$data=affClasseSansOffline();
for($i=0;$i<count($data);$i++) {
	$nbeleve=nbEleve($data[$i][0]);
	$nbelevetotal+=$nbeleve;
	$nbinterne=nbEleveInterne($data[$i][0]);
	$nbinternetotal+=$nbinterne;
	$nbligne=$nbinterne;
	$nbdemipension=nbEleveDemiPension($data[$i][0]);
	$nbdemipensiontotal+=$nbdemipension;
	$nbligne+=$nbdemipension;
	$nbexterne=nbEleveExterne($data[$i][0]);
	$nbexternetotal+=$nbexterne;
	$nbligne+=$nbexterne;
	$nbinconnu=nbEleveRegimeInconnu($data[$i][0]);
	$nbinconnutotal+=$nbinconnu;
	$nbligne+=$nbinconnu;
	$nbeleveTotal+=$nbeleve;
	$nblignetotal+=$nbligne;

	$nbeleveH=nbEleveSexeHomme($data[$i][0]);
	$nbeleveF=nbEleveSexeFemme($data[$i][0]);
	$nbeleveHTotal+=$nbeleveH;
	$nbeleveFTotal+=$nbeleveF;

$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
		print "<tr bgcolor='$bgcolor' >\n";
?>
<td><?php $classe=chercheClasse($data[$i][0]);print ucwords($classe[0][1]);?></td>
<td><?php print $nbeleve ?></td>

<td><?php print $nbeleveH ?></td>
<td><?php print $nbeleveF ?></td>

<td><?php print $nbinterne ?></td>
<td><?php print $nbdemipension ?></td>
<td><?php print $nbexterne ?></td>
<td><?php print $nbinconnu ?></td>
<td><?php print $nbligne ?></td>

</tr>
<?php } ?>
<tr>
<td align='right'><b><?php print LANGTMESS433 ?> :</b> </td>
<td><b><?php print $nbelevetotal ?></b></td>

<td><b><?php print $nbeleveHTotal ?></b></td>
<td><b><?php print $nbeleveFTotal ?></b></td>


<td><b><?php print $nbinternetotal ?></b></td>
<td><b><?php print $nbdemipensiontotal ?></b></td>
<td><b><?php print $nbexternetotal ?></b></td>
<td><b><?php print $nbinconnutotal ?></b></td>
<td><b><?php print $nblignetotal ?></b></td>
</tr>
</table>

</td></tr></table>
<script>document.getElementById('nbeleve').innerHTML=" <font id='color2'><?php print $nbeleveTotal ?></font><font  id='menumodule1' > ".LANGVATEL152.".</font>"; </script>
<?php

$X=0;
$Y=5;
$pdf->SetXY($X,$Y);
$pdf->SetFont('Arial','B',12);
$th=LANGVATEL150;
$th1=LANGVATEL151;
$pdf->MultiCell(210,6,"$th. $nbeleveTotal $th1 $anneeScolaire ",0,'C',0);
$pdf->SetFont('Arial','',9);

$pdf->SetFillColor(255,255,0);
$pdf->SetXY($X+=5,$Y+=10);
$pdf->MultiCell(35,10,ucwords(LANGPER25),1,'C',1);
$pdf->SetXY($X+=35,$Y);
$text=LANGPER16." ".ucwords(LANGBULL31);
$pdf->MultiCell(20,10," $text ",1,'C',1);
$pdf->SetXY($X+=20,$Y);
$pdf->MultiCell(20,10,LANGHOM,1,'C',1);
$pdf->SetXY($X+=20,$Y);
$pdf->MultiCell(20,10,LANGFEM,1,'C',1);
$pdf->SetXY($X+=20,$Y);
$pdf->MultiCell(20,10,"Interne",1,'C',1);
$pdf->SetXY($X+=20,$Y);
$pdf->MultiCell(20,10,"Demi Pension",1,'C',1);
$pdf->SetXY($X+=20,$Y);
$pdf->MultiCell(20,10,"Externe",1,'C',1);
$pdf->SetXY($X+=20,$Y);
$pdf->MultiCell(20,10,"Inconnu",1,'C',1);
$pdf->SetXY($X+=20,$Y);
$pdf->MultiCell(20,10,"Total",1,'C',1);
$pdf->SetFillColor(255);

$data=affClasseSansOffline();

$nbelevetotal="0";
$nbinternetotal="0";
$nbligne=$nbinterne="0";
$nbdemipensiontotal="0";
$nbdemipension=0;
$nbexternetotal=$nbexterne=0;
$nbinconnutotal=$nbinconnu=0;
$nbeleveTotal="0";
$nblignetotal="0";

for($i=0;$i<count($data);$i++) {
	$nbeleve=nbEleve($data[$i][0]);
	$nbelevetotal+=$nbeleve;
	$nbinterne=nbEleveInterne($data[$i][0]);
	$nbinternetotal+=$nbinterne;
	$nbligne=$nbinterne;
	$nbdemipension=nbEleveDemiPension($data[$i][0]);
	$nbdemipensiontotal+=$nbdemipension;
	$nbligne+=$nbdemipension;
	$nbexterne=nbEleveExterne($data[$i][0]);
	$nbexternetotal+=$nbexterne;
	$nbligne+=$nbexterne;
	$nbinconnu=nbEleveRegimeInconnu($data[$i][0]);
	$nbinconnutotal+=$nbinconnu;
	$nbligne+=$nbinconnu;
	$nbeleveTotal+=$nbeleve;
	$nblignetotal+=$nbligne;
	
	$nbeleveH=nbEleveSexeHomme($data[$i][0]);
	$nbeleveF=nbEleveSexeFemme($data[$i][0]);
	$nbeleveHTotal+=$nbeleveH;
	$nbeleveFTotal+=$nbeleveF;

	$classe=chercheClasse($data[$i][0]);

	$pdf->SetXY($X=5,$Y+=10);
	$pdf->MultiCell(35,10, ucwords($classe[0][1]),1,'L',1);
	$pdf->SetXY($X+=35,$Y);
	$pdf->MultiCell(20,10," $nbeleve ",1,'C',1);
	$pdf->SetXY($X+=20,$Y);
	$pdf->MultiCell(20,10," $nbeleveH ",1,'C',1);
	$pdf->SetXY($X+=20,$Y);
	$pdf->MultiCell(20,10," $nbeleveF ",1,'C',1);
	$pdf->SetXY($X+=20,$Y);
	$pdf->MultiCell(20,10," $nbinterne ",1,'C',1);
	$pdf->SetXY($X+=20,$Y);
	$pdf->MultiCell(20,10," $nbdemipension ",1,'C',1);
	$pdf->SetXY($X+=20,$Y);
	$pdf->MultiCell(20,10," $nbexterne ",1,'C',1);
	$pdf->SetXY($X+=20,$Y);
	$pdf->MultiCell(20,10," $nbinconnu ",1,'C',1);
	$pdf->SetXY($X+=20,$Y);
	$pdf->MultiCell(20,10," $nbligne ",1,'C',1);


	if ($Y >= 250) {
		$Y=10;
		$pdf->AddPage();
	}

}

$pdf->SetFillColor(192,192,192);
$pdf->SetFont('Arial','B',9);
$pdf->SetXY($X=5,$Y+=10);
$pdf->MultiCell(35,10," Total",1,'R',1);
$pdf->SetXY($X+=35,$Y);
$pdf->MultiCell(20,10," $nbelevetotal ",1,'C',1);
$pdf->SetXY($X+=20,$Y);
$pdf->MultiCell(20,10," $nbeleveHTotal ",1,'C',1);
$pdf->SetXY($X+=20,$Y);
$pdf->MultiCell(20,10," $nbeleveFTotal ",1,'C',1);
$pdf->SetXY($X+=20,$Y);
$pdf->MultiCell(20,10," $nbinternetotal ",1,'C',1);
$pdf->SetXY($X+=20,$Y);
$pdf->MultiCell(20,10," $nbdemipensiontotal ",1,'C',1);
$pdf->SetXY($X+=20,$Y);
$pdf->MultiCell(20,10," $nbexternetotal ",1,'C',1);
$pdf->SetXY($X+=20,$Y);
$pdf->MultiCell(20,10," $nbinconnutotal ",1,'C',1);
$pdf->SetXY($X+=20,$Y);
$pdf->MultiCell(20,10," $nblignetotal ",1,'C',1);


$fichier="../data/pdf_certif/tableau_de_bord_des_classes.pdf";
@unlink($fichier); // destruction avant creation
$pdf->output($fichier);
$pdf->close();
?>

<center>
<?php 
$url="visu_pdf_scolaire.php";
if ($_SESSION["membre"] == "menuprof") { $url="visu_pdf_prof.php"; }	
?>
<br><br><input type=button onclick="open('<?php print $url?>?id=<?php print $fichier?>','_blank','');" value="<?php print LANGaffec_cre41 ?>"  class='btn btn-primary btn-sm  vat-btn-footer' >
</center>

<?php
}
?>

			
<?php } ?>			
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