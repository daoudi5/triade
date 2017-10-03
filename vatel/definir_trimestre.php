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
<script language="JavaScript" src="../librairie_js/verif_creat.js"></script>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGPROFB3 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param9.php' ><?php print "Menu" ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
		
		
		
<?php
if (isset($_POST["create"])) {
	$ok=1;
	$nbT=$_POST["semestre"];
	if ($nbT) {
		$nbT=3;
	}else{
		$nbT=4;
	}
	$nb=1;

	$anneeScolaire=$_POST["annee_scolaire"];

	$idclasse=$_POST["saisie_classe"];
	if ($idclasse == "tous") { 
		$idclasse=0; 
		$sql="DELETE FROM ${prefixe}date_trimestrielle WHERE annee_scolaire='$anneeScolaire' ";
		execSql($sql);
		history_cmd($_SESSION["nom"],"SUPPRESSION","Suppression de toutes les dates trimestres pour l'année $annee_scolaire");
	}

	if ((trim($idclasse) != '') && ($_POST["trimestre1_debut"] != "")) {
		$sql="DELETE FROM ${prefixe}date_trimestrielle WHERE idclasse='$idclasse' AND annee_scolaire='$anneeScolaire' ";
		execSql($sql);
		history_cmd($_SESSION["nom"],"SUPPRESSION","Suppression dates trimestres pour l'année $annee_scolaire de la classe $idclasse");
	}	



	while ($nb < $nbT ) {
		  $valeur="trimestre".$nb;
	      $debut="trimestre".$nb."_debut";
		  $fin="trimestre".$nb."_fin";
		  $date_form_debut=$_POST[$debut];
		  $date_form_fin=$_POST[$fin];
	          if ((trim($date_form_debut) != "") && (trim($date_form_fin) != "")) {
	          	$date_form_debut=dateFormBase($date_form_debut);
	          	$date_form_fin=dateFormBase($date_form_fin);
	        	$cr=def_trimestre($valeur,$date_form_debut,$date_form_fin,$idclasse,$anneeScolaire);
	          	if($cr != 1){
	               		alertJs(LANGPARAM26);
	                	$ok=0;
						history_cmd($_SESSION["nom"],"CREATION","Mise en place dates trimestres pour $idclasse en $annee_scolaire");
	                	break;
	          	}
	          }
        	  $nb=$nb+1;
      	}


     // verification des trimestres
     	$data=affDateTrimByIdclasse("trimestre1",$idclasse,$anneeScolaire);
	 if (count($data)) {
	 	$date1_debut=dateNonForm($data[0][0]);
	 	$date1_fin=dateNonForm($data[0][1]);
	 }

	 $data=affDateTrimByIdclasse("trimestre2",$idclasse,$anneeScolaire);
	 if (count($data)) {
	 	$date2_debut=dateNonForm($data[0][0]);
	 	$date2_fin=dateNonForm($data[0][1]);
	 }

	 $data=affDateTrimByIdclasse("trimestre3",$idclasse,$anneeScolaire);
	 if (count($data)) {
	 	$date3_debut=dateNonForm($data[0][0]);
	 	$date3_fin=dateNonForm($data[0][1]);

	 }

     if (($date1_debut < $date1_fin) && ($date1_fin < $date2_debut) &&  ($date2_debut < $date2_fin)) {
		// rien
     }else{
     	$ok=0;
     	alertJs(LANGPARAM26);
     	$sql="DELETE FROM ${prefixe}date_trimestrielle WHERE idclasse='$idclasse' AND annee_scolaire='$anneeScolaire' ";
		execSql($sql);
		history_cmd($_SESSION["nom"],"SUPPRESSION","Suppression date trimestre $annee_scolaire de la classe $idclasse");
     }


     if ($ok) { alertJs(LANGPARAM27); }

}

if (isset($_GET['id'])) {
	$date11_debut="";
	$date11_fin="";
	$date22_debut="";
	$date22_fin="";
	$date33_debut="";
	$date33_fin="";
	$anneeScolaire=$_GET["annee_scolaire"];

	$data=affDateTrimByIdclasse(trimestre1,$_GET['id'],$anneeScolaire);
	if (count($data)) {
		$date11_debut=dateForm($data[0][0]);
		$date11_fin=dateForm($data[0][1]);
	}

	$data=affDateTrimByIdclasse(trimestre2,$_GET['id'],$anneeScolaire);
	if (count($data)) {
		$date22_debut=dateForm($data[0][0]);
		$date22_fin=dateForm($data[0][1]);
	}

	$data=affDateTrimByIdclasse(trimestre3,$_GET['id'],$anneeScolaire);
	if (count($data)) {
		$date33_debut=dateForm($data[0][0]);
		$date33_fin=dateForm($data[0][1]);

	}

	if (($date33_debut == "") && ($date11_debut != "") && ($date22_debut != "")) {
		$checked="checked='checked'";
	}
}


if (isset($_GET["suppid"])) {
	$idsupp=$_GET["suppid"];
	$sql="DELETE FROM ${prefixe}date_trimestrielle WHERE idclasse='$idsupp'";
	execSql($sql);
}

?>
<form name="formulaire" method="post" action="definir_trimestre.php" >
<br><br>
&nbsp;&nbsp;<font class=T2><?php print LANGPROFG?> :</font> 
<select name="saisie_classe">
<?php
if ((isset($_GET["id"])) && ($_GET["id"] > 0) ) {
	print "<option id='select1' value='".$_GET["id"]."' >".chercheClasse_nom($_GET["id"])."</option>";
}
?>
<option id='select0' value='tous' ><?php print LANGMESS147 ?></option>
<?php
select_classe(); // creation des options
?>
</select> 
<BR><br>

&nbsp;&nbsp;<font class=T2><?php print "Ann&eacute;e scolaire" ?> : </font>
<select name="annee_scolaire">
<option id='select0' value='inconnu' ><?php print LANGCHOIX?></option>
<?php
filtreAnneeScolaireSelect($anneeScolaire);
?>
</select>


<BR><br>
<table width="100%" border="1" align="center" bordercolor="#000000" style="border-collapse: collapse;" >
<tr bgcolor="black" ><td align=center ><b><font color='#FFFFFF'><?php print LANGPARAM18?></font></b></td><td align='center'><b><font color='#FFFFFF'><?php print LANGPARAM19?></font></b></td><td align=center><b><font color='#FFFFFF'><?php print LANGPARAM20?></font></b></td></tr>
<?php
$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
print "<tr bgcolor='$bgcolor' >\n";
?>
<td align=center><font color="red"><?php print LANGPARAM21?></font></td>
<td align=center><input type="text" name="trimestre1_debut" value="<?php print $date11_debut ?>" size=12 readonly> <?php include_once("../librairie_php/calendar.php");calendarVATEL('id1','document.formulaire.trimestre1_debut',$_SESSION["langue"],"0","0");?></td>
<td align=center><input type="text" name="trimestre1_fin"  value="<?php print $date11_fin ?>" size=12 readonly> <?php calendarVATEL('id2','document.formulaire.trimestre1_fin',$_SESSION["langue"],"0","0");?></td>
</tr>
<?php
$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
print "<tr bgcolor='$bgcolor' >\n";
?><td align=center><font color="red"><?php print LANGPARAM22?></font></td>
<td align=center><input type="text" name="trimestre2_debut" value="<?php print $date22_debut ?>" size=12 readonly> <?php calendarVATEL('id3','document.formulaire.trimestre2_debut',$_SESSION["langue"],"0","0");?></td>
<td align=center><input type="text" name="trimestre2_fin"  value="<?php print $date22_fin ?>" size=12  readonly> <?php calendarVATEL('id4','document.formulaire.trimestre2_fin',$_SESSION["langue"],"0","0");?></td>
</tr>
<?php
$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
print "<tr bgcolor='$bgcolor' >\n";
?><td align=center><font color="red"><?php print LANGPARAM23?> *</font></td>
<td align=center><input type="text" name="trimestre3_debut" value="<?php print $date33_debut ?>" size=12 readonly> <?php calendarVATEL('id5','document.formulaire.trimestre3_debut',$_SESSION["langue"],"0");?></td>
<td align=center><input type="text" name="trimestre3_fin" value="<?php print $date33_fin ?>" size=12  readonly> <?php calendarVATEL('id6','document.formulaire.trimestre3_fin',$_SESSION["langue"],"0","0");?></td>
</tr>
</table>


<br/>

<table width="100%" border="0" align="center">
<tr>
<td align='right' ><?php print LANGMESS146 ?>&nbsp;:&nbsp;</td>
<td  align="left" width='50%'><input type='checkbox' name='semestre' value="1" class='btradio1' <?php print $checked ?> /></td>
</tr>
<tr><td colspan='2' align='center'>
<br>
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGPARAM24?>","create"); //text,nomInput</script>
<br>
<font class=T1>* <?php print LANGPARAM25?></font>
</td></tr></table>

</form>
<hr>
<br><br>
<?php
if (isset($_POST["annee_scolaire"])) $anneeScolaire=$_POST["annee_scolaire"];
?>
<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="85">
<tr id='coulBar0' ><td height="2"><b><font   id='menumodule1' ><?php print LANGMESS148 ?></font></b></td></tr>
<tr id='cadreCentral0'>
<td >
<form method='post' action='definir_trimestre.php' >
<br>
<ul>
&nbsp;&nbsp;<font class=T2><?php print LANGVATEL96 ?> : </font>
<select name="annee_scolaire" onChange="this.form.submit()" >
<option id='select0' value='' ><?php print LANGCHOIX?></option>
<?php
filtreAnneeScolaireSelect($anneeScolaire);
?>
</select>
</ul>
</form>
<br>


<?php
$idclasse=0;


$data=recupDateTrimIdclasse($idclasse,$anneeScolaire); //date_debut,date_fin,trim_choix,idclasse
$dateDebutT1="";
$dateFinT1="";
$dateDebutT2="";
$dateFinT2="";
$dateDebutT3="";
$dateFinT3="";
for ($i=0;$i<count($data);$i++) {
	$trim=$data[$i][2];
	if ($trim == "trimestre1") { 
		$dateDebutT1=$data[$i][0];
		$dateFinT1=$data[$i][1];
	}
	if ($trim == "trimestre2") { 
		$dateDebutT2=trim($data[$i][0]);
		$dateFinT2=trim($data[$i][1]);
	}
	if ($trim == "trimestre3") { 
		$dateDebutT3=trim($data[$i][0]);
		$dateFinT3=$data[$i][1];
	}
	if (($dateDebutT3 == "") && ($dateDebutT1 != "") && ($dateDebutT2 != "")) {
		$semestriel="oui";
	}	
	if ($dateDebutT1 != "") { $dateDebutT1=dateForm($dateDebutT1); 	}
	if ($dateFinT1 	 != "")	{ $dateFinT1=dateForm($dateFinT1); 	}
	if ($dateDebutT2 != "") { $dateDebutT2=dateForm($dateDebutT2); 	}
	if ($dateFinT2 	 != "")	{ $dateFinT2=dateForm($dateFinT2); 	}
	if ($dateDebutT3 != "") { $dateDebutT3=dateForm($dateDebutT3); 	}
	if ($dateFinT3   != "")	{ $dateFinT3=dateForm($dateFinT3); 	}
	 
	if ($idclasse == 0) { $nomClasse="Toutes les classes"; }	
}

print "&nbsp;&nbsp;<img src='../image/on10.gif' /> <font class=T2>".LANGBULL33." : $nomClasse</font> / [ <a href='definir_trimestre.php?id=0&annee_scolaire=$anneeScolaire'><font color=green><b>".LANGMESS149."</b></font></a> ]&nbsp;&nbsp;";
print "[ <a href='definir_trimestre.php?suppid=0'><font color=green><b>".LANGMESS150."</b></font></a> ]<br>";	
print "<ul>";
print LANGMESS157." 1 : $dateDebutT1 - $dateFinT1 <br>";
print LANGMESS157." 2 : $dateDebutT2 - $dateFinT2 <br>";
print LANGMESS157." 3 : $dateDebutT3 - $dateFinT3 <br>";
print "</ul>";


$dataC=affClasse(); //code_class,libelle
for ($j=0;$j<count($dataC);$j++) {
	$idclasse=$dataC[$j][0];
	$nomClasse=ucwords($dataC[$j][1]);
	$data=recupDateTrimIdclasse($idclasse,$anneeScolaire); //date_debut,date_fin,trim_choix,idclasse
	$dateDebutT1="";
	$dateFinT1="";
	$dateDebutT2="";
	$dateFinT2="";
	$dateDebutT3="";
	$dateFinT3="";
	for ($i=0;$i<count($data);$i++) {


		$trim=$data[$i][2];
		if ($trim == "trimestre1") { 
			$dateDebutT1=$data[$i][0];
			$dateFinT1=$data[$i][1];
		}
		if ($trim == "trimestre2") { 
			$dateDebutT2=$data[$i][0];
			$dateFinT2=$data[$i][1];
		}
		if ($trim == "trimestre3") { 
			$dateDebutT3=$data[$i][0];
			$dateFinT3=$data[$i][1];
		}
		if (($dateDebutT3 == "") && ($dateDebutT1 != "") && ($dateDebutT2 != "")) {
			$semestriel="oui";
		}

		if ($dateDebutT1 != "") { $dateDebutT1=dateForm($dateDebutT1); 	}
		if ($dateFinT1 	 != "")	{ $dateFinT1=dateForm($dateFinT1); 	}
		if ($dateDebutT2 != "") { $dateDebutT2=dateForm($dateDebutT2); 	}
		if ($dateFinT2 	 != "")	{ $dateFinT2=dateForm($dateFinT2); 	}
		if ($dateDebutT3 != "") { $dateDebutT3=dateForm($dateDebutT3); 	}
		if ($dateFinT3   != "")	{ $dateFinT3=dateForm($dateFinT3); 	}
	
	}

	if (trim($dateDebutT1) == "") continue; 
	print "&nbsp;&nbsp;<img src='../image/on10.gif' /> <font class=T2>".LANGASS17." : $nomClasse</font> / [ <a href='definir_trimestre.php?id=$idclasse&annee_scolaire=$anneeScolaire'><font color=green><b>".LANGPER30."</b></font></a> ]";
	print "&nbsp;&nbsp;[ <a href='definir_trimestre.php?suppid=$idclasse'><font color=green><b>".LANGacce21."</b></font></a> ]<br>";	
	print "<br>";	
	print "<ul> ".LANGMESS157." 1 : $dateDebutT1 - $dateFinT1 <br>";
	print LANGMESS157." 2 : $dateDebutT2 - $dateFinT2 <br>";
	print LANGMESS157." 3 : $dateDebutT3 - $dateFinT3 <br></ul>";

}

print "<br>";
print "</table>";

?>
		
		
		
		
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
