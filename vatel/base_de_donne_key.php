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
			<span class="vat-capitalize-title"><?php print LANGVATEL86 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param9.php' ><?php print "Menu" ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
		<?php
validerequete("3");

if ($_GET["saisie_resultat"] == "erreur" ) :
   $message_erreur="<font size=3 color='red'>".LANGTERREURCONNECT."</font><BR><br>";
endif ;
?>
<form method=post action='./base_de_donne_central.php' >
<TABLE border='0' bordercolor="#000000" width='100%' height='200' >
<TR>
<TD align=center bordercolor="#FFFFFF" id='bordure' >
<?php print "$message_erreur" ?>
<font class="T4 shadow">
<b><?php print LANGPER12?></b>
</font><br/><br/>
<CENTER><br>
<input type='password' name='saisie_code1'  size=10> ----
<input type='password' name='saisie_code2'  size=10> ----
<input type='password' name='saisie_code3'  size=10>
</CENTER><BR><BR>
<input type='hidden' name='base' value="<?php print $_GET["base"]?>">
<input type='hidden' name='dbf_name' value="<?php print $_GET["dbf_name"]?>">
<input type='hidden' name='modulepost' value="<?php print $_POST["modulepost"]?>">
<input type='hidden' name='modulesecurite' value="<?php print $_GET["key"]?>">
<input type='hidden' name='eid' value="<?php print $_GET["eid"]?>">
<input type='hidden' name='supp_date_cal' value="<?php print $_POST["supp_date_cal"]?>" />
<input type='hidden' name="supp_date_dst" value="<?php print $_POST["supp_date_dst"]?>" /> 
<input type='hidden' name="supp_date_edt" value="<?php print $_POST["supp_date_edt"]?>" /> 
<input type='hidden' name="sClasseGrp" value="<?php print $_GET["sClasseGrp"]?>" /> 
<table align=center>
<tr><td>
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGPER13?>","rien"); //text,nomInput</script>
</td></tr></table>
<br /><br />
<img src="../image/commun/important.png" align='center'><font class='T1'><?php print LANGMESS376 ?> <a href="../admin/index.php" target="_blank" ><?php print LANGMESS377 ?></a> <?php print LANGMESS378 ?></font>
</TD>
<TR>
</table>
</form>
<?php
if ($_SESSION["adminplus"] == "suppreme") {
?>
	<script language=JavaScript>document.forms[0].submit();</script>
<?php
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