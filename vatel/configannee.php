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
			<span class="vat-capitalize-title"><?php print LANGBULL3 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param9.php' ><?php print "Menu" ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
		
<?php
validerequete("menuadmin");
$cnx=cnx2();

$dj=aff_valeur_parametrage("anneescolaire_dj");
$fj=aff_valeur_parametrage("anneescolaire_fj");
$dm=aff_valeur_parametrage("anneescolaire_dm");
$fm=aff_valeur_parametrage("anneescolaire_fm");

if (isset($_POST['okannee'])) {
	$dj=$_POST["dj"];
	$fj=$_POST["fj"];
	$dm=$_POST["dm"];
	$fm=$_POST["fm"];
	
	if (($dj > 0) && ($dj <= 31) && ($fj > 0) && ($fj <= 31) && ($dm > 0) && ($dm <= 12) && ($fm > 0) && ($fm <= 12)) {
		enr_parametrage("anneescolaire_dj",$dj,'');
		enr_parametrage("anneescolaire_fj",$fj,'');
		enr_parametrage("anneescolaire_dm",$dm,'');
		enr_parametrage("anneescolaire_fm",$fm,'');
		$reponse="<center><font class='T2' id='color3' ><b>".LANGALERT1."</b></font></center><br>";
	}else{
		$reponse="<center><font class='T2' id='color3' ><b>".LANGVATEL95."</b></font></center><br>";
	}

}
?>
<?php print $reponse ?>
<form method='post' action='configannee.php' >
<font class='T2'>
<ul>
<?php print LANGVATEL93 ?> <input type='text' size=2 value='<?php print $dj ?>' name='dj' /> / <input type='text' size=2 value='<?php print $dm ?>' name='dm' /><br /><br />
<?php print LANGVATEL94 ?> : <input type='text' size=2 value='<?php print $fj ?>' name='fj' /> / <input type='text' size=2 value='<?php print $fm ?>' name='fm' /><br /><br />
<br>
<script>buttonMagicSubmitVATEL('<?php print VALIDER ?>','okannee','ok')</script>
</ul>
<br>
</font>
<BR><br>
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