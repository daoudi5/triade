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

$saisie_tri=$_POST["saisie_tri"];
$anneeScolaire=$_POST["anneeScolaire"];

if (isset($_GET["saisie_tri"])) { $saisie_tri=$_GET["saisie_tri"]; }
if (isset($_GET["annee_scolaire"])) { $anneeScolaire=$_GET["annee_scolaire"]; }

$saisie_classe=$_POST["saisie_classe"];
if (isset($_GET["saisie_classe"])) { $saisie_classe=$_GET["saisie_classe"]; }


?>
<script language="JavaScript" src="../librairie_js/lib_affectation.js"></script>
<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL242 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param10.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a href='affectation_visu.php' ><?php print LANGVATEL243 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="85" style="border-collapse: collapse;" >
<tr id='coulBar0' ><td height="2"><div style="float:left" ><b><font   id='menumodule1' ><?php print LANGPER28?> <b><font color=red><?php $classe=chercheClasse($saisie_classe) ; print $classe[0][1]; ?></font></div>
<div align='right'  >
</b></font></b></td>
</tr>
<tr id='cadreCentral0' >
<td valign=top>
<br>
<table>
<tr>
<td>&nbsp;&nbsp;&nbsp;<font class='T2 shadow'>Ann&eacute;e Scolaire : <?php print $anneeScolaire ?></font></td></tr></table>
<br><br>
<!-- //  debut -->
<?php 
$libelle=libelleTrimestre($saisie_tri);
if (($saisie_tri != "tous") && ($saisie_tri != "")) { 
	print "<font class='T2'>&nbsp;&nbsp;&nbsp;$libelle</font>";
	print "<br /><br />"; 
}
?>



<table border='1' bordercolor=#000000" align='center' width='100%' style="border-collapse: collapse;" >
<TR bgcolor='#000000' >
<!-- importance du champ apparition ??? -->
<td align=center><font class='T22'><?php print LANGPER17?></font></td>
<td align=center><font class='T22'><?php print LANGPER18?></font></td>
<td align=center><font class='T22'><?php print LANGPER19?></font></td>
<td align=center><font class='T22'><?php print LANGPER20?></font></td>
<td align=center><font class='T22'><?php print "Lang."?></font></td>
<td align=center><font class='T22'><?php print LANGMESS363."&nbsp;1<i>*</i>"?></font></td>
<!-- <td align=center><font class='T22'><?php print "Visu&nbsp;2"."<i>**</i>"?></font></td> -->
<td align=center><font class='T22'><?php print "Nb&nbsp;H."?></font></td>
<td align=center><font class='T22'><?php print "ECTS"?></font></td>
<td align=center><font class='T22'><?php print LANGMESS364 ?></font></td>
<td align=center><font class='T22'><?php print LANGTMESS470 ?></font></td>
</TR>
<?php
$data=visu_affectation_detail_2($saisie_classe,$saisie_tri,$anneeScolaire);
for($i=0;$i<count($data);$i++) {
	$ue=$data[$i][11];
	$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
	print "<tr bgcolor='$bgcolor' >\n";
?>
	<TD><?php print ucwords(chercheMatiereNom($data[$i][1]))?></td>
	<TD><?php print recherche_personne($data[$i][2])?></td>
	<TD><?php print (trim($data[$i][4]) == "") ? "&nbsp;" : $data[$i][4];?></td>
	<TD><?php print (trim($data[$i][5]) == "") ? "&nbsp;" : $data[$i][5];?></td>
	<TD><?php print ereg_replace("^0$",'',$data[$i][6])?></td>
	<TD><?php print ($data[$i][8] == 1) ? "<img src='../image/commun/valid.gif' align='center' />" : "non" ?></td>
<!-- 	<TD><?php print ($data[$i][14] == 1) ? "<img src='../image/commun/valid.gif' align='center' />" : "non" ?> </td> -->
	<TD><?php print (trim($data[$i][9]) == "") ? "&nbsp;" : $data[$i][9];?></td>
	<TD><?php print trim($data[$i][10])?></td>

<?php 
	if ($ue > 0) {
		$tab=recupNomUE($ue);
		$nom_ue=$tab[0][0];
		$ue=$tab[0][1];
		$nom_ueTitle=$nom_ue;
		$nom_ue=trunchaine($nom_ue,40);
		print "<TD>$nom_ue</TD>";
	}else{
		print "<TD>&nbsp;</TD>";
	}
?>
	<TD><?php if ($data[$i][12] == "etudedecasipac" ) print LANGTMESS471 ;  ?></td>
	</tr>
<?php
	}
Pgclose();
?>
</table><BR>
<i><?php print LANGTMESS472 ?> </i>
</td></tr></table>


			
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