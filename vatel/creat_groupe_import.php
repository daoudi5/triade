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
validerequete("menuadmin");
?>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL75 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param8.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a href='liste_groupe.php' ><?php print LANGBT12 ?></a></li>
				<li style="visibility:visible" ><a href='suppression_groupe.php' ><?php print LANGGRP44 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

		<script language="JavaScript" src="../librairie_js/verif_creat.js"></script>

<?php
$fichier=$_FILES['fichier']['name'];
$type=$_FILES['fichier']['type'];
$tmp_name=$_FILES['fichier']['tmp_name'];
$size=$_FILES['fichier']['size'];
//print $type;

$erreur_fichier="oui";
$anneeScolaire=$_POST["annee_scolaire"];

if ( (!empty($fichier)) &&  ($size <= 2000000)) {
   	if  ( ($type == "application/vnd.ms-excel" ) || ($type == "application/octet-stream") )  {
		$erreur_fichier="non";
		move_uploaded_file($tmp_name,"../data/imp_grp.xls");

		$titre=$_POST["saisie_intitule"];
		$fic_xls="../data/imp_grp.xls";
		include_once('../librairie_php/reader.php');
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP1251');
		$data->read($fic_xls);
		
		$params[nomgr]=trim($_POST["saisie_intitule"]);
		$params[comment]=$_POST["saisie_commentaire"];

		for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
			$nom=trim(strtolower(addslashes($data->sheets[0]['cells'][$i][1])));
			$prenom=trim(strtolower(addslashes($data->sheets[0]['cells'][$i][2])));
			$naissance=trim(dateFormBase($data->sheets[0]['cells'][$i][3]));
			$cr=verifEleveExist($nom,$prenom,$naissance);
			if ($cr == "rien") {
				$nontrouve.="- <b>".strtoupper($nom)."</b> ".ucwords($prenom). "<br />";
			}else{
				$ideleve=$cr;
				$trouve[$ideleve]=$ideleve;
			}
		}

		$params[liste_eleve]=join(",",$trouve);

		@unlink($fic_xls);
		if(verifnomgrp($_POST["saisie_intitule"])) {
			if(create_groupe($params,$anneeScolaire) ){
				print "<font class='T2'>". LANGGRP40 ."</font></center><br>";
				if (trim($nontrouve) != "") {
					print "<font class=T2><ul>".LANGGRP41." : <br>";
					print "<br>$nontrouve<br /><br /></ul>";
				}
			}
		}else{
			print "<font class=T2><center>".LANGVATEL83."</center></font><br>";
		}
	} /// fin du if size et empty
} // fin du if type





if ($erreur_fichier == "oui" ) {
	print "<font class=T2><center>".LANGGRP43.".</center></font>";
}
?>
		
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