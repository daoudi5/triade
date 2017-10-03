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

if (isset($_GET["type"])) $type=$_GET["type"]; 
if (isset($_POST["type"])) $type=$_POST["type"]; 

if ($type == "TUT") $typecompte=LANGMESS180;
if ($type == "ENS") $typecompte=LANGVATEL60;
if ($type == "ADM") $typecompte=LANGVATEL58;
if ($type == "MVS") $typecompte=LANGTITRE7;

$saisie_id=$_GET["saisie_id"];

if (isset($_POST["modif"])){
	$cr=modif_personnel($_POST["id_pers"],$_POST["saisie_creat_nom"],$_POST["saisie_creat_prenom"],$_POST["saisie_intitule"],$_POST["saisie_creat_adr"],$_POST["saisie_creat_code"],$_POST["saisie_creat_tel"],$_POST["saisie_creat_mail"],$_POST["saisie_creat_commune"],$_POST["saisie_creat_tel_port"],$_POST["id_societe"],'',$_POST["saisie_indice_salaire"]);
	if($cr == 1){
		alertJs(LANGMODIF14);
		history_cmd($_SESSION["nom"],"MODIFICATION"," de $_POST[saisie_creat_nom]");
	}
	$saisie_id=$_POST["id_pers"];
}else{
	$saisie_id=$_GET["saisie_id"];
}

$btsubmit=LANGBT7;
$btsubmit0="create";
if ($saisie_id > 0) {
	$btsubmit=LANGMODIF13;
	$btsubmit0="modif";
	$passage_argument="oui"; // pour le JavaScript
	// soit 0 ou 1 ou 2 PAS DE M. ni Mme ni Mme
	$data=recherche_personne_modif($saisie_id);
	// pers_id,nom,prenom,mdp,civ,email,adr,code_post,commune,tel,tel_port,identifiant,offline,id_societe_tuteur,pays,indice_salaire,qualite
	$nom_admin=trim($data[0][1]);
	$prenom_admin=trim($data[0][2]);
	$passwd_admin=trim($data[0][3]);
	$intitule_admin=$data[0][4];
	$mail=trim($data[0][5]);
	$adr=trim($data[0][6]);
	$code_post=trim($data[0][7]);
	$commune=trim($data[0][8]);
	$tel=trim($data[0][9]);
	$telPort=trim($data[0][10]);
	$idsociete=$data[0][13];
	$pays=trim($data[0][14]);
	$indice_salaire=trim($data[0][15]);
	$qualite=trim($data[0][16]);
	$civ=$data[0][4];
	
}


if ($type == "TUT") $titre=LANGVATEL59;
if ($type == "ENS") $titre=LANGVATEL267;
if ($type == "ADM") $titre=LANGVATEL61;
if ($type == "MVS") $titre=LANGVATEL62;

if ($type == "TUT") $titre2=LANGVATEL268;
if ($type == "ENS") $titre2=LANGVATEL268;
if ($type == "ADM") $titre2=LANGVATEL268;
if ($type == "MVS") $titre2=LANGVATEL268;
?>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print $typecompte ?></span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param8.php' ><?php print "Menu" ?></a></li>
				<li style="visibility:visible" ><a href='param8compte.php?type=<?php print $type ?>' ><?php print LANGASS8 ?></a></li>
				<li style="visibility:visible" ><a href='param8compteModif.php?type=<?php print $type ?>' ><?php print $titre  ?></a></li>
				<li style="visibility:visible" ><a href='param8compteSupp.php?type=<?php print $type ?>' ><?php print $titre2  ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

<div style="width:100%;background-color:#F4F5F7">
<section class="container" style="padding-top:10px">

<form method="post" action="param8compte.php" >

<fieldset><legend><?php print LANGMODIF5 ?></legend>

<table border='0' cellpadding="2" cellspacing="2" >
<tr><td align=right width='1%' ><font class="T2"><?php print LANGMESS178 ?>&nbsp;</td><td>&nbsp;<select name="saisie_intitule" > 
<?php
if ($saisie_id > 0) { ?>
	<option value='<?php print $intitule_admin ?>' ><?php print civ($intitule_admin) ?></option>
<?php } ?>
<?php listingCiv() ?>
</select></td></tr>
<tr><td align=right width=40%><font class="T2"><?php print LANGNA1?>&nbsp;:&nbsp;</font></td><td>&nbsp;<input type=text name="saisie_creat_nom"  size=33  maxlength=30 value="<?php print $nom_admin ?>" >&nbsp;<font id='color2' ><b>*</b></font> </td></tr>
<tr><td align=right><font class="T2"><?php print LANGNA2?>&nbsp;:&nbsp;</font></td><td>&nbsp;<input type=text name="saisie_creat_prenom" size=23  maxlength=30 value="<?php print $prenom_admin ?>" >&nbsp;<font id='color2' ><b>*</b></font>
<img src='../image/help.gif' align=center title="<?php print LANGVATEL57 ?>" >
</td></tr>
<tr><td align=right><font class="T2"><?php print LANGNA3?>&nbsp;:&nbsp;</font></td><td>&nbsp;
<?php if ($saisie_id > 0) { ?>
	<input type=button onclick="open('./modif_pers_pass.php?id=<?php print $saisie_id;?>&type=<?php print $type?>','pass','width=450,height=400')" value='<?php print LANGPER30 ?>'  class="btn btn-primary btn-sm  vat-btn-footer"   >
<?php }else{ ?>
	<input type=text name="saisie_creat_password"  size=23 maxlength=50 >&nbsp;<font id='color2' ><b>*</b></font>
<?php 
}
$affiche=affichageMessageSecurite();
$txt2=ereg_replace("<b>","",$affiche);
$txt2=ereg_replace("</b>","",$txt2);
$txt2=ereg_replace("<br />","",$txt2);
?>
<img src='../image/help.gif' align=center title="<?php print strip_tags($affiche) ?>" ></td></tr>

<?php if ($type == "TUT") { ?>
<tr><td align=right><font class="T2"><?php print LANGMESS183 ?>&nbsp;:&nbsp;</font></td>
<td>&nbsp;<select name='id_societe' >
<?php
if ($saisie_id > 0) {
	select_recherche_entreprise(25,$idsociete);
	print "<option id='select0' value='0' >".LANGbasededon33."</option>";
	select_entreprise_limit(25);
}else{
?>
	<option STYLE='color:#000066;background-color:#FCE4BA' value='0' ><?php print LANGCHOIX ?></option>
<?php
	select_entreprise_limit(25);
}
?>
</select>
</td></tr>
<tr><td align=right><font class="T2"><?php print LANGMESS184 ?>&nbsp;:&nbsp;</font></td><td>&nbsp;<input type=text name="saisie_qualite" size=33 maxlength=100 value="<?php print $qualite ?>" ></td></tr>
<?php } ?>
</table></fieldset>



<br><br><br>
<fieldset><legend><?php print LANGMODIF7 ?></legend>
<TABLE border='0' cellpadding="2" cellspacing="2">
<tr><td align=right><font class="T2"><?php print LANGMODIF8 ?>&nbsp;:&nbsp;</font></td><td>&nbsp;<input value="<?php print $adr ?>" type=text name="saisie_creat_adr" size=33 maxlength=100></td></tr>
<tr><td align=right><font class="T2"><?php print LANGMODIF9 ?>&nbsp;:&nbsp;</font></td><td>&nbsp;<input value="<?php print $code_post ?>" type=text name="saisie_creat_code" size=33 maxlength=15></td></tr>
<tr><td align=right><font class="T2"><?php print LANGMODIF10 ?>&nbsp;:&nbsp;</font></td><td>&nbsp;<input value="<?php print $commune ?>" type=text name="saisie_creat_commune" size=33 maxlength=40></td></tr>
<tr><td align=right><font class="T2"><?php print LANGAGENDA73 ?>&nbsp;:&nbsp;</font></td><td>&nbsp;<input value="<?php print $pays ?>" type=text name="saisie_pays" size=33 maxlength=50></td></tr>
<tr><td align=right><font class="T2"><?php print LANGMODIF11 ?>&nbsp;:&nbsp;</font></td><td>&nbsp;<input value="<?php print $tel ?>" type=text name="saisie_creat_tel" size=33 maxlength=18></td></tr>
<tr><td align=right><font class="T2"><?php print LANGAGENDA76 ?>&nbsp;:&nbsp;</font></td><td>&nbsp;<input value="<?php print $telPort ?>" type=text name="saisie_creat_tel_port" size=33 maxlength=18></td></tr>
<tr><td align=right><font class="T2"><?php print LANGMODIF12 ?>&nbsp;:&nbsp;</font></td><td>&nbsp;<input value="<?php print $mail ?>" type=text name="saisie_creat_mail" size=33 maxlength=150></td></tr>
<!-- <tr><td align=right><font class="T2"><?php print LANGMESS179 ?>&nbsp;:&nbsp;</font></td><td>&nbsp;<input value="<?php print $indice_salaire ?>" type=text name="saisie_indice_salaire" size=33 maxlength=150></td></tr> -->
</TABLE>
</fieldset>
<br><br>
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print $btsubmit ?>","<?php print $btsubmit0 ?>"); //text,nomInput</script>
<BR>
<input type='hidden' name="type" value="<?php print $_GET["type"] ?>" />
<input type=hidden name=id_pers value="<?php print $saisie_id?>" >
</form>
		</section>
		</div>
		</div>
	</div>
<?php

if(isset($_POST["create"])){
	if ($_POST["saisie_creat_prenom"] == "inconnu") {
		$prenom=" ";
	}else{
		$prenom=$_POST["saisie_creat_prenom"];
	}
    	$cr=create_personnel($_POST["saisie_creat_nom"],$prenom,$_POST["saisie_creat_password"],$_POST["type"],$_POST["saisie_intitule"],'',$_POST["saisie_creat_adr"],$_POST["saisie_creat_code"],$_POST["saisie_creat_tel"],$_POST["saisie_creat_mail"],$_POST["saisie_creat_commune"],$_POST["saisie_creat_tel_port"],$_POST["id_societe"],$_POST["saisie_pays"],$_POST["saisie_indice_salaire"],$_POST["saisie_qualite"]);
   	if($cr == 1) {
            alertJs(LANGNA4);
    	}else if ($cr == -3) {
	    		$affiche=affichageMessageSecurite2();	
			alertJs($affiche);
	}else if ($cr == -1) {
			alertJs(LANGCREAT1);
	}else {
           alertJs(LANGPASSG3);
    }
}


Pgclose();
include_once("piedpage.php");
include_once("connexionEnCours.php");
?>
</body>
</html>
