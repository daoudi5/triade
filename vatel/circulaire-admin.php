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
			<span class="vat-capitalize-title"><?php print LANGASS24 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='circulaire-admin.php' ><?php print LANGVATEL21 ?></a></li>
				<li style="visibility:visible" ><a href='supprimercirculaire.php' ><?php print LANGVATEL23 ?></a></li>
				<li style="visibility:visible" ><a href='visucirculaire.php' ><?php print LANGVATEL24 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

<?php
validerequete("menuadmin");
$fichier="";
if (isset($_GET["idcirculaire"])) {
	$idcirculaire=$_GET["idcirculaire"];
	$data=chercheCirculaire($idcirculaire); //id_circulaire,sujet,refence,file,date,enseignant,classe,idprofp,comptepersonnel,compteviescolaire,comptedirection,comptetuteurdestage
	$id_circulaire=$data[0][0];
	$sujet=htmlentities($data[0][1]);
	$reference=htmlentities($data[0][2]);
	$fichier=$data[0][3];
	$enseignant=$data[0][5];
	$classe=$data[0][6];
	$idprofp=$data[0][7];
	$comptepersonnel=$data[0][8];
	$compteviescolaire=$data[0][9];
	$comptedirection=$data[0][10];
	$comptetuteurdestage=$data[0][11];
	$categorie=$data[0][12];
}

?>
<!-- // fin  -->
<form method=post  action='./circulaire_ajout2.php' name=formulaire ENCTYPE="multipart/form-data">
<table  width=100%  border="0" align="center" >
<tr  >
<td align="right" width=40%><font class="T2"><?php print LANGCIRCU6 ?> :</font>&nbsp;</TD>
<TD align="left"><input type="text" name="saisie_titre" size=30 maxlength=28 value="<?php print $sujet ?>" ></td>
</tr>
<tr  >
<td align="right"><font class="T2"><?php print LANGCIRCU7 ?> :</font>&nbsp;</TD>
<TD align="left"><input type="text" name="saisie_ref" size=30 maxlength=28 value="<?php print $reference ?>" ></td>
</tr>
<tr  >
<td align="right"><font class="T2"><?php print LANGDISC20 ?> :</font>&nbsp;</TD>
<TD align="left"><input type="text" name="saisie_cat" size=30 maxlength=200 value="<?php print $categorie ?>" ></td>
</tr>
<tr>
<td align="right"  ><font class="T2"><?php print LANGCIRCU8 ?> :</font>&nbsp;</TD>
<TD  align="left">
<?php 
if ($fichier != "") {
	print " $fichier ";

}else{ ?>
	<input type="file" name="fichier" size=30 >
	<?php 
	if (UPLOADIMG == "oui") {
		$taille="8Mo";
	}else{
		$taille="2Mo";
	}
}

$mess=LANGCIRCU11." (Taille max : $taille) ";


?>

</td>
    </tr>
<tr  >
	<td align="right"><font class="T2"><?php print LANGVATEL48 ?> :</font>&nbsp;</TD>
	<TD align="left"><input type="checkbox" name="envoimessage" value="oui" > <i>(<?php print LANGOUI ?>)</i></td>
</tr>

    <tr>
      <td width=35% align="right"  ><font class="T2"><?php print LANGCIRCU9 ?> :</font>&nbsp;</TD>
<?php
if ($enseignant == 1) { $checkedProf="checked='checked'"; }else{  $checkedProf=""; } 
?>
      <TD  align="left"><input type="checkbox" name="saisie_envoi_prof" id="btradio1" value="1" <?php print $checkedProf ?> > <A href='#' onMouseOver="AffBulle3('<?php print $information ?>','./image/commun/info.jpg','<?php print $mess?>'); window.status=''; return true;" onMouseOut='HideBulle()'><img src='./image/help.gif' align=center width='15' height='15'  border=0></A>
      </td>
    </tr>
<?php if ($comptepersonnel == 1) { $checkedpersonnel="checked='checked'"; }else{  $checkedpersonnel=""; }  ?>

<tr>
      <td width=35% align="right"  ><font class="T2"><?php print LANGVATEL249 ?> :</font>&nbsp;</TD>
      <TD align="left"><input type="checkbox" name="saisie_envoi_pers" id="btradio1" value="1" <?php print $checkedpersonnel ?> ></td>
</tr>
<?php if ($compteviescolaire == 1) { $checkedviescolaire="checked='checked'"; }else{  $checkedviescolaire=""; } ?>

<tr>
      <td width=35% align="right"  ><font class="T2"><?php print LANGVATEL250 ?> :</font>&nbsp;</TD>
      <TD align="left"><input type="checkbox" name="saisie_envoi_mvs" id="btradio1" value="1" <?php print $checkedviescolaire ?> ></td>
</tr>

<?php if ($comptetuteurdestage == 1) { $checkedtuteurdestage="checked='checked'"; }else{  $checkedtuteurdestage=""; } ?>

<tr>
      <td width=35% align="right"  ><font class="T2"><?php print LANGVATEL251 ?> :</font>&nbsp;</TD>
      <TD align="left"><input type="checkbox" name="saisie_envoi_tut" id="btradio1" value="1" <?php print $checkedtuteurdestage ?>  ></td>
</tr>

<?php $checkeddirection="checked='checked'"; if ($comptedirection == 1) { $checkeddirection="checked='checked'"; }else{ $checkeddirection=""; } ?>

<tr>
      <td width=35% align="right"  ><font class="T2"><?php print LANGVATEL252 ?> :</font>&nbsp;</TD>
      <TD align="left"><input type="checkbox" name="saisie_envoi_dir" id="btradio1" value="1" <?php print $checkeddirection ?> ></td>
</tr>

    <tr>
      <td  align="right" valign=top><font class="T2"><?php print LANGVATEL253 ?> : </font>&nbsp;</td>
      <TD  align="left">
<?php

$data=affclasse();
// $classe {XX,YY,..}
$liste_classe=preg_replace('/{/','',$classe);
$liste_classe=preg_replace('/}/','',$liste_classe);
$dataClasse=explode(",",$liste_classe);
?>
<SCRIPT LANGUAGE=JavaScript>
nbcase="<?php print count($data)?>";
nbcase+=4;
function tout() {
	for (i=10;i<=nbcase;i++) {
                document.formulaire.elements[i].checked=true;
	}
}
</SCRIPT>
<?php
$j=0;
for($i=0;$i<count($data);$i++){
	if ($j == 4 ) { $j=0; print "<br/>"; }
	$checked="";
	foreach($dataClasse as $key=>$value) {
		if ($value==$data[$i][0]) {
			$checked="checked='checked'";
			break;
		}
    }
    print "<div style='float:left;width:150px' ><input type=checkbox  id='btradio1'  name='saisie_classe[]' value='".$data[$i][0]."' $checked />".trim($data[$i][1])."</div>";
    $j++;
}
?>
<br>
<BR><div align=right><a HREF="#" onclick="tout();"><?php print LANGCIRCU13?></a></DIV>
<br>
</td>
</tr></table><BR>
<table align=center><tr><td>
<?php if ($idcirculaire != "") { ?>
	<input type=hidden name="id_circulaire" value="<?php print $id_circulaire ?>" />
	<input type='submit' value="<?php print "Modifier"?>" name="modif" class="btn btn-primary btn-sm  vat-btn-footer" />
<?php }else{ ?>
	<input type='submit' value="<?php print LANGCIRCU15?>" name="rien" class="btn btn-primary btn-sm  vat-btn-footer" />
<?php } ?>
</td></tr></table>
</form>
<BR>
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
