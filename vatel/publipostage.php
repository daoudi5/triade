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

<script language="JavaScript" src="../librairie_js/verif_creat.js"></script>
<script language="JavaScript" src="../librairie_js/lib_trimestre.js"></script>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<?php if ($_GET["type"] != "PAR") { ?> 		
				<span class="vat-capitalize-title"><?php print LANGVATEL164 ?> </span>
			<?php }else{ ?>
				<span class="vat-capitalize-title"><?php print LANGVATEL165 ?> </span>
			<?php } ?>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param10.php' ><?php print LANGVATEL69 ?></a></li>
				<?php if ($_GET["type"] == "PAR") { ?> 
						<li style="visibility:visible" ><a href="publipostage.php?type=ELE"><?php print LANGVATEL164 ?></a></li>
				<?php }else{ ?>
						<li style="visibility:visible" ><a href="publipostage.php?type=PAR"><?php print LANGVATEL165 ?></a></li>
				<?php } ?>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
			
<form method=post  name="formulaire" action="publipostage_2.php">
<font class=T2><?php print LANGPROFG?> :</font> <select id="saisie_classe" name="saisie_classe">
               <option id='select0' ><?php print LANGCHOIX?></option>
<?php
select_classe(); // creation des options

$membrep=$_GET["type"];

if ($_GET["type"] == "ELE") $checked5="checked='checked'"; 
if ($_GET["type"] == "PAR") $checked3="checked='checked'"; 

if (isset($_COOKIE["publipomatricule"])) 	{ $matriculep=$_COOKIE["publipomatricule"]; }
if (isset($_COOKIE["publipoadresse"])) 		{ $adressep=$_COOKIE["publipoadresse"]; }
if (isset($_COOKIE["publipoadresseinfo"])) 	{ $adresseinfop=$_COOKIE["publipoadresseinfo"]; }
if (isset($_COOKIE["publipomembre"])) 		{ $membrep=$_COOKIE["publipomembre"]; }
if (isset($_COOKIE["publicivilite"])) 		{ $civilitep=$_COOKIE["publicivilite"]; }
if (isset($_COOKIE["publiclasse"])) 		{ $classep=$_COOKIE["publiclasse"]; }

if ($adresseinfop == "PAR1") { $checked3="checked='checked'";  $checked4=""; $checked5=""; }
if ($adresseinfop == "PAR2") { $checked4="checked='checked'";  $checked3=""; $checked5=""; }
if ($adresseinfop == "ELE")  { $checked5="checked='checked'";  $checked3=""; $checked4=""; }

if ($civilitep == "1")  $checked8="checked='checked'";
/*
if ($adressep == "oui")  $checked6="checked='checked'";
if ($matriculep == "oui")  $checked7="checked='checked'";
if ($classep == "oui")  $checked9="checked='checked'";
 */
?>

</select>
<input type=hidden name="membre" value="<?php print $_GET["type"] ?>" /> 
<?php if ($_GET["type"] == "PAR" ) { ?>
	<br><br>
	<font class='T2'> <?php print LANGMESS248 ?>  
	<input type='radio' name="adresseinfo" value="PAR1" <?php print $checked3 ?> style="float:none" /> <?php print LANGMESS249 ?> 1 
	<input type='radio' name="adresseinfo" value="PAR2" <?php print $checked4 ?> style="float:none" /> <?php print LANGMESS249 ?> 2
<?php }else{ ?>
	<input type='hidden' name="adresseinfo" value="ELE"  /></font>
<?php } ?>
<br><br>
<font class=T2><?php print LANGMESS412 ?> :</font> <select id="id_vignette" name="id_vignette">
	       <option id='select0' value='0' ><?php print LANGCHOIX?></option>
               <option id='select0' value='2' >2 <?php print LANGTMESS434 ?> (105x39)</option>
               <option id='select0' value='3' >2 <?php print LANGTMESS434 ?> (105x39) avec marge</option>
               <option id='select0' value='6' >2 <?php print LANGTMESS434 ?> (105x37)</option>
	       <option id='select0' value='5' >2 <?php print LANGTMESS434 ?> (102x41)</option>
	       <option id='select0' value='1' >3 <?php print LANGTMESS434 ?> (70x42,3)</option>
	       <option id='select0' value='4' >3 <?php print LANGTMESS434 ?> (70x37)</option>
</select> <br /><br />
<?php if ($_GET["type"] == "ELE") { ?>
<font class='T2'> <?php print LANGMESS328 ?> <input type='checkbox' style="float:none" name="civeleve"  value="1"  <?php print $checked8 ?> /> </font><i>(<?php print LANGOUI ?>) </i> <br><br>
<?php } ?>
<font class='T2'> <?php print LANGMESS329 ?> <input type='checkbox' style="float:none" <?php print $checked7 ?> name="matricule" id='matricule' value="oui" onclick="document.getElementById('adresse').checked=false ;" /> </font><i>(<?php print LANGOUI ?>) </i> <br><br>

<font class='T2'> <?php print LANGMESS330 ?> <input type='checkbox' style="float:none" name="classe" value="oui" <?php print $checked9 ?> id='classe' onclick="document.getElementById('adresse').checked=false ;" /> </font><i>(<?php print LANGOUI ?>) </i><br><br>

<font class='T2'> <?php print LANGMESS331 ?> <input type='checkbox' style="float:none" <?php print $checked6 ?> name="adresse" value="oui"  id='adresse' onclick="document.getElementById('matricule').checked=false ; document.getElementById('classe').checked=false"  /> </font><i>(<?php print LANGOUI ?>) </i><br><br>

<script language=JavaScript>buttonMagicSubmitVATEL("<?php print VALIDER?>","consult1"); //text,nomInput</script>

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