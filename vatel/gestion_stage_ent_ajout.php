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
<script language="JavaScript" src="../librairie_js/ajax-stage.js"></script>
<script language="JavaScript" src="../librairie_js/verif_creat.js"></script>
<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL226 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param13.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a href='gestion_stage_ent_visu.php' ><?php print LANGVATEL225 ?></a></li>
				<li style="visibility:visible" ><a href='gestion_stage_ent_ajout.php' ><?php print LANGASS8 ?></a></li>
				<li style="visibility:visible" ><a href='' ><?php print LANGMESS149 ?></a></li>
				<li style="visibility:visible" ><a href='' ><?php print LANGASS10 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

<?php

if (isset($_GET["lien"])) {
	$lien=$_GET["lien"];
	$lienideleve=$_GET["lienideleve"];
	$lienidclasse=$_GET["lienidclasse"];
	$lienretour="$lien?id=$lienideleve&idclasse=$lienidclasse";
}
if (isset($_POST["create"])) {
	$cr=create_entreprise($_POST["nomentreprise"],$_POST["contact"],$_POST["adressesiege"],$_POST["codepostal"],$_POST["ville"],$_POST["activite"],$_POST["activiteprin"],$_POST["tel"],$_POST["fax"],$_POST["email"],$_POST["information"],$_POST["activite2"],$_POST["activite3"],$_POST["fonction"],$_POST["nbchambre"],$_POST["siteweb"],$_POST["grphotelier"],$_POST["nbetoile"],$_POST["pays"],$_POST["registrecommerce"],$_POST["siren"],$_POST["siret"],$_POST["formejuridique"],$_POST["secteureconomique"],$_POST["INSEE"],$_POST["NAFAPE"],$_POST["NACE"],$_POST["typeorganisation"],$_POST["qualite"]);
	if($cr == 1){
		history_cmd($_SESSION["nom"],"CREATION","ENTREPRISE STAGE");
		alertJs(LANGSTAGE58);
	}else {
		$erreur=LANGSTAGE25.".<br><br>";
	}
	$lien=$_POST["lien"];
	$lienideleve=$_POST["ideleve"];
	$lienidclasse=$_POST["idclasse"];
	$lienretour="$lien?id=$lienideleve&idclasse=$lienidclasse";

}
?>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;<font class="T2" color="red"><?php print $erreur ?></a>

<form method="post" name="formulaire">
<table width="100%" border="0" align="center" >

<tr>
<td align="right" ><font class="T2"><?php print LANGSTAGE26 ?> &nbsp;:&nbsp;</font></td><td><input type="text" name="nomentreprise" size=30 maxlength="50" onblur="verifentreprise(this.value)" > <span id="verifent"></span></td>
</tr>

<?php 
if (defined("VATEL")) $vatel=VATEL;

if ($vatel != "1") { ?>

<tr>
<td align="right" ><font class="T2"><?php print "Registre du commerce" ?> &nbsp;:&nbsp;</font></td><td><input type="text" name="registrecommerce" size=30 maxlength="100" ></td>
</tr>
<tr>
<td align="right" ><font class="T2"><?php print "SIREN" ?> &nbsp;:&nbsp;</font></td><td><input type="text" name="siren" size=30 maxlength="100" ></td>
</tr>
<tr>
<td align="right" ><font class="T2"><?php print "SIRET" ?> &nbsp;:&nbsp;</font></td><td><input type="text" name="siret" size=30 maxlength="100" ></td>
</tr>
<tr>
<td align="right" ><font class="T2"><?php print "Forme juridique" ?> &nbsp;:&nbsp;</font></td><td>	<select name="formejuridique">
											<option value='' id='select0' >Choix...</option>
											<option value='SA' id='select1'>SA</option>
											<option value='SARL' id='select1'>SARL</option>
											<option value='EURL' id='select1'>EURL</option>
											<option value='SNC' id='select1'>SNC</option>
											<option value='SAS' id='select1'>SAS</option>
											<option value='SASU' id='select1'>SASU</option>
											<option value='EI' id='select1'>EI</option>
											<option value='Auto-Entreprise' id='select1'>Auto-Entreprise</option>
											</select></td>
</tr>

<td align="right" ><font class="T2"><?php print "Secteur économique" ?> &nbsp;:&nbsp;</font></td><td>	<select name="secteureconomique">
											<option value='' id='select0' >Choix...</option>
											<option value='Primaire' id='select1'>Primaire</option>
											<option value='Secondaire' id='select1'>Secondaire</option>
											<option value='Tertiaire' id='select1'>Tertiaire</option>
											</select></td>
</tr>
<tr>
<td align="right" ><font class="T2"><?php print "Secteur INSEE" ?> &nbsp;:&nbsp;</font></td><td>
<select name="INSEE">
<option value='' id='select0' >Choix...</option>
<option value="EA Agriculture, sylviculture, pêche" id='select1' title="EA Agriculture, sylviculture, pêche" >EA Agriculture, sylvicult ...</option>
<option value="EB Industries agricoles et alimentaires" id='select1' title="EB Industries agricoles et alimentaires" >EB Industries agricoles ...</option>
<option value="EC Industrie des biens de consommation" id='select1' title="EC Industrie des biens de consommation" >EC Industrie des biens ...</option>
<option value="ED Industrie automobile" id='select1'  >ED Industrie automobile</option>
<option value="EE Industries des biens d'équipement" id='select1' title="EE Industries des biens d'équipement">EE Industries des biens ...</option>
<option value="EF Industries des biens intermédiaires" id='select1' title="EF Industries des biens intermédiaires" >EF Industries des biens ...</option>
<option value="EG Energie" id='select1' >EG Energie</option>
<option value="EH Construction" id='select1' >EH Construction</option>
<option value="EJ Commerce" id='select1' >EJ Commerce</option>
<option value="EK Transports" id='select1' >EK Transports</option>
<option value="EL Activités financières" id='select1' >EL Activités financières</option>
<option value="EM Activités immobilières" id='select1' >EM Activités immobilières</option>
<option value="EN Services aux entreprises" id='select1' >EN Services aux entreprises</option>
<option value="EP Services aux particuliers" id='select1' >EP Services aux particuliers</option>
<option value="EQ Éducation, santé, action sociale" id='select1' title="EQ Éducation, santé, action sociale" >EQ Éducation, santé, ...</option>
<option value="ER Administration" id='select1' >ER Administration</option>
</select>
</td>
</tr>
<tr>
<td align="right" ><font class="T2"><?php print "Code NAF/APE" ?> &nbsp;:&nbsp;</font></td><td><input type="text" name="NAFAPE" size=30 maxlength="100" ></td>
</tr>
<tr>
<td align="right" ><font class="T2"><?php print "Branche d'activité (NACE)" ?> &nbsp;:&nbsp;</font></td><td><input type="text" name="NACE" size=30 maxlength="100" ></td>
</tr>
<tr>
<td align="right" ><font class="T2"><?php print "Type d'organisation" ?> &nbsp;:&nbsp;</font></td><td><select name="typeorganisation">
											<option value='' id='select0' >Choix...</option>
											<option value='Administration' id='select1'>Administration</option>
											<option value='Association' id='select1'>Association</option>
											<option value='Entreprise' id='select1'>Entreprise</option>
											</select></td>
</tr>
<?php } ?>
<!-- <tr>
<td align="right" ><font class="T2"><?php print "Logo de l'établissement" ?> &nbsp;:&nbsp;</font></td><td><input type="file" name="logo" /></td>
<tr>
-->
<td align="right" ><font class="T2"><?php print LANGSTAGE91 ?> &nbsp;:&nbsp;</font></td><td><input type="text" name="contact" size=30 maxlength="50" ></td>
</tr>
<tr>
<td align="right" ><font class="T2"><?php print LANGSTAGE93 ?> &nbsp;:&nbsp;</font></td><td><input type="text" name="fonction" size=30 maxlength="50" ></td>
</tr>
<tr>
<td align="right" ><font class="T2"><?php print LANGSTAGE28." ".LANGSTAGE94 ?> &nbsp;:&nbsp;</font></td><td><input type="text" name="adressesiege"  maxlength="50" size=30></td>
</tr>
<tr>
<td align="right" ><font class="T2"><?php print LANGSTAGE29." ".LANGSTAGE95 ?> &nbsp;:&nbsp;</font></td><td><input type="text" name="codepostal"  maxlength="10" size=30></td>
</tr>
<tr>
<td align="right" ><font class="T2"><?php print LANGSTAGE30." ".LANGSTAGE94 ?> &nbsp;:&nbsp;</font></td><td><input type="text" name="ville"  maxlength="30" size=30></td>
</tr>
<tr>
<td align="right" ><font class="T2"><?php print LANGMESS156." ".LANGSTAGE94 ?> &nbsp;:&nbsp;</font></td><td><input type="text" name="pays" maxlength="50" size=30></td>
</tr>
<tr>
<td align="right" ><font class="T2"><?php print LANGSTAGE31 ?> &nbsp;:&nbsp;</font></td><td>
<select name="activite">
<option value="inconnu"><?php print LANGINCONNU ?></option>
<?php
$data=activite_liste();
for($i=0;$i<count($data);$i++) {
	print "<option value='".$data[$i][0]."'>".trunchaine(strtolower($data[$i][0]),20)."</option>";
}
?>
</select>
<a href="#" onclick='javascript:verifActivite();' ><img src="../image/commun/recycle.jpg" align="center" border="0" ></a> [ <a href="#" onclick="open('gestion_stage_activite_aj.php','stageact','width=400,height=100');"><?php print LANGSTAGE32 ?></a> ]
</td>
</tr>
<tr>
<tr>
<td align=right ><font class=T2><?php print LANGSTAGE31bis ?> &nbsp;:&nbsp;</font></td>
<td>
<select name=activite2>
<option value=""></option>
<?php
$data=activite_liste();
for($i=0;$i<count($data);$i++) {
	print "<option value='".$data[$i][0]."'>".trunchaine(strtolower($data[$i][0]),20)."</option>";
}
?>
</select>
<a href="#" onclick="javascript:verifActivite2()" ><img src="../image/commun/recycle.jpg" align="center" border="0" ></a> [ <a href="#" onclick="open('gestion_stage_activite_aj.php','stageact','width=400,height=100');"><?php print LANGSTAGE32 ?></a> ]
</td>
</tr>
<tr>

