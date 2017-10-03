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
			<span class="vat-capitalize-title"><?php print LANGVATEL79 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param8.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a href='creat_groupe.php' ><?php print LANGVATEL75 ?></a></li>
				<li style="visibility:visible" ><a href='suppression_groupe.php' ><?php print LANGGRP44 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

	<script language="JavaScript" src="../librairie_js/verif_creat.js"></script>
	
		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

	<form method='post'>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class="T2"><?php print LANGBULL3?> : </font><select name="anneeScolaire" size="1" onChange="this.form.submit()">
<?php
filtreAnneeScolaireSelectAnterieur("$anneeScolaire",10); // creation des options
?>
</select>
</form>
<br>
<TABLE border=1 width=100% Bordercolor="#000000" style="border-collapse: collapse;">
<TR><td bgcolor="black" align='center' width='30%' ><a href="liste_groupe.php?choix=1"><font color='#FFFFFF'><?php print LANGGRP11?></font>&nbsp;<?php if ($_GET["choix"] != "2") { ?><img src="../image/commun/za.png" border="0" ><?php } ?></a></TD>
<td bgcolor="black"  align='center' ><b><a href="liste_groupe.php?choix=2"><font color='#FFFFFF'><?php print LANGGRP12?></font></b>&nbsp;<?php if ($_GET["choix"] == "2") { ?><img src="../image/commun/za.png" border="0" ><?php } ?></a> </TD>
<td bgcolor="black"  align='center' width='5%' ><b><font color='#FFFFFF'><?php print LANGGRP13?></font></b></TD>
<td bgcolor="black"  align='center' width='5%' ><b><font color='#FFFFFF'><?php print LANGBULL3?></font></b></TD></TR>
<?php
if ($_GET["choix"] == "2") {	
	$sql="SELECT libelle,annee_scolaire FROM ${prefixe}classes WHERE annee_scolaire='$anneeScolaire' ORDER BY libelle ";
	$res=execSql($sql);
	$data_classe=chargeMat($res);
	for($i=0;$i<count($data_classe);$i++) {
		$nom_classe=$data_classe[$i][0];
		$matGroup=matGroup($nom_classe);
		if ($matGroup == "") { continue; }
		$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
		print "<tr bgcolor='$bgcolor' >\n";
		print "<TD width=30%>";
		for($j=0;$j<count($matGroup);$j++){
			$val=$matGroup[$j][0];
			$lib=$matGroup[$j][1];
			$click.="<input type=button onclick=\"open('../liste_groupe_eleve.php?gid=$val','liste_groupe_eleve','width=600,height=500,scrollbars=yes')\" value=\"$lib\" class='btn btn-primary btn-sm  vat-btn-footer' > ";
			print "$lib, ";	
		}
		print "</TD>";
		print "<TD >&nbsp;$nom_classe</TD>";
		print "<TD align=center>$click</TD>";
		print "<TD align=center><input type='button' onclick=\"open('modifier_groupe.php?gid=$val','_self','')\" value='".LANGPER30."' class='btn btn-primary btn-sm  vat-btn-footer' /></TD></tr>";
		unset($click);
	}


}else {
$sql="SELECT group_id,libelle,liste_elev FROM ${prefixe}groupes WHERE annee_scolaire='$anneeScolaire' ORDER BY libelle";

$res=execSql($sql);
$liste_gid=chargeMat($res);

for($cpt=0;$cpt<count($liste_gid);$cpt++) {
	if ($liste_gid[$cpt][0] != 0) {
		$classesDsGroupe[$liste_gid[$cpt][0]."|".$liste_gid[$cpt][1]] = $liste_gid[$cpt][2] ;
	}
}

foreach($classesDsGroupe as $cle => $value) {
	$liste_eleves = substr($value,1);
	$liste_eleves = substr($liste_eleves,0,strlen($liste_eleves)-1);
	if (trim($liste_eleves) != "") {
		$sql = "SELECT libelle FROM ${prefixe}classes e, ${prefixe}eleves f WHERE f.classe = e.code_class AND f.elev_id IN ($liste_eleves)";
		$res = execSql($sql);
		$data =  chargeMat($res);
		for($cpt2=0;$cpt2<count($data);$cpt2++){
			$classesDsGroupe_tmp[$cle][] = $data[$cpt2][0];
		}
	}else{
		if ($cle) { $classesDsGroupe_tmp[$cle][] = ""; }
	}
}

$classesDsGroupe =  $classesDsGroupe_tmp ;
unset($classesDsGroupe_tmp);
	foreach($classesDsGroupe as $cle => $value){
		$liste_classe='';
		$aff=split("\|",$cle);
		$affnomgroupe=$aff[1];
		sort($value);
		$value = array_unique ($value);
		foreach($value as $tmp) {
			if ($tmp != "") {
				$liste_classe = $liste_classe."&nbsp;- ".$tmp;
			}
		}
		
		?>
		<?php
		if (trim($affnomgroupe) != "") {
			if ($liste_classe == "") { $disabled="disabled='disabled'";$liste_classe="&nbsp;<i><font color=red>".LANGVATEL77."</font></i>"; }
		
		$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
		print "<tr bgcolor='$bgcolor' >\n";
		?>
		<TD ><?php print $affnomgroupe?> </TD>
		<TD ><?php print $liste_classe?></TD>
		<TD  align=center><input type='button' onclick="open('../liste_groupe_eleve.php?gid=<?php print $aff[0]?>','liste_groupe_eleve','width=600,height=500,scrollbars=yes')" value="<?php print LANGVATEL76 ?>" class='btn btn-primary btn-sm  vat-btn-footer'  <?php print $disabled ?> ></TD>
		<TD align=center><input type='button' onclick="open('modifier_groupe.php?gid=<?php print $aff[0] ?>','_self','')" value='<?php print LANGPER30 ?>' class='btn btn-primary btn-sm  vat-btn-footer'  /></TD></tr>
<?php
			$disabled="";
			$i++;
		}
	}

}
?>


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