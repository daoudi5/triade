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
include_once("../common/config.inc.php");
include_once("../librairie_php/db_triade.php");
include_once("../common/config2.inc.php");
if ((VIESCOLAIRENOTEENSEIGNANT == "oui") && ($_SESSION["membre"] != "menupersonnel"))  {
	validerequete("3");
}else{
	if (($_SESSION["membre"] != "menuadmin") && ($_SESSION["membre"] != "menuprof")) {
		$cnx=cnx2();
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
$libel=urldecode($_GET["libel"]);
$data=urldecode($_GET["args"]);
$data=explode(";",$data);
array_shift($data);
$i=1;
$l=count($data);
while($i<$l){
	unset($data[$i]);
	$i=$i+2;
}
foreach($data as $tmp){
	$inter=explode("\"",trim($tmp));
	if (get_magic_quotes_gpc()) {
		$dataTmp[]=substr($inter[1],0,-1);
	}else{
		$dataTmp[]=$inter[1];
    	}
}
$data=$dataTmp;
unset($dataTmp);
if ($_GET["sujet"] != "") {
	$sujet=$_GET["sujet"];
}else{
	$sujet=$data[0];
}
$date=change_date(trim($data[1]));
$coef=$data[2];
$examen=$data[3];
$elev_id=$data[4];
$code_mat=$data[5];
$prof_id=$data[6];
$cid=$data[7];

if (isset($_SESSION["idprofviaadmin"])) {
	$prof_id=$_SESSION["idprofviaadmin"];
	$nomduprof=" - ".LANGVATEL41." ".recherche_personne2($prof_id);
}

unset($data);


if ($_GET["gid"] > 0) {
	$idgroupe=$_GET["gid"];
	$idClasse=$_GET["idClasse"];
 	// si c'est un groupe
	$sql="DELETE FROM ${prefixe}notes WHERE sujet='".$sujet."' AND date='$date' AND coef='$coef' AND elev_id IN ($elev_id) AND code_mat='$code_mat' AND (id_classe='$idClasse' OR id_classe='-1') AND prof_id='$prof_id' AND (id_groupe='$idgroupe' OR id_groupe='0') ";
}else{
	$idClasse=$_GET["idClasse"];
 	// si c'est pas un groupe 
	$sql="DELETE FROM ${prefixe}notes WHERE sujet='".$sujet."' AND date='$date' AND coef='$coef' AND elev_id IN ($elev_id) AND code_mat='$code_mat'  AND id_classe='$idClasse' AND  prof_id='$prof_id' ";
}
execSql($sql);
history_cmd($_SESSION["nom"],"SUPPRESSION","Notes - $sujet du ".dateForm($date));
$mySession[Sn]=$_SESSION["nom"];
$mySession[Sp]=$_SESSION["prenom"];
?> 
	<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL23 ?> - <?php print LANGVATEL26 ?> <?php print $nomduprof ?></span>
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
    <!-- // fin  -->
	<font class='T2'><?php print LANGPROF24 ?> <b><?php print stripslashes($sujet)?></b> <?php print LANGTE2 ?> <?php print dateForm($date)?> <?php print LANGPROF25 ?>.</font>
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
