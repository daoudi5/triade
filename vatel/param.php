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
			<span class="vat-capitalize-title"><?php print LANGVATEL85 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param9.php' ><?php print "Menu" ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>
	
		<script language="JavaScript" src="../librairie_js/verif_creat.js"></script>

		
		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
		
<?php
validerequete("menuadmin");

if (isset($_GET["suppsite"])) {
	suppr_param($_GET["suppsite"]);
}

if (isset($_POST["create"])){
	$cr=create_param($_POST["saisie_nom"],$_POST["saisie_adresse"],$_POST["saisie_postal"],$_POST["saisie_ville"],$_POST["saisie_tel"],$_POST["saisie_mail"],$_POST["saisie_directeur"],$_POST["saisie_urlsite"],$_POST["saisie_accademie"],$_POST["saisie_pays"],$_POST["saisie_departement"],$_POST["anneeScolaire"],$_POST["idsite"]);
	if($cr == 1){
		alertJs(LANGPARAM16);
		history_cmd($_SESSION["nom"],"MODIFICATION","Adresse etablissement ".$_POST["saisie_nom"]);
	}
}

$id=0;
if (isset($_POST["idsite"])) $id=$_POST["idsite"];


if (verifSiInfoParamSaisie() == 0) {
	print "<br><center><font id='color3' class='T2'>".LANGMESST390."</font></center><br>";
	$id='1';
}

$data=visu_param_id($id);
// nom_ecole,adresse,postal,ville,tel,email,directeur,urlsite,academie,pays,departement,$anneeScolaire
for($i=0;$i<count($data);$i++) {
	$nom_etablissement=trim($data[$i][0]);
	$adresse=trim($data[$i][1]);
	$postal=trim($data[$i][2]);
	$ville=trim($data[$i][3]);
	$tel=trim($data[$i][4]);
	$mail=trim($data[$i][5]);
	$directeur_etablissement=trim($data[$i][6]);
	$urlsite=trim($data[$i][7]);
	$accademie=trim($data[$i][8]);
	$pays=trim($data[$i][9]);
	$departement=trim($data[$i][10]);
	$anneeScolaire=trim($data[$i][11]);
	$id=$data[$i][12];
}

$disabled="disabled='disabled'";
if ($id != 0) {
	$disabled="";
}
?>
<BR>
<img src="../image/commun/etablissement.png" align='left' />
<form method='post'>
&nbsp;&nbsp;&nbsp;<font class='T2'><?php print LANGMESS159 ?> &nbsp;:&nbsp; <select name='idsite' onChange='this.form.submit()' >
<option value='0' id='select0'  ><?php print LANGMESS160 ?></option>
<?php select_site($id) ?>
</select> 
</form>
<hr>
<form method='post' onsubmit="return verifadresse()" name="formulaire" >
<TABLE border=0 align=center>
<tr>
<td align="right"><font class="T2"><?php print preg_replace('/ /','&nbsp;',LANGPARAM7) ?> &nbsp;:&nbsp;</font></td>
<td><input type=text name="saisie_directeur" value="<?php print $directeur_etablissement?>" size=33 maxlength=30></td>
</tr>

<tr>
<td align="right"><font class="T2"><?php print LANGMESS144 ?> &nbsp;:&nbsp;</font></td>
<td><input type=button onclick="open('signaturedirecteur.php?id=<?php print $id ?>','logo','width=400,height=200')" value="<?php print CLICKICI?>" class='bouton2' <?php print $disabled ?> ></td>
</tr>


<tr>
<td align="right"><font class="T2"><?php print LANGPARAM8 ?> &nbsp;:&nbsp;</font></td>
<td><input type=text name="saisie_nom" value="<?php print $nom_etablissement?>" size=33 maxlength=30> * </td>
</tr>

<tr>
<td align="right"><font class="T2"><?php print LANGPARAM37 ?> &nbsp;:&nbsp;</font></td>
<td><input type=text name="saisie_accademie" value="<?php print $accademie?>" size=33 maxlength=50></td>
</tr>

<tr>
<td align="right"><font class="T2"><?php print LANGMESS145 ?> &nbsp;:&nbsp;</font></td>
<td>
<select name='anneeScolaire'>
<?php 
include_once("../librairie_php/timezone.php");
$annee=dateY();
$anneemoins=$annee - 1 ;
$anneeplus=$annee + 1 ;
if ($anneeScolaire != "") {
	print "<option value='$anneeScolaire'  id='select1'  >$anneeScolaire</option>";
}else{
	print "<option value=''id='select0' >".LANGCHOIX."</option>";
}
?>
<option id='select1' value='<?php print "$anneemoins - $annee"?>'><?php print "$anneemoins - $annee"?></option>
<option id='select1' value='<?php print "$annee - $anneeplus"?>'><?php print "$annee - $anneeplus"?></option>
</select>
</td>
</tr>

<tr>
<td align="right" valign="top"><font class="T2"><?php print LANGPARAM9?>  &nbsp;:&nbsp;</font></td>
<td><textarea name="saisie_adresse" cols="40" rows="2"><?php print $adresse?></textarea> * </td>
</tr>

<tr>
<td align="right"><font class="T2"><?php print LANGPARAM10?> &nbsp;:&nbsp;</font></td>
<td><input type=text name="saisie_postal" value="<?php print $postal?>" size=7 maxlength=7> * </td>
</tr>

<tr>
<td align="right"><font class="T2"><?php print LANGPARAM11?> &nbsp;:&nbsp;</font></td>
<td><input type=text name="saisie_ville" value="<?php print $ville?>" size=33 maxlength=30> * </td>
</tr>

<tr>
<td align="right"><font class="T2"><?php print LANGMESS177 ?> &nbsp;:&nbsp;</font></td>
<td><input type=text name="saisie_departement" value="<?php print $departement ?>" size=33 maxlength=50> * </td>
</tr>

<tr>
<td align="right"><font class="T2"><?php print LANGMESS156 ?> &nbsp;:&nbsp;</font></td>
<td><input type=text name="saisie_pays" value="<?php print $pays?>" size=33 maxlength=30> * </td>
</tr>

<tr>
<td align="right"><font class="T2"><?php print LANGPARAM12?> &nbsp;:&nbsp;</font></td>
<td><input type=text name="saisie_tel" value="<?php print $tel?>" size=33 maxlength=30></td>
</tr>

<tr>
<td align="right"><font class="T2"><?php print LANGPARAM13?> &nbsp;:&nbsp;</font></td>
<td><input type=text name="saisie_mail" value="<?php print $mail?>" size=33 maxlength=50></td>
</tr>

<tr>
<td align="right"><font class="T2"><?php print LANGPARAM34 ?> &nbsp;:&nbsp;</font></td>
<td><input type=text name="saisie_urlsite" value="<?php print $urlsite?>" size=33 ></td>
</tr>


<tr>
<td align="right"><font class="T2"><?php print LANGPARAM14?>&nbsp;:&nbsp;</font></td>
<td><input type=button onclick="open('logoetablissement.php?id=<?php print $id ?>','logo','width=400,height=200')" value="<?php print CLICKICI?>" class='bouton2' <?php print $disabled ?> ></td>
</tr>




<tr><td colspan=2 align=center>
<br><br><table align=center border=0><tr><td>
<script language=JavaScript>buttonMagicSubmitIdDivVATEL("<?php print LANGPARAM15?>",'create','ok','bt1','0')</script>
<?php 
if (($id != 1) && ($id != 0)) {
	print "<script language=JavaScript>buttonMagicVATEL('".LANGMESST391."','param.php?suppsite=$id','_self','','')</script>";
}
?>
</td><tr></table>
</td></tr>


</table>
<?php 
if ((LAN == "oui") && ($ville != "") && ($adresse != "") && ($pays != "")){
	$adresse=ereg_replace("\r\n"," ",$adresse);
	if (HTTPS == "oui") {
?>
		<br /><center>
		<iframe src="http://support.triade-educ.com/support/google-map-V3-triade.php?etablissement=<?php print  urlencode($nom_etablissement)?>&adresse=<?php print urlencode($adresse) ?>&ville=<?php print urlencode($ville) ?>&pays=<?php print urlencode($pays)?>&web=<?php print urlencode($urlsite) ?>" width=400 height=300 MARGINWIDTH=0 MARGINHEIGHT=0 HSPACE=0 VSPACE=0 FRAMEBORDER=0 SCROLLING=no ></iframe >
		</center>
	<?php }else{ ?>
		<br /><center>
		<iframe src="http://support.triade-educ.com/support/google-map-V3-triade.php?etablissement=<?php print  urlencode($nom_etablissement)?>&adresse=<?php print urlencode($adresse) ?>&ville=<?php print urlencode($ville) ?>&pays=<?php print urlencode($pays)?>&web=<?php print urlencode($urlsite) ?>" width=400 height=300 MARGINWIDTH=0 MARGINHEIGHT=0 HSPACE=0 VSPACE=0 FRAMEBORDER=0 SCROLLING=no ></iframe >
		</center>

	<?php } 
} ?>
<BR><br/>
<!-- // fin  -->
<input type='hidden' name='idsite' value='<?php print $id ?>'  >
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