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

validerequete("menuadmin");

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
			<span class="vat-capitalize-title"><?php print LANGVATEL206 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param9.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a href='gestion_examen.php' ><?php print LANGVATEL211 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
<?php

if ((isset($_GET["suppfichier"])) && (trim($_GET["suppfichier"]) != ""))  {
	@unlink("../data/parametrage/".$_GET["suppfichier"]);
	supp_parametrage_supplementtitre($_GET["suppfichier"]);
}

if (isset($_POST["createfile"])) {
	if (trim($_FILES['rtf']['tmp_name']) != "") {
		$fichier=$_FILES['rtf']['name'];
		$type=$_FILES['rtf']['type'];
		$tmp_name=$_FILES['rtf']['tmp_name'];
		$size=$_FILES['rtf']['size'];
		$key=md5(time());
	
		if ($size <= 8000000) {
			if  (($type == "application/octet-stream") || ($type == "application/msword")  || ($type == "application/rtf") || (eregi('.rtf$',$fichier)) )  {
				@unlink("../data/parametrage/supplement_titre_$key.rtf");
				move_uploaded_file($tmp_name,"../data/parametrage/supplement_titre_$key.rtf");
				if (file_exists("../data/parametrage/supplement_titre_$key.rtf")) { 
					print "<br><center><font class='T2'>"."Fichier enregistré"."</font></center>";
					$libelle=preg_replace('/"/','',$_POST["libelle"]);
					enr_parametrage($libelle,"supplement_titre_$key.rtf","supplementautitre");
				}else{
					print "<br><center><font class='T2' id='color3' >".LANGVATEL134." !!"."</font></center>";
				}
			}else{
				print "<br><center><font class='T2' id='color3' >".LANGVATEL135." !!</font></center>";
			}
		}else{
			print "<br><center><font class='T2' id='color3' >".LANGVATEL136." !!</font></center>";
		}
	}else{
		print "<br><center><font class='T2' id='color3' >".LANGVATEL137." !!</font></center>";
	}
}

?>
<br><br>
<form method='post' action='gestion_supplement_titre.php' enctype="multipart/form-data" >
<table align='center'>
<tr><td align='right'><font class='T2'><?php print LANGRESA62 ?>&nbsp;:&nbsp;</font></td><td><input type='text' name='libelle' size='30' maxlength='30' /></td></tr>
<tr><td height='10'></td></tr>
<tr><td align='right' valign='top' ><font class='T2'><?php print LANGMESS105 ?> "rtf"&nbsp;:&nbsp;</font></td><td><input type='file' name='rtf' /> <i>(max:8Mo)</i> </td></tr>
<tr><td height='20'></td></tr>
<tr><td colspan='2' align='center' ><script language=JavaScript>buttonMagicSubmit3VATEL("<?php print LANGENR ?>","createfile",""); //text,nomInput</script></td></tr>
</table>
</form>
<?php 
$data=recupListeSupplementAuTitre();
?>
<?php 
if (count($data)) {  ?>
<hr>
<table align='center' border='1' style='border-collapse: collapse;' >
<tr>
<td bgcolor='black'><font class='T2' color='white' >&nbsp;<b><?php print LANGASS7 ?></b>&nbsp;</font></td>
</tr>
<?php
//libelle,fichier
for($i=0;$i<count($data);$i++) {
	$libelle=$data[$i][0];
	$fichier="../data/parametrage/".$data[$i][1];
	$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
	print "<tr bgcolor='$bgcolor' >\n";
	print "<td>";
	print "<font class='T2'>&nbsp;$libelle&nbsp;</font></td>";
	print "<td align='center'><a href='telecharger.php?fichier=$fichier&fichiername=$fichier'><img src='../image/commun/download.png' border='0' title='Télécharger' /></a>";
	print "&nbsp;&nbsp;<a href='gestion_supplement_titre.php?suppfichier=".$data[$i][1]."'><img src='../image/commun/trash.png' border='0' title='".LANGBT50."' /></a>&nbsp;&nbsp;";		
	print "</td></tr>";

}
?>
</table>
<br><br>
<?php } ?>
<hr>
<ul>
<font class='T2'>
 <font class='shadow'><b><?php print LANGVATEL133 ?>&nbsp;:&nbsp;</b></font><br><br>

 NBETUDIANTS => Nombre d'etudiants<br />
 HISTOETUDIANT => Parcours de l'etudiant<br />
 NOMETUDIANT => Nom de l'etudiant<br>
 PREETUDIANT => Prénom de l'etudiant<br>
 DATENAISETUDIANT => Date de naissance de l'etudiant<br>
 IDENTETUDIANT => Code d'identification de l'etudiant<br>
 NOMETABLISSEMENT => Nom de l'etablissement de l'etudiant<br>
 DATEDUJOUR => Date du jour<br>
 LANGUEETUDIANT => La langue d'enseignement<br>
 NBRETUDIANTPA1 => Le nombre d'etudiants M4 et PREPA pour le titre 1 <br>
 NBRETUDIANTPA2 => Le nombre d'etudiants en première année pour le titre 2 <br>
 NBRETUDIANTPREPA => Le nombre d'etudiants en prepa  <br>
 NBRETUDIANTM4 => Le nombre d'etudiants en M4 pour le titre 1 <br>
 SPECIALISATION => Specialisation de la classe <br>
 NOMDIRECTEUR => Nom du Directeur de l'etablissement <br>
 NOMCLASSELONG => Nom de la classe au format long <br>

<br><br>
</ul>
</font>
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
