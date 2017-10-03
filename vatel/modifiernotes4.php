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
include_once("../common/config.inc.php"); // futur : auto_prepend_file
include_once("../librairie_php/db_triade.php");
include_once("../librairie_php/notes.inc.php");
include_once("../common/config2.inc.php");
if ((VIESCOLAIRENOTEENSEIGNANT == "oui") && ($_SESSION["membre"] != "menupersonnel"))  {
	validerequete("3");
}else{
	if (($_SESSION["membre"] != "menuadmin") && ($_SESSION["membre"] != "menuprof")) {
		$cnx=cnx();
		if (!verifDroit($_SESSION["id_pers"],"carnetnotes")) {
			accesNonReserveFen();
			exit();
		}
		Pgclose();
	}else{
		validerequete("profadmin");
	}
}
include_once("entete.php");
include_once("menu.php");
$cnx=cnx2();

if (isset($_SESSION["idprofviaadmin"])) {
	$adminIdprof=$_SESSION["idprofviaadmin"];
	$nomduprof=" - ".LANGVATEL41." ".recherche_personne2($adminIdprof);
}

?> 
	<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL22 ?> - <?php print LANGVATEL26 ?> <?php print $nomduprof ?></span>
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
// Sn : variable de Session nom
// Sp : variable de Session prenom
// Sm : variable de Session membre
// Spid : variable de Session pers_id
$ident=array('nom','Sn','prenom','Sp','membre','Sm','id_pers','Spid');
$mySession=hashSessionVar($ident);
//print_r($mySession);
$eleves= $_POST["elev_id"];
$date  = $_POST["date"];
$mid   = $_POST["code_mat"];
$coef  = $_POST["coef"];
$notes = $_POST["iNotes"];
$sujet = $_POST["sujet"];
$noms  = $_POST["elev_nom"];
$idcl  = $_POST["idcl"];
$idgrp = $_POST["gid"];
$typenote=$_POST["typenote"];
$notevisiblele=$_POST["notevisiblele"];


if (isset($_SESSION["idprofviaadmin"])) {
	$adminIdprof=$_SESSION["idprofviaadmin"];
	$nomduprof=" - ".LANGVATEL41." ".recherche_personne2($adminIdprof);
}



$sujet=ereg_replace('\+',' ',$sujet);
$sujet=ereg_replace('\?',' ',$sujet);
$sujet=ereg_replace('/',' ',$sujet);
$sujet=ereg_replace('&',' ',$sujet);
$sujet=ereg_replace('%',' ',$sujet);
$sujet=ereg_replace('µ',' ',$sujet);
$sujet=ereg_replace('\^',' ',$sujet);
$sujet=ereg_replace('\(',' ',$sujet);
$sujet=ereg_replace('\)',' ',$sujet);
$sujet=ereg_replace('"',' ',$sujet);
$sujet=ereg_replace("'",' ',$sujet);
$sujet=ereg_replace('\$',' ',$sujet);
$sujet=ereg_replace('£',' ',$sujet);
$sujet=ereg_replace(':',' ',$sujet);
$sujet=ereg_replace('=',' ',$sujet);
$sujet=ereg_replace('\*',' ',$sujet);
$sujet=ereg_replace('¨',' ',$sujet);
$sujet=ereg_replace(';',' ',$sujet);

if (isset($_POST["noteexamen"])) {
	$noteexamen=$_POST["noteexamen"];
}else{
	$noteexamen="";
}
$notationsur=$_POST["NotationSur"];

if ($typenote == "oui") { $typenote="en"; }else{ $typenote="fr"; }


$idprof=$mySession[Spid];
if ($adminIdprof != "") { $idprof=$adminIdprof; }

$j=0;
for($i=0;$i<count($eleves);$i++){
	$sql="DELETE FROM ${prefixe}notes WHERE elev_id='".$eleves[$i]."' AND prof_id='$idprof' AND code_mat='$mid' AND coef='$coef' AND date='".dateFormBase($date)."' AND id_classe='$idcl' AND id_groupe='$idgrp' AND noteexam='$noteexamen' AND sujet='$sujet'";
	execSql($sql);
	if (trim($notes[$i]) == "supp") { continue; }
	$Notes[$j]= new Note($noms[$i],$eleves[$i],$notes[$i]);
	$j++;
}


execSql("BEGIN");

$listeNotes=new ListeNotes($j,$idprof,$mid,$coef,$date,$sujet,$Notes,$idcl,$idgrp,$typenote,$noteexamen,$notationsur,$notevisiblele);
if($listeNotes->persist()){
	$del=join(",",$_POST["note_id"]);
	execSql("DELETE FROM ${prefixe}notes WHERE note_id IN ($del)");
	execSql("COMMIT");
	$mid=chercheMatiereNom($mid);
	history_cmd($_SESSION["nom"],"MODIF","Notes - $sujet - $mid");
} else {
	execSql("ROLLBACK");
}
$listeNotes->affHtmlVATEL();
?>
<!-- // fin  -->
<ul>
<form method="POST"  action="modifiernotes2.php">
<input type="hidden" name="sMat" value="<?php print $_POST["sMat"] ?>" >
<input type="hidden" name="adminIdprof" value="<?php print $_POST["adminIdprof"] ?>" />
<input type="hidden" name="sClasseGrp" value="<?php print $_POST["sClasseGrp"] ?>" >
<input type='submit' value="<?php print LANGVATEL32 ?>" name="rien" class='btn btn-primary btn-sm  vat-btn-footer' />
</form><br><br>
</ul>

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
