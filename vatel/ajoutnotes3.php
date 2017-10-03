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

include_once("../librairie_php/lib_error.php");
include_once("../common/config.inc.php"); // futur : auto_prepend_file
include_once("../common/config2.inc.php");
include_once("../librairie_php/db_triade.php");
include_once("../librairie_php/notes.inc.php");
validerequete("profadmin");

include_once("entete.php");
include_once("menu.php");


$cnx=cnx2();
// Sn : variable de Session nom
// Sp : variable de Session prenom
// Sm : variable de Session membre
// Spid : variable de Session pers_id
$ident=array('nom','Sn','prenom','Sp','membre','Sm','id_pers','Spid');
$mySession=hashSessionVar($ident);
//print_r($mySession);
$eleves=$_POST["elev_id"];
$dates=$_POST["iDate"];
$mid=$_POST["mid"];
$coefs=$_POST["iCoef"];
$notes=$_POST["iNotes"];
$sujets=$_POST["iSujet"];
$noms=$_POST["elev_nom"];
$noteusa=$_POST["NoteUsa"];
$noteExam=$_POST["NoteExam"];
$notationSur= $_POST["NotationSur"];
$notevisiblele=$_POST["notevisiblele"];

if ($_POST["NoteUsa"] == "oui") {
	$notetype="Notation en mode USA";
}else{
	$notetype="Notation sur $notationSur";
}

$idprof=$_SESSION["id_pers"];
	
if (isset($_SESSION["idprofviaadmin"])) {
	$idprof=$_SESSION["idprofviaadmin"];
	$nomduprof=" - ".LANGVATEL41." ".recherche_personne2($idprof);
}



if($_POST["gid"]):
	if (($_SESSION["membre"] == "menuprof") && (!isset($_SESSION["profpclasse"]))) {
		$verif=verifProfDansGroupe($idprof,$_POST["gid"]);
		if ($verif) { header("Location:ajoutenotes.php");exit; }
	}
	$who="<font color=\"#FFFFFF\">- ".LANGPROF4."  : </font> ".trunchaine(chercheGroupeNom($_POST["gid"]),10)." <font color='#FFFFFF'>-</font> $notetype ";
	$who2=chercheGroupeNom($_POST["gid"])."- $notetype ";
	$idgrp=$_POST["gid"];
	$idcl="-1";
else:
	$idcl=$_POST["cid"];
	$idgrp="NULL";
	$cl=chercheClasse($_POST["cid"]);
	if (($_SESSION["membre"] == "menuprof") && (!isset($_SESSION["profpclasse"]))) {
		$verif=verifProfDansClasse($idprof,$cl[0][0]);
		if ($verif) { header("Location:ajoutenotes.php");exit; }
	}
	$who2=$cl[0][1]."- $notetype ";
	$who="<font color=\"#FFFFFF\">- ".LANGIMP10." : </font>".trunchaine($cl[0][1],10)." <font color='#FFFFFF'>-</font> $notetype ";
	unset($cl);
endif;
?> 
	<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL21 ?> <?php print LANGVATEL26 ?> <?php print $nomduprof ?></span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='ajoutnotes.php' ><?php print LANGVATEL21 ?></a></li>
				<li style="visibility:visible" ><a href='modifiernotes.php' ><?php print LANGVATEL22 ?></a></li>
				<li style="visibility:visible" ><a href='supprimernotes.php' ><?php print LANGVATEL23 ?></a></li>
				<li style="visibility:visible" ><a href='visunotes.php' ><?php print LANGVATEL24 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px" >
		
<?php
// construction des tableaux de notes
for($i=0;$i<count($sujets);$i++){
	for($j=0;$j<count($eleves);$j++){
		$Notes[$i][$j]= new Note($noms[$j],$eleves[$j],$notes[$j][$i]);
	}
	if ($noteusa == "oui") {
		$typenote="en";
	}else{
		$typenote="fr";
	}

	$sujets[$i]=ereg_replace('\+',' ',$sujets[$i]);
	$sujets[$i]=ereg_replace('\?',' ',$sujets[$i]);
	$sujets[$i]=ereg_replace('/',' ',$sujets[$i]);
	$sujets[$i]=ereg_replace('&',' ',$sujets[$i]);
	$sujets[$i]=ereg_replace('%',' ',$sujets[$i]);
	$sujets[$i]=ereg_replace('µ',' ',$sujets[$i]);
	$sujets[$i]=ereg_replace('\^',' ',$sujets[$i]);
	$sujets[$i]=ereg_replace('\(',' ',$sujets[$i]);
	$sujets[$i]=ereg_replace('\)',' ',$sujets[$i]);
	$sujets[$i]=ereg_replace('"',' ',$sujets[$i]);
	$sujets[$i]=ereg_replace("'",' ',$sujets[$i]);
	$sujets[$i]=ereg_replace('\$',' ',$sujets[$i]);
	$sujets[$i]=ereg_replace('£',' ',$sujets[$i]);
	$sujets[$i]=ereg_replace(':',' ',$sujets[$i]);
	$sujets[$i]=ereg_replace('=',' ',$sujets[$i]);
	$sujets[$i]=ereg_replace('\*',' ',$sujets[$i]);
	$sujets[$i]=ereg_replace('¨',' ',$sujets[$i]);
	$sujets[$i]=ereg_replace(';',' ',$sujets[$i]);
//	$sujets[$i]=ereg_replace('+',' ',$sujets[$i]);


	
	$listeNotes[$i]=new ListeNotes($i,$idprof,$mid,$coefs[$i],$dates[$i],$sujets[$i],$Notes[$i],$idcl,$idgrp,$typenote,$noteExam,$notationSur,$notevisiblele);  // 20/01/2006 $noteusa
	$listeNotes[$i]->persist();
	$listeNotes[$i]->affHtmlVATEL();
}
// history cmd
$mid=chercheMatiereNom($mid);
history_cmd($mySession[Sn],"AJOUT","Notes - $who2 - $mid");
// fin history


?>
<!-- // fin  -->
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
