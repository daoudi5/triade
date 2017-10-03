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

	$datalisting=listingEleve(); 
	/* elev_id,			0
	 * nom, 			1
	 * prenom,			2
	 * classe,			3
	 * lv1,				4
	 * lv2,				5
	 * option,			6
	 * regime,			7
	 * date_naissance,		8
	 * lieu_naissance,		9
	 * nationalite,			10
	 * passwd,			11
	 * passwd_eleve,		12
	 * civ_1,			13
	 * nomtuteur,			14
	 * prenomtuteur,		15
	 * adr1,			16
	 * code_post_adr1,		17
	 * commune_adr1,		18
	 * tel_port_1,			19
	 * civ_2,			20
	 * nom_resp_2,			21
	 * prenom_resp_2,		22
	 * adr2,			23
	 * code_post_adr2,		24
	 * commune_adr2,		25
	 * tel_port_2,			26
	 * telephone,			27
	 * profession_pere,		28
	 * tel_prof_pere,		29
	 * profession_mere,		30
	 * tel_prof_mere,		31
	 * nom_etablissement,		32
	 * numero_etablissement,	33
	 * code_postal_etablissement,	34
	 * commune_etablissement,	35
	 * numero_eleve,		36
	 * photo,			37
	 * email,			38
	 * email_eleve,			39
	 * email_resp_2,		40
	 * class_ant,			41
	 * annee_ant,			42
	 * numero_gep,			43
	 * valid_forward_mail_eleve,	44
	 * valid_forward_mail_parent,	45
	 * tel_eleve,			46
	 * code_compta,			47
	 * sexe 			48
	 * email_eleve,			49
	 * adr_eleve,			50
	 * ccp_eleve,			51
	 * commune_eleve,		52
	 * pays_eleve			53
	 * emailpro_eleve		54
	 * annee_scolaire		55
	 * information			56
	 * tel_fixe_eleve		57
	 */
	$ii=1;
	for ($i=0;$i<count($datalisting);$i++) {
		$a=1;
		for ($j=0;$j<count($colonne);$j++) {
			$donnee="";
			if ($colonne[$a] == "nom") { 	$choix=1;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "prenom") { $choix=2;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "classe") { $choix=3;  $donnee=chercheClasse_nom($datalisting[$i][$choix]);  }
			if ($colonne[$a] == "lv1") { 	$choix=4;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "lv2") { 	$choix=5;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "option") { $choix=6;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "regime") { $choix=7;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "date_naissance") { $choix=8;  $donnee=dateForm($datalisting[$i][$choix]); }
			if ($colonne[$a] == "lieu_naissance") { $choix=9;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "nationalite") { 	$choix=10;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "civ_1") { 		$choix=13;  $donnee=civ($datalisting[$i][$choix]); }
			if ($colonne[$a] == "nomtuteur") { 	$choix=14;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "prenomtuteur") { 	$choix=15;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "adr1") { 		$choix=16;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "code_post_adr1") { $choix=17;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "commune_adr1") { 	$choix=18;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "tel_port_1") { 	$choix=19;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "civ_2") { 		$choix=20;  $donnee=civ($datalisting[$i][$choix]); }
			if ($colonne[$a] == "nomtuteur_2") { 	$choix=21;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "prenomtuteur_2") { $choix=22;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "adr2") { 		$choix=23;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "code_post_adr2") { $choix=24;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "commune_adr2") { 	$choix=25;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "tel_port_2") { 	$choix=26;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "telephone") { 	$choix=27;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "profession_pere") { $choix=28;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "tel_prof_pere") { 	 $choix=29;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "profession_mere") { $choix=30;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "tel_prof_mere") { 	 $choix=31;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "nom_etablissement") { 	$choix=32;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "numero_etablissement") { 	$choix=33;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "code_postal_etablissement") { $choix=34;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "commune_etablissement") { 	$choix=35;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "numero_eleve") { 	$choix=36;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "photo") { 		$choix=37;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "email") { 		$choix=38;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "email_eleve") { 	$choix=39;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "email_resp_2") { 	$choix=40;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "class_ant") { 	$choix=41;  $donnee=$datalisting[$i][$choix]; } 
			if ($colonne[$a] == "annee_ant") { 	$choix=42;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "numero_gep") { 	$choix=44;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "valid_forward_mail_eleve") {   $choix=45;  $donnee=strtolower($datalisting[$i][$choix]); }
			if ($colonne[$a] == "tel_eleve") { 	$choix=46;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "valid_forward_mail_parent") {  $choix=47;  $donnee=strtolower($datalisting[$i][$choix]); }
			if ($colonne[$a] == "sexe") { 		$choix=48;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "code_barre") { 	$choix=0;   $donnee=recupIdCodeBar($datalisting[$i][$choix],"menueleve"); }
			if ($colonne[$a] == "email_eleve") { 	$choix=49;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "adresse_eleve") { 	$choix=50;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "ccp_eleve") { 	$choix=51;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "commune_eleve") { 	$choix=52;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "pays_eleve") { 	$choix=53;  $donnee=$datalisting[$i][$choix]; }
			if ($colonne[$a] == "email_eleve_pro") {$choix=54;  $donnee=$datalisting[$i][$choix]; }	
			if ($colonne[$a] == "annee_scolaire")  {$choix=55;  $donnee=$datalisting[$i][$choix]; }	
			if ($colonne[$a] == "information")     {$choix=56;  $donnee=$datalisting[$i][$choix]; }	
			if ($colonne[$a] == "tel_fixe_eleve")  {$choix=57;  $donnee=$datalisting[$i][$choix]; }	
			$worksheet1->write_string($ii, $j, "$donnee", $center);
			$a++;
	    	}
		$ii++;
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
<input type=button onclick="open('visu_document.php?fichier=<?php print $fichier?>','_blank','');" value="<?php print LANGVATEL203 ?>"  class='btn btn-primary btn-sm  vat-btn-footer'  >
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
<?php print LANGVATEL202 ?> : <input type=text name="nom_structure"  maxlength='200' />
<br><br>
<input type=submit  value="<?php print LANGVATEL200 ?>"  class='btn btn-primary btn-sm  vat-btn-footer'  name="savestructure" >
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