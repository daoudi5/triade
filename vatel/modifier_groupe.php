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
			<span class="vat-capitalize-title"><?php print LANGVATEL78 ?> </span>
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

<form method='post' name="formulaire" action='modifier_groupe.php' >
<?php
if (isset($_POST["modif"])) {
	modifAnneeScolaireGroupe($_POST["idgroupe"],$_POST["annee_scolaire"]);
}
$idgroupe=$_GET["gid"];
if (isset($_POST["idgroupe"])) $idgroupe=$_POST["idgroupe"]; 
$data=recupInfoGroupe($idgroupe); // group_id,libelle,annee_scolaire 
$anneeScolaire=$data[0][2];
$libelle=$data[0][1];
?>
<ul><BR>
<font class=T2><?php print LANGGRP1?> : <?php print $libelle ?> </font> 
<br><br>
<font class="T2"><?php print LANGBULL3?> : </font>
<input type='hidden' name="idgroupe" value="<?php print $idgroupe?>" />
<select name="annee_scolaire" size="1">
<?php
filtreAnneeScolaireSelectNote("$anneeScolaire",3); // creation des options
?>
</select>
<br>
<BR><BR><UL>
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print VALIDER?>","modif"); //text,nomInput</script>
</form>
</ul>
<?php 
if (isset($_POST["modif"])) {
	print "<br><br><br>";
	print "<center><font class='T2'>".LANGDONENR."</font></center>";
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