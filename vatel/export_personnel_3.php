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

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL167 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param11.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
<br />
<form method="post" action="export_eleve_3.php" >
<font class="T2">
<?php
$nosauvegarde=1;
if (isset($_GET["libelle"])) {
	$cnx=cnx();
	$ok=1;
	$libelle="##struct##".$_GET["libelle"];
	$data=aff_enr_parametrage($libelle);
	$colonne=unserialize($data[0][1]);
}


if (isset($_POST['create'])) {
	$nosauvegarde=0;
	$ok=1;
	$cnx=cnx();
	$nbcolname=$_POST['nbcolname'];
	$tablist=explode('%##%',$_POST['liste']);

	$i=0;
	foreach($_POST['ordre'] as $key=>$value) {
		if (is_numeric($tablist[$i])) {
			$o=$tablist[$i];
			$colonne[$value]=stripslashes($nbcolname[$o]);
		}else{
			$colonne[$value]=$tablist[$i];
		}
		$i++;
	}

	for($i=1;$i<=count($colonne);$i++) {
		$ordre=$colonne[$i].";";
	}
	$ordre=ereg_replace(":$","",$ordre);
}



if ($ok == 1) {

	require_once "../librairie_php/class.writeexcel_workbook.inc.php";
	require_once "../librairie_php/class.writeexcel_worksheet.inc.php";

	$fichier="../data/fichier_ASCII/export_".$_SESSION["id_pers"].".xls";
	@unlink($fichier);
//	$fname = tempnam("/tmp", "$fichier");
	
	$workbook = &new writeexcel_workbook($fichier);

	$worksheet1 =& $workbook->addworksheet('Listing');
//	$worksheet1->freeze_panes(1, 0); # 0 row
	
	$header =& $workbook->addformat();
	$header->set_color('white');
	$header->set_align('center');
	$header->set_align('vcenter');
	$header->set_pattern();
	$header->set_fg_color('blue');

	$center =& $workbook->addformat();
	$center->set_align('left');

	#
	# Sheet 1
	#

//	$worksheet1->set_column('A:I', 16);
//	$worksheet1->set_row(0, 20);
	$worksheet1->set_selection('A0');

	$j=0;
	for($i=1;$i<=count($colonne);$i++) {
		$titre=$colonne[$i];
		$worksheet1->write(0, $j, "$titre", $header);
		$j++;
	}

	$saisie_type=$_POST["saisie_type"];
	$datalisting=listingPersonnel($saisie_type); 
	/* 
	 * pers_id 		0
	 * nom   		1
	 * prenom  		2
	 * prenom2  		3
	 * mdp  		4
	 * type_pers  		5
	 * civ  		6
	 * photo  		7
	 * email  		8
	 * valid_forward_mail  	9
	 * adr  		10
	 * code_post  		11
	 * commune  		12
	 * tel  		13
	 * tel_port  		14
	 * identifiant  	15
	 * lieudenseigement  	16
	 * offline  		17
	 * id_societe_tuteur  	18
	 * pays  		19
	 * indice_salaire  	20
	 * qualite  		21
	 */
	for ($i=1;$i<count($datalisting);$i++) {
		$a=1;
		for ($j=0;$j<count($colonne);$j++) {
			$donnee="";
			if ($colonne[$a] == "nom") { 		$choix=1;     	$donnee=strtolower($datalisting[$i][$choix]); }
			if ($colonne[$a] == "prenom") { 	$choix=2;  	$donnee=strtolower($datalisting[$i][$choix]); }
			if ($colonne[$a] == "civ_1") { 		$choix=6;  	$donnee=civ($datalisting[$i][$choix]); }
			if ($colonne[$a] == "adr1") { 		$choix=10;  	$donnee=strtolower($datalisting[$i][$choix]); }
			if ($colonne[$a] == "code_post_adr1") { $choix=11;  	$donnee=strtolower($datalisting[$i][$choix]); }
			if ($colonne[$a] == "commune_adr1") { 	$choix=12;  	$donnee=strtolower($datalisting[$i][$choix]); }
			if ($colonne[$a] == "tel_port_1") { 	$choix=14;  	$donnee=strtolower($datalisting[$i][$choix]); }
			if ($colonne[$a] == "telephone") { 	$choix=23;  	$donnee=strtolower($datalisting[$i][$choix]); }
			if ($colonne[$a] == "email") { 		$choix=8;  	$donnee=strtolower($datalisting[$i][$choix]); }
			if ($colonne[$a] == "identifiant") { 	$choix=15;  	$donnee=strtolower($datalisting[$i][$choix]); }
			if ($colonne[$a] == "indice_salaire") { $choix=20;  	$donnee=strtolower($datalisting[$i][$choix]); }
			if ($colonne[$a] == "code_barre") { 	
				$choix=0;  	
				$membre=renvoiTypePersonneMembre($datalisting[$i][5]);
				$donnee=recupIdCodeBar($datalisting[$i][$choix],"$membre"); 
			}
			
			$worksheet1->write($i, $j, "$donnee", $center);
			$a++;
	    	}
	}

	$workbook->close();

//	header("Content-Type: application/x-msexcel; name=\"example-panes.xls\"");
//	header("Content-Disposition: inline; filename=\"example-panes.xls\"");
//	$fh=fopen($fichier, "rb");
//	fpassthru($fh);
//	fclose($fh);
//	unlink($fname);

}
?>
</font>
</form>
<center>
<input type='button' onclick="open('visu_document.php?fichier=<?php print $fichier?>','_blank','');" value="<?php print LANGVATEL203 ?>"  class='btn btn-primary btn-sm  vat-btn-footer' >
<br /></center>
<br><br>
<?php 
if ($nosauvegarde == 0) { ?>
<hr>
<center>
<font class=T1><?php print LANGVATEL201 ?></font>
<form method=post action="export.php" name="formulaire">
<?php 
$colonne=serialize($colonne);
$colonne=ereg_replace("'","&#146;",$colonne);
?>
<input type=hidden name="structure" value='<?php print $colonne ?>' />
<?php print LANGVATEL202 ?> : <input type='text' name="nom_structure"  maxlength='200' />
<br><br>
<input type='submit'  value="<?php print LANGVATEL200  ?>"  class='btn btn-primary btn-sm  vat-btn-footer'  name="savestructure" >
</form>
<center>
<br><br>
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