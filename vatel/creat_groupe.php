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
			<span class="vat-capitalize-title"><?php print LANGVATEL75 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param8.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a href='liste_groupe.php' ><?php print LANGBT12 ?></a></li>
				<li style="visibility:visible" ><a href='suppression_groupe.php' ><?php print LANGGRP44 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

		<script language="JavaScript" src="../librairie_js/verif_creat.js"></script>

<?php		
$sql_ngrp="SELECT trim(libelle) FROM ${prefixe}groupes ORDER by 1";
$res=execSql($sql_ngrp);
// on génère un tableau bidim JavaScript
// nommé liste_grp qui servira à la
// fonction JavaScript verif_nom_grp(mat)
// pour vérifier que le nom de groupe
// saisi n'existe pas déjà -> cf. <input name="saisie_intitule ...>
genMatJs("liste_grp",chargeMat($res));
?>
<script language="JavaScript">
// mettre en librairie
function verif_nom_grp(mat) {
	for(i=0;i<mat.length;i++) {
		if ((mat[i][0] == document.formulaire.saisie_intitule.value) && (document.formulaire.saisie_intitule.value != "")){
			alert("<?php print LANGGRP46 ?>");
			document.formulaire.saisie_intitule.focus();
			document.formulaire.saisie_intitule.select();
			document.formulaire.rien.disabled=true;
			return false;
		}else{
			document.formulaire.rien.disabled=false;
		}
	}
return true;
}

function verif_nom_grp2(mat) {
	for(i=0;i<mat.length;i++) {
		if ((mat[i][0] == document.formulaire2.saisie_intitule.value) && (document.formulaire2.saisie_intitule.value != "")){
			alert("<?php print LANGGRP46 ?>");
			document.formulaire2.saisie_intitule.focus();
			document.formulaire2.saisie_intitule.select();
			document.formulaire2.rien.disabled=true;
			return false;
		}else{
			document.formulaire2.rien.disabled=false;
		}
	}
return true;
}

</script>

<form method=post onsubmit='return validecreatgroupe()' name="formulaire" action='./creat_groupe_suite.php' >

<table>
<tr><td><font class=T2><?php print LANGGRP1?> : </font> <input onChange="return verif_nom_grp(liste_grp);" type=text name='saisie_intitule' size='15' maxlength='30' ></td><td>&nbsp;&nbsp;<script language=JavaScript>buttonMagicVATEL("<?php print LANGGRP50 ?>","modifier_groupe.php","_parent","","");</script></td></tr></table>
<br>
<font class="T2"><?php print LANGBULL3?> : </font><select name="annee_scolaire" size="1">
<?php
filtreAnneeScolaireSelectNote('',3); // creation des options
?>
</select>
<br>
<BR><font class='T2 shadow'><b><?php print LANGGRP2?></b></font><BR><BR></UL>
<center>
<table width=100% border=0>
<TR><TD>&nbsp;&nbsp;
<select align=top name="saisie_liste[]" size=6  style="width:120px" multiple="multiple">
<?php
select_classe(); // creation des options
?>
</select>
</TD>
<TD valign=top align=center>
<TABLE border="1" width=80% bordercolor="#000000">
<TR><TD bgcolor="#FFFFFF" bordercolor="#000000" >
&nbsp;&nbsp;<?php print LANGGRP3?> <font color=red><B><?php print LANGGRP4?></b></font> <?php print LANGGRP5?><BR>  <BR>
</td></tr>
</table>
</TD></TR></TABLE></center>
<BR><BR><UL>
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGBT13?>","rien"); //text,nomInput</script>
</form>
</ul>
<hr>
<ul>
<form method=post  action='./creat_groupe_import.php' name="formulaire2" ENCTYPE="multipart/form-data" onsubmit='return validecreatgroupe3()'>
<font class=T2><?php print LANGGRP1?> :  <input onChange="return verif_nom_grp2(liste_grp);" type='text' name='saisie_intitule' size='35' maxlength='30' ><BR>
<br>
<font class="T2"><?php print LANGBULL3?> : </font><select name="annee_scolaire" size="1">
<?php
filtreAnneeScolaireSelectNote('',3); // creation des options
?>
</select>
<br>

<br /><?php print LANGMESS353 ?> : <input type="file" name="fichier" size=30 >

<br><br><script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGGRP45 ?>","rien"); //text,nomInput</script>
</form>
<br /><br />
</ul>
<ul><?php print LANGMESS354 ?>&nbsp;:&nbsp;
<!-- //$nom,$pren,$mdp,$tp,$civ,$pren2='',$adr,$codepostal,$tel,$mail,$commune -->
        &nbsp;1)&nbsp;<?php print LANGIMP48?>&nbsp;
        &nbsp;2)&nbsp;<?php print LANGIMP46?>&nbsp;
		<?php $t1=LANGELE10; ?>
	    &nbsp;3)&nbsp;<?php print preg_replace('/ /','&nbsp;',$t1) ?>&nbsp;
</ul>
		
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