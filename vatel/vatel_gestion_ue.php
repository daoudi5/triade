<?php
/***************************************************************************
 *                              T.R.I.A.D.E
 *                            ---------------
 *
 *   begin               &nbsp;:&nbsp; Janvier 2000
 *   copyright           &nbsp;:&nbsp; (C) 2000 E. TAESCH - T. TRACHET - 
 *   Site                &nbsp;:&nbsp; http://www.triade-educ.com
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
$cnx=cnx2();

// Sn&nbsp;:&nbsp; variable de Session nom
// Sp&nbsp;:&nbsp; variable de Session prenom
// Sm&nbsp;:&nbsp; variable de Session membre
// Spid&nbsp;:&nbsp; variable de Session pers_id
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
			<span class="vat-capitalize-title"><?php print LANGVATEL113 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param9.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a href='vatel_creat_ue.php' ><?php print LANGMESS223 ?></a></li>
				<li style="visibility:visible" ><a href='vatel_gestion_ue.php?copy' ><?php print LANGVATEL112 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
<br>
<?php
if (isset($_POST["copy"])) {
	$saisie_classe_source=$_POST["saisie_classe_source"];
	$anneeScolaireSource=$_POST["anneeScolaireSource"];
	$saisie_classe_destination=$_POST["saisie_classe_destination"];
	$anneeScolaireDest=$_POST["anneeScolaireDest"];
	copyUniteEnseignement($saisie_classe_source,$anneeScolaireSource,$saisie_classe_destination,$anneeScolaireDest);
	print "<br><br><center><font class='T2'>".LANGDONENR."</font></center><br><br>";
}

if (isset($_GET["copy"])) { ?>
<form method='post' action='vatel_gestion_ue.php' >
<font class='T2 shadow' id='color3' >IMPORTANT, LA COPIE D'UNITE ENSEIGNEMENT SUPPRIME L'ANCIENNE VERSION  !!</font>
<BR>
<BR>
<font class='T2'>Copier l'unit&eacute; d'enseignement de la classe :
<select name="saisie_classe_source">
<option value=0  id='select0' ><?php print LANGCHOIX?></option>
<optgroup label="Classe">
<?php
select_classe(); // creation des options
?>
</select> de l'ann&eacute;e scolaire : <select name='anneeScolaireSource'>
<?php
print "<option value=''id='select0' >".LANGCHOIX."</option>";
filtreAnneeScolaireSelectNote($anneeScolaire,3);
?>
</select>

<br><br>pour la classe :
<select name="saisie_classe_destination">
<option value=0  id='select0' ><?php print LANGCHOIX?></option>
<optgroup label="Classe">
<?php
select_classe(); // creation des options
?>
</select>
de l'ann&eacute;e scolaire : 
<select name='anneeScolaireDest'>
<?php
print "<option value=''id='select0' >".LANGCHOIX."</option>";
filtreAnneeScolaireSelectNote($anneeScolaire,3);
?>
</select>
<br><br>
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print 'Valider la copie' ?>","copy"); //text,nomInput</script>
<br><br>
</form>

<?php } ?>

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
