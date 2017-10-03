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
?>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGASS24 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='circulaire-admin.php' ><?php print LANGVATEL21 ?></a></li>
				<li style="visibility:visible" ><a href='visucirculaire.php' ><?php print LANGVATEL24 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

<?php
validerequete("menuadmin");

if (!isset($_POST["modif"])) {
	$fichier=$_FILES['fichier']['name'];
	$type=$_FILES['fichier']['type'];
	$tmp_name=$_FILES['fichier']['tmp_name'];
	$size=$_FILES['fichier']['size'];
	$erreur_fichier="oui";
	if (UPLOADIMG == "oui") {
		$taille=8000000;
	}else{
		$taille=2000000;
	}
	if ( (!empty($fichier)) &&  ($size <= $taille)) {
		if  ( (eregi('text',$type))  ||
			(eregi('pdf',$type))   ||
			(eregi('msword',$type)) ||
			(eregi('opendocument',$type)) ||
			($type == "application/force-download") )  {
			$erreur_fichier="non";
			$fichier=str_replace(" ","_",$fichier);
			$fichier=str_replace("'","_",$fichier);
			$fichier=str_replace("\\","",$fichier);
			$fichier=TextNoAccent($fichier);
			move_uploaded_file($tmp_name,"../data/circulaire/$fichier");
		}
	}
}

if (!empty($_POST["saisie_classe"])) {
	$classesPost=$_POST["saisie_classe"];
	$varClasseSql="{";
	$varClasseSql.=join(",",$classesPost);
	$varClasseSql.="}";
}else {
	$varClasseSql="NULL";
}
	
$titre=$_POST["saisie_titre"];
$ref=$_POST["saisie_ref"];
$categorie=$_POST["saisie_cat"];
$prof=$_POST["saisie_envoi_prof"];
$pers=$_POST["saisie_envoi_pers"];
$mvs=$_POST["saisie_envoi_mvs"];
$dir=$_POST["saisie_envoi_dir"];
$tut=$_POST["saisie_envoi_tut"];

if (file_exists("../data/circulaire/$fichier")) {
	if (!isset($_POST["modif"])) {
		$cr=create_circulaire($titre,$ref,$fichier,dateDMY2(),$prof,$varClasseSql,$_SESSION["id_pers"],$pers,$mvs,$dir,$tut,$categorie);		
	}else{
		$cr=modif_circulaire($titre,$ref,dateDMY2(),$prof,$varClasseSql,$_SESSION["id_pers"],$pers,$mvs,$dir,$tut,$_POST["id_circulaire"],$categorie);
	}
	if($cr){
		print "<BR><center>".LANGCIRCU18."</center>";
		if ($_POST["envoimessage"] == "oui") {
			$text="
		Message automatique : Une circulaire a été déposée à votre attention.";
			$date=dateDMY2();
			$heure=dateHIS();
			$number=md5(uniqid(rand()));
			if ($prof == 1) {
			$data=affPers("ENS") ; // pers_id, civ, nom, prenom, identifiant, offline
			for($i=0;$i<count($data);$i++) {
				$idEns=$data[$i][0];
				$offline=$data[$i][5];
				if ($offline == 1) { continue; }
					envoi_messagerie($_SESSION["id_pers"],$idEns,$titre,Crypte($text,$number),$date,$heure,renvoiTypePersonne($_SESSION["membre"]),'ENS',$number,'');
				}
			}
			if ($pers == 1) {
				$data=affPers("PER") ; // pers_id, civ, nom, prenom, identifiant, offline
				for($i=0;$i<count($data);$i++) {
					$idEns=$data[$i][0];
					$offline=$data[$i][5];
					if ($offline == 1) { continue; }
					envoi_messagerie($_SESSION["id_pers"],$idEns,$titre,Crypte($text,$number),$date,$heure,renvoiTypePersonne($_SESSION["membre"]),'PER',$number,'');
				}
			}
			if ($mvs == 1) {
				$data=affPers("MVS") ; // pers_id, civ, nom, prenom, identifiant, offline
				for($i=0;$i<count($data);$i++) {
					$idEns=$data[$i][0];
					$offline=$data[$i][5];
					if ($offline == 1) { continue; }
					envoi_messagerie($_SESSION["id_pers"],$idEns,$titre,Crypte($text,$number),$date,$heure,renvoiTypePersonne($_SESSION["membre"]),'MVS',$number,'');
				}
			}
			if ($dir == 1) {
				$data=affPers("ADM") ; // pers_id, civ, nom, prenom, identifiant, offline
				for($i=0;$i<count($data);$i++) {
					$idEns=$data[$i][0];
					$offline=$data[$i][5];
					if ($offline == 1) { continue; }
					envoi_messagerie($_SESSION["id_pers"],$idEns,$titre,Crypte($text,$number),$date,$heure,renvoiTypePersonne($_SESSION["membre"]),'ADM',$number,'');
				}
			}
			if ($tut == 1) {
				$data=affPers("TUT") ; // pers_id, civ, nom, prenom, identifiant, offline
				for($i=0;$i<count($data);$i++) {
					$idEns=$data[$i][0];
					$offline=$data[$i][5];
					if ($offline == 1) { continue; }
					envoi_messagerie($_SESSION["id_pers"],$idEns,$titre,Crypte($text,$number),$date,$heure,renvoiTypePersonne($_SESSION["membre"]),'TUT',$number,'');
				}
			}
			foreach ( $_POST["saisie_classe"] as $key=>$idclasse) {
				$sql="SELECT elev_id FROM ${prefixe}eleves WHERE classe='$idclasse'";
				$res=execSql($sql);
				$data=chargeMat($res);
				if(count($data) > 0) {
					for($i=0;$i<count($data);$i++) {
						$idEleve=$data[$i][0];
						envoi_messagerie($_SESSION["id_pers"],$idEleve,$titre,Crypte($text,$number),$date,$heure,renvoiTypePersonne($_SESSION["membre"]),'PAR',$number,'');
						envoi_messagerie($_SESSION["id_pers"],$idEleve,$titre,Crypte($text,$number),$date,$heure,renvoiTypePersonne($_SESSION["membre"]),'ELE',$number,'');
					}
				}
			}
		}
	}else{ ?>
		<center> <font color=red><?php print LANGCIRCU16?></font> <BR><BR>
<?php
	}
}else{ ?>
	<center> <font color=red><?php print LANGCIRCU16?></font> <BR><BR>
<?php
}

if ($erreur_fichier == "oui" ) {
		print LANGCIRCU17;
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