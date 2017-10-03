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
			<span class="vat-capitalize-title"><?php print LANGVATEL130 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param9.php' ><?php print "Menu" ?></a></li>
				<li style="visibility:visible" ><a href='certificat.php' ><?php print LANGVATEL129 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">


<form method=post  action='./certificat_param_import2.php' name=formulaire ENCTYPE="multipart/form-data">
<table  width=100%  border="0" align="center" >
<tr>
<td align="right"  valign='top'><?php print LANGCIRCU8 ?> : </TD>
<td  align="left">
<input type="file" name="fichier" size=30 >
<img src='../image/help.gif' align=center width='15' height='15'  border=0 title='Certificat au format rtf et moins de 2Mo' >
<br><br><br>
<font class='T2'><?php print LANGVATEL128 ?>&nbsp;:&nbsp;</font><select name='num_certif'>
<option value=''></option>
<option value='_A'>A</option>
<option value='_B'>B</option>
<option value='_C'>C</option>
</select> 
</td>
</tr></table><br /><br />
<table align=center><tr><td>
<script language=JavaScript>buttonMagicSubmit3VATEL("<?php print LANGCIRCU15?>","rien","");</script>&nbsp;&nbsp;
</td></tr></table>
</form>
<br />
<table align='center' width='90%' ><tr><td><?php print LANGPARAM3 ?></td></tr></table>
<br />
<ul>
<font class='T2'><b><?php print LANGVATEL132 ?></b><br><br>
<?php

if (isset($_GET["supp"])) { 
	if ($_GET["supp"] == "0") {
		@unlink("../data/parametrage/certificat.rtf"); 
	}else{
		@unlink("../data/parametrage/certificat".$_GET["supp"].".rtf"); 
	}
}

if (file_exists("../data/parametrage/certificat.rtf")) {
	print "- Certificat standard : <a href='telecharger.php?fichier=data2/parametrage/certificat.rtf' target='_blank' ><img src='../image/commun/download.png' border='0' /></a> / <a href='certificat_param_import.php?supp=0'><img src='../image/commun/trash.png' border='0' /></a>";
}


if (file_exists("../data/parametrage/certificat_A.rtf")) {
	print "- Certificat A : <a href='telecharger.php?fichier=data2/parametrage/certificat_A.rtf' target='_blank' ><img src='../image/commun/download.png' border='0' /></a> / <a href='certificat_param_import.php?supp=_A'><img src='../image/commun/trash.png' border='0' /></a>";
}

if (file_exists("../data/parametrage/certificat_B.rtf")) {
	print "- Certificat B : <a href='telecharger.php?fichier=data2/parametrage/certificat_B.rtf' target='_blank' ><img src='../image/commun/download.png' border='0' /></a> / <a href='certificat_param_import.php?supp=_B'><img src='../image/commun/trash.png' border='0' /></a>";
}

if (file_exists("../data/parametrage/certificat_C.rtf")) {
	print "- Certificat C : <a href='telecharger.php?fichier=data2/parametrage/certificat_C.rtf' target='_blank' ><img src='../image/commun/download.png' border='0' /></a> / <a href='certificat_param_import.php?supp=_C'><img src='../image/commun/trash.png' border='0' /></a>";
}

?>
</ul></font>
		
		
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
