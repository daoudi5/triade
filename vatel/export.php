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
<ul>
<font class=T2><b><?php print LANGMESS235 ?></b></font>
<br />
<br />
<font class=T2>
<img src="../image/commun/on1.gif" width="8" height="8"> <a href="./export_eleve.php"><?php print ucfirst(INTITULEELEVE) ?> (format excel)</A> <br />
<br />
<img src="../image/commun/on1.gif" width="8" height="8"> <a href="./export_personnel.php"><?php print LANGMESS236 ?> (format excel)</A>&nbsp;&nbsp;<i>(Ens.,Vie scolaire,Dir.,etc...)</i> <br />
</ul>
<br>
<ul>
<font class=T2><b><?php print LANGMESS237 ?></b></font>
<br />
<br />
<?php
if (isset($_POST["savestructure"])) {

	$structure=stripslashes($_POST["structure"]);
	$nom_structure=$_POST["nom_structure"];
	$libelle="##struct##$nom_structure";

	$data=aff_enr_parametrage($libelle);
	if (count($data) > 0) { 
		print "<form method='post' action='export.php' >";
		print "<input type=hidden name='structure' value='$structure' />";
		print "<font class=T2 color='red' >".LANGTMESS431." : </font>";
		print "<input type=text name='nom_structure' value='$nom_structure' /> ";
		print "<input type=submit value='".VALIDE."' name='savestructure' class='bouton2' />";
		print "</form>";
	}else{
		enr_parametrage($libelle,$structure);
	}
}

if (isset($_GET['supp'])) { supp_parametrage('##struct##'.$_GET['supp']); }

print "<table width='90%'>";
$data=aff_structure("##struct##");
for($i=0;$i<count($data);$i++) {
	$libelle=$data[$i][0];
//	$structure=unserialize($data[$i][1]);
	$libelle=ereg_replace('##struct##','',$libelle);
	print "<tr><td><img src='../image/commun/on1.gif' width='8' height='8'> ".LANGTMESS432." : <a href='export_eleve_3.php?libelle=$libelle' ><span id='disp$i'>$libelle</span></a></td><td><a href='./export.php?supp=$libelle' title=\"$libelle\" onmouseover=\"document.getElementById('disp$i').style.cssText='color:red;font-weight:bold;'\"  onmouseout=\"document.getElementById('disp$i').style.cssText='color:black;' \" ><img src='../image/commun/trash.png' border='0' align='center'/></a></td></tr>";
}
?>


</table>
<br><br>

		
		
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