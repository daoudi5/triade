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

if ($_SESSION["membre"] == "menupersonnel") {
	if (!verifDroit($_SESSION["id_pers"],"trombinoscopeRead")){
		validerequete("2");
	}
}else{
	validerequete("2");
	$visu=1;
	$visu2=1;
}

?>
<script language="JavaScript" src="../librairie_js/lib_circulaire.js"></script>


<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL273 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param8.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a href='param8tronbi.php' ><?php print LANGVATEL69." ".LANGASS38 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

<form method=post  name="formulaire">
<table border=0>
<tr><td><font class="T2"><?php print LANGELE4?> :</font> <select id="saisie_classe" name="saisie_classe">
<option value=0 STYLE='color:#000066;background-color:#FCE4BA'><?php print LANGCHOIX?></option>
<?php
select_classe(); // creation des options
?>
</select></td><td>
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGBT28?>","consult"); //text,nomInput</script>
</td></tr>
<tr><td height=20></td></tr>
<tr><td><font class="T2"><?php print LANGELE6 ?> :</font> <select id="saisie_regime" name="saisie_regime">
                         <option value=0 STYLE='color:#000066;background-color:#FCE4BA'><?php print LANGCHOIX?></option>
<?php
select_regime(); // creation des options
?>
</select></td><td>
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGBT28?>","consultregime"); //text,nomInput</script>
</td></tr>
</table>
<br><br>
<?php
if ((isset($_POST["consult"]))  && ($_POST["saisie_classe"] != 0)) { 
	$nomclasse=chercheClasse_nom($_POST["saisie_classe"]);

?>
<script language=JavaScript>buttonMagicVATEL("<?php print LANGVATEL70." $nomclasse " ?>","../tronbinoscope-impr-pdf.php?idclasse=<?php print $_POST["saisie_classe"]?>","impr","width=800,height=600,scrollbars=yes,menubar=yes","") </script>&nbsp;&nbsp;
<?php } 

if ((isset($_POST["consultregime"])) && ($_POST["saisie_regime"] != "0" ))  {
	$nomregime=$_POST["saisie_regime"];
	if ($_POST["saisie_regime"] > 0) $nomregime=rechercheNomRegime($_POST["saisie_regime"]);
?>
<script language=JavaScript>buttonMagicVATEL("<?php print LANGVATEL71 ?>","../tronbinoscope-impr-pdf.php?nomregime=<?php print $nomregime ?>","impr","width=800,height=600,scrollbars=yes,menubar=yes","") </script>&nbsp;&nbsp;
<?php } ?>
</UL></UL>
<br><br>
</form>
		
		
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