<tr>
<td align=right ><font class=T2><?php print LANGSTAGE31ter ?> &nbsp;:&nbsp;</font></td>
<td>
<select name=activite3>
<option value=""></option>
<?php
$data=activite_liste();
for($i=0;$i<count($data);$i++) {
	print "<option value='".$data[$i][0]."'>".trunchaine(strtolower($data[$i][0]),20)."</option>";
}
?>
</select>
<a href="#" onclick='javascript:verifActivite3();' ><img src="../image/commun/recycle.jpg" align="center" border="0" ></a> [ <a href="#" onclick="open('gestion_stage_activite_aj.php','stageact','width=400,height=100');"><?php print LANGSTAGE32 ?></a> ]
</td>
</tr>
<tr>
<td align=right ><font class=T2><?php print LANGSTAGE33 ?> &nbsp;:&nbsp;</font></td>
<td><input type=text name="activiteprin" size=30></td>
</tr>

<tr>
<td align=right ><font class=T2><?php print LANGTMESS523 ?> &nbsp;:&nbsp;</font></td>
<td><input type=text name="grphotelier" size=30></td>
</tr>
<tr>
<td align=right ><font class=T2><?php print LANGTMESS524 ?> &nbsp;:&nbsp;</font></td>
<td><input type=text name="nbetoile" size=30></td>
</tr>
<tr>
<td align=right ><font class=T2><?php print LANGTMESS525 ?> &nbsp;:&nbsp;</font></td>
<td><input type=text name="nbchambre" size=30></td>
</tr>


<tr>
<td align=right ><font class=T2><?php print LANGSTAGE34 ?> &nbsp;:&nbsp;</font></td>
<td><input type=text name="tel" size='30' /></td>
</tr>
<tr>
<td align=right ><font class=T2><?php print LANGSTAGE35 ?> &nbsp;:&nbsp;</font></td>
<td><input type=text name="fax" size='30' ></td>
</tr>
<tr>
<td align=right ><font class=T2><?php print LANGSTAGE36 ?> &nbsp;:&nbsp;</font></td>
<td><input type=text name="email" size='30' ></td>
</tr>
<tr>
<td align=right ><font class=T2><?php print "Qualit&eacute;" ?> &nbsp;:&nbsp;</font></td>
<td><input type=text name="qualite" size='30' /></td>
</tr>
<tr>
<td align=right ><font class=T2><?php print LANGTMESS526 ?> &nbsp;:&nbsp;</font></td>
<td><input type=text name="siteweb" size='30' /></td>
</tr>
<tr>
<td align=right valign=top ><font class=T2><?php print LANGSTAGE37 ?>  &nbsp;:&nbsp;</font></td>
<td><textarea name="information" cols=40 rows=4></textarea>
</td>
</tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td colspan=2 align=center><br><br>
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGENR ?>","create"); //text,nomInput</script>
</td></tr>
</table>
		
			
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