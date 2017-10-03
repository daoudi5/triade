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
 
include_once("entete.php");
include_once("menu.php");
include_once("../common/config2.inc.php");
include_once("../librairie_php/lib_note.php"); 
$cnx=cnx2();
validerequete("menuadmin");


if ($_SESSION["membre"] == "menuadmin") {
?> 
<script language="JavaScript" >var envoiform=true; </script>
<script  language="JavaScript">
function fonc1() {
	// document.formulaire.reset();
	document.formulaire.retard_aucun.checked=true;
	document.formulaire.rien.disabled=false;
	document.getElementById('inf').style.visibility='hidden';
}
function fonc2() {
	var op=document.formulaire.saisie_heure.options.selectedIndex;
	if (document.formulaire.saisie_heure.options[op].value == "null") {
		document.formulaire.rien.disabled=true;
		document.getElementById('inf').style.visibility='visible';
	}else{
		document.formulaire.rien.disabled=false;
		document.getElementById('inf').style.visibility='hidden';
	}
}
</script>
<script language="JavaScript" src="../librairie_js/lib_absrtd.js"></script>
<script language="JavaScript" src="../librairie_js/lib_absrtd3.js"></script>

	<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print "Alerte / Envoi Mail aux parents"  ?></span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='gestionABSRtdSanc.php' ><?php print LANGVATEL21 ?></a></li>
				<li style="visibility:visible" ><a href='consulterABSRtd.php' ><?php print LANGBT28."/".LANGPER30 ?></a></li>
				<li style="visibility:visible" ><a href='impr_abs_rtd_eleve.php' ><?php print LANGVATEL264 ?></a></li>
				<li style="visibility:visible" ><a href='alerteAbsRtd.php' ><?php print "Alerte Absences" ?></a></li>
				<li style="visibility:visible" ><a href='alerteAbsRtdSMS.php' ><?php print "Alerte SMS" ?></a></li>
				<li style="visibility:visible" ><a href='gestionABSRtdEtudiant.php' ><?php print LANGVATEL269 ?></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

<font class="T2"><?php print LANGVATEL256 ?>.</font><br><br>

<form method="post">
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print "Trier par nom" ?>","trie_nom"); //text,nomInput</script>&nbsp;
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print "Trier par date" ?>","trie_date"); //text,nomInput</script>
<!-- <td><script language=JavaScript>buttonMagicSubmit("<?php print "Trier par classe" ?>","trie_classe"); //text,nomInput</script></td> -->
<br><br>
<table>
<tr>
<td valign='top' style='padding-top:5px' >&nbsp;&nbsp;<font class='T2'><?php print LANGPROFG ?>&nbsp;:&nbsp;</td><td><select name="saisie_classe" onchange='this.form.submit()' >
<option value='' id='select0' ><?php print LANGCHOIX ?></option>
<?php  if ((isset($_POST["saisie_classe"])) && ($_POST["saisie_classe"] != 'tous')) {
        print "<option  value='".$_POST["saisie_classe"]."' selected  id='select1' >".trunchaine(chercheClasse_nom($_POST["saisie_classe"]),85)."</option>";
}
?>
<!-- <option  value='tous' id='select0' ><?php print LANGAFF5 ?></option> -->
<?php select_classe2(35);?>
</select>
</font>
</td></tr></table>
</form>

<?php
if (isset($_POST["trie_nom"])) {
	$trie='nom';
}
if (isset($_POST["trie_date"])) {
	$trie='date';
}
if (isset($_POST["trie_classe"])) {
	$trie='classe';
}
if (isset($_POST["saisie_classe"])) {
	$idclasse=$_POST["saisie_classe"];
}
?>
<br><br>
<form method="post" action='alerteAbsRtd2.php'>
<table border=1 width='95%' bordercolor=#000000" style="border-collapse: collapse;" >
<?php
if ($idclasse != "") { 
	
		$data_2=affAbsNonJustif2bis($trie,$idclasse);
	// $data : tab bidim - soustab 3 champs
	// a.elev_id, a.date_ab, a.date_saisie, a.origin_saisie, a.duree_ab , a.date_fin, a.motif, a.duree_heure, a.id_matiere, a.time, e.nom, e.elev_id, e.classe, a.courrierenvoyer,e.email,e.email_resp_2
	for($j=0;$j<count($data_2);$j++) {
		$ideleve=$data_2[$j][0];
		$idmatiere=$data_2[$j][7];
		$duree=$data_2[$j][4];
		$time=$data_2[$j][9];
		$courrierenvoyer=$data_2[$j][13];
		$emailP1=$data_2[$j][14];
		$emailP2=$data_2[$j][15];
		if ($duree == "-1") {
			$duree=$data_2[$j][7]." heure(s)";
		}else{
			$duree.=" jour(s)";
		}
	
		if ($data_2[$j][0] == "-4") { continue; }
		if ($data_2[$j][4] == "0" ) { $duree="???"; }
		$datedebut=$data_2[$j][1];
		$datefin=$data_2[$j][5];
		$classe=chercheClasse_nom($data_2[$j][12]);
		
		if ((trim($emailP1) == "") && (trim($emailP2) == "")) {
			$disabled="disabled='disabled'";
			$title=" title=\"Aucun email parent d'indiqué\" ";
			$img="<img src='image/commun/alerte.png' $title  />";
		}else{
			$title="";
			$disabled="";
			$img="";
		}
	
        	$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
	        print "<tr bgcolor='$bgcolor' id='tr$j' >\n";

		print "<td width='33%' >&nbsp;&nbsp;".trunchaine(strtoupper(recherche_eleve_nom($ideleve))." ".ucwords(strtolower(recherche_eleve_prenom($ideleve))),50)."</td>";
		print "<td >&nbsp;&nbsp;$classe</font></td>";
		print "<td >&nbsp;&nbsp;absent le ".dateForm($data_2[$j][1])." durant ".$duree." </td>";
		print "<td align='center' width='5' ><input $disabled type='checkbox' name='liste[]' $title value='$ideleve:$datedebut:$datefin:$duree:$time'  onClick=\"DisplayLigne('tr$j');\" style='padding-left:3px'  >";
		print "$img </td>";
		print "</tr>";
	}

	if (count($data_2) == "0") {
		print "<tr><td align='center'><font class='T2'>aucune donnée</font></td></tr>";
	}

?>
	</table>
	<input type=hidden name=nb value="<?php print count($data_2) ?>">
	<br><br>
	<?php
	if (count($data_2) != "0") { 
		print "<script language=JavaScript>buttonMagicSubmitVATEL(\"".LANGBT38." email\",'rien');</script>";
	}
	?>
	</form>
<?php } ?>
	
	</table>	
		</section>
		</div>
		</div>
	</div>
<?php 
} 
Pgclose();
include_once("piedpage.php");
include_once("connexionEnCours.php");
?>
</body>
</html>
