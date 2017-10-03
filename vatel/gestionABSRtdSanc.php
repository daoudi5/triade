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
			<span class="vat-capitalize-title"><?php print LANGVATEL248  ?></span>
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

<?php if (isset($_POST["class"])) {  ?>

	<form method='post' name='formulaire0' action="gestionABSRtdSanc.php" >

<?php

$idmatiere="";
$anneeScolaire=anneeScolaireViaIdClasse($saisie_classe);

// affichage de la classe
if (isset($_POST["class"])) {
	$idClasse=$_POST["saisie_classe"];
	$saisie_classe=$_POST["saisie_classe"];
	$typevaleur=$_POST["saisie_classe"];
	$typechamps="saisie_classe";
	$sql="SELECT libelle,elev_id,nom,prenom FROM ${prefixe}eleves ,${prefixe}classes  WHERE classe='$saisie_classe' AND code_class='$saisie_classe' AND annee_scolaire='$anneeScolaire' ORDER BY nom";
	$res=execSql($sql);
	$data=chargeMat($res);
	$cl=$data[0][0];
	print "<input type='hidden' name='class' value=\"".$_POST["class"]."\" >";
	print "<input type='hidden' name='saisie_classe' value=\"".$_POST["saisie_classe"]."\" >";
}

?>
<UL><?php print "<font class='T2'>".LANGVATEL43  ?> : <font id="color3" ><?php print ucwords($cl)?></font></font><br><br>
<?php
if (isset($_POST["datedepart"])) {
	$datedepart=$_POST["datedepart"];
	$disabledT="";
	$mess="";
}elseif(AUTODATEABSRTD == "oui") {
	$datedepart=dateDMY();
	$disabledT="";
	$mess="";
}else{
	$datedepart="dd/mm/aaaa";
	$disabledT="disabled='disabled'";
	$mess="<b><font id='color2' >".LANGVATEL38."</font></b>";
}
?>
<font class='T2'><?php print LANGPROFM ?> : </font><input type=text name="datedepart" value="<?php print $datedepart ?>" size=12  onclick="this.value=''" onKeyPress="onlyChar(event)"  class="bouton2" onChange="this.form.submit();" />&nbsp;&nbsp;<?php print $mess ?><br /> 
</form>


<br>
<form name="formulaire"  method='post' action='gestionABSRtdSanc2.php' >

<font class=T2> <?php print LANGCARNET68 ?> : 
<select name="saisie_heure" onChange="fonc2()" <?php print $disabledT ?> >
<!-- <option id='select0' value="null" ><?php print LANGCHOIX ?></option>  -->
<?php
$disabled="disabled";
$data3=recupCreneauDefault("creneau"); // libelle,text
if (count($data3) > 0) {
	$data3=recupInfoCreneau($data3[0][1]);
	print "<option  id='select0' value=\"".trim($data3[0][0])."#".$data3[0][1]."#".$data3[0][2]."\" selected='selected' >".trim($data3[0][0])." : ".timeForm($data3[0][1])." - ".timeForm($data3[0][2])."</option>\n";
	$disabled="";
}else{
?>
<option id='select0' value="null" ><?php print LANGCHOIX ?></option>
<?php
}
select_creneaux2();
?>
<?php
$dataEdt=recupCoursDuJourViaClasse($datedepart,$idClasse); // id,code,enseignement,date,heure,duree,bgcolor,idclasse,idprof,prestation,idmatiere,coursannule
if (count($dataEdt)) {
	print "<optgroup label='EDT'>";
	for($i=0;$i<count($dataEdt);$i++) {
		$secondeT=conv_en_seconde($dataEdt[$i][4]);
                $secondeT+=conv_en_seconde($dataEdt[$i][5]);
                $heureFin=calcul_hours($secondeT);
		$infotime=timeForm($dataEdt[$i][4])." - ".timeForm($heureFin);
		// nuit#22:30:00#06:30:00
		$infotimeText="Edt#".$dataEdt[$i][4]."#".$heureFin;
		print "<option id='select1' value='$infotimeText' >Edt : $infotime</option>";
	}
	print "</optgroup>";

}
?>


	</select>  <input type='hidden' name="datedepart" value="<?php print $datedepart ?>" />

</font> 
<br><br>

<font class=T2><?php print LANGASS18 ?> : </font><select name="idmatiere" <?php print $disabledT ?> >
<option id='select0' value="" ><?php print LANGCHOIX ?></option>
<?php select_matiere3("50") ?>
</select>
<br><br>

<font class=T2><?php print LANGPROF ?> : </font><select name="idprof" <?php print $disabledT ?> >
<option id='select0' value="" ><?php print LANGCHOIX ?></option>
<optgroup label="Enseignant">
<?php select_personne_nom_len_id('ENS',25) ?>
<optgroup label="Vie Scolaire">
<?php select_personne_nom_len_id('MVS',25) ?>
</select>

 </UL><br><br>

<table border="1" bordercolor="#000000" width="100%" style="border-collapse: collapse;" >
<?php
$sub=0;
if( count($data) <= 0 )
        {
        print("<tr><td id=bordure align=center valign=center><BR><font size=3>".LANGPROJ6."</font><BR><BR></td></tr>");
        }
else {
?>
<tr>
<td bgcolor="black" width=25%  ><B><font color='#FFFFFF' ><?php print LANGNA1 ?> <?php print LANGNA2 ?></font></B></td>
<td bgcolor="black" align=center width=3% ><B><font color='#FFFFFF' ><?php print LANGABS20?></B></font></td>
<td bgcolor="black" align=center width=3% ><B><font color='#FFFFFF' ><?php print LANGABS21?></B></font></td>
<td bgcolor="black" width=5% align=center ><B><font color='#FFFFFF' ><?php print LANGABS22?></B></font></td>
<td bgcolor="black" width=3% align=center ><B><a href='#' title='Justifier' ><font color='#FFFFFF' >&nbsp;<?php print "Just." ?>&nbsp;</font></a></B></td>
<td bgcolor="black" align=center width=20% ><B><a href='#' title='Informations' ><font color='#FFFFFF' ><?php print "Info."?></font></a></B></td>
</tr>
<?php
for($i=0;$i<count($data);$i++) {
	$disp=0;

	$enstage=verifSiEleveEnStage($data[$i][1],$datedepart);
	$datartd=verifsiretardAvecDate($data[$i][1],$datedepart);

	//elev_id, heure_ret, date_ret, date_saisie, origin_saisie, duree_ret, motif, idmatiere, creneaux
	$rtdlien="";
	$dejaFait=0;
	if (count($datartd) > 0) {
		$rtdlien="";
		$dejaFait=1;
	}

	if (count($datartd) > 0) {	
		$rtdlien.="<font face=Verdana size=1><b>".LANGABS32."</b>".LANGABS32bis."&nbsp;</font>";
		$ia=0;
		for($io=0;$io<count($datartd);$io++) {
			$ia++;
			$duree="(".$datartd[$io][5].")";
			if ($datartd[$io][5] == 0 ) { $duree="(???)"; }
			$matierenom=chercheMatiereNom($datartd[$io][7]);
			if (trim($matierenom) == "") { $matierenom="???"; }
			list($creneau,$dC,$fC)=split('#',$datartd[$io][8]);
			$cre="($dC - $fC)";
			$rtdlien.="<font face=Verdana size=1>&nbsp;".LANGABS33."&nbsp;".$matierenom."&nbsp;".$cre."&nbsp;".$duree."</font><br>";
		}
	}
	//-----------------------------------------//
	$datartd=verifsiabsAvecDate($data[$i][1],$datedepart);
	//elev_id, duree_heure, date_ab, date_saisie, origin_saisie, duree_ab , motif, idmatiere, creneaux
	
	if (count($datartd) > 0) {
		if ($dejaFait == 0) { $rtdlien="";$dejaFait=1; }
		$rtdlien.="<font face=Verdana size=1><b> ".LANGMESS60."</b>".LANGMESS60bis."&nbsp;</font>";
	
		$ia=0;
		for($io=0;$io<count($datartd);$io++) {
			$ia++;
			$duree="(".$datartd[$io][1]."h)";
			if ($datartd[$io][1] == 0 ) { $duree="(???)"; }
			$matierenom=chercheMatiereNom($datartd[$io][7]);
			if (trim($matierenom) == "") { $matierenom="???"; }
			list($creneau,$dC,$fC)=split('#',$datartd[$io][8]);
			$cre="($dC - $fC)";
			$rtdlien.="<font face=Verdana size=1>&nbsp;".LANGABS33."&nbsp;".$matierenom."&nbsp;".$cre."&nbsp;".$duree."</FONT><br>";
		}
	}
	//-----------------------------------------//
	if ($dejaFait == 1) {
		$rtdlien.="</font>";
	}
	
	if ($disp == 1) {
		$displien="<b>".LANGABS30."</b>";
	}

	// verif si deja absent ou retard
	$datedebut=$datedepart;
	$resu=dejaabsviaDate($data[$i][1],$datedebut);
	if (count($resu) != 0) {
		for($ii=0;$ii<count($resu);$ii++){
			?>
			<tr id='tr<?php print $i ?>' ><td><?php print ucwords($data[$i][2])." ".ucwords($data[$i][3])?></td>
			<td align=center  colspan=5 bgcolor="#FFFFFF"> <?php print LANGABS18 ?> <?php print dateForm($resu[$ii][1])?> <?php print LANGABS19 ?>  <?php print dateForm($resu[$ii][5])?></td>
			</tr>
			<?php
			continue;
		}
	}else{
		$resu=dejadispViaDate($data[$i][1],$datedebut);
		if (count($resu) != 0) {
			//elev_id, code_mat, date_debut, date_fin, date_saisie, origin_saisie, certificat, motif, heure1, jour1, heure2, jour2, heure3, jour3 FROM dispenses
			for($ii=0;$ii<count($resu);$ii++){
				$matiere=chercheMatiereNom($resu[$ii][1]);
				$disp=1;
			}
		}
        ?>
<?php 
$color=($color=="#87C1E6") ? $color="#BCDAF0" : $color="#87C1E6" ; 
?>
<tr id="tr<?php print $i ?>"  bgcolor='<?php print $color ?>' >
<td>
<?php
$photoeleve="image_trombi.php?idE=".$data[$i][1];
$infoProba=getProbaEleve($data[$i][1]);
if ($infoProba == 1) {
	$infoprobatoire="<img src='image/commun/important.png' title=\"En p&eacute;riode probatoire !!\" />";
}else{
	$infoprobatoire="";
}
print "$infoprobatoire&nbsp;&nbsp;".ucwords($data[$i][2])." ".ucwords($data[$i][3]);
if ($disp == 1) { ?>&nbsp;[<b><font color=red>Dispenser de <?php print $matiere?></font></b>]
	<?php
}
?>


</td>
<?php
if (($enstage == true) && (VATEL !=  1)) {
	print "<td align=center colspan='5' bgcolor='#FFFFFF'>";
	print "<i>en stage aujourd'hui</i>";
	print "</td></tr>";
}else{ ?>
	<td align=center >
	<?php $val="'".$i."','".dateHI()."','".dateDMY()."'"; ?>
	<select name="saisie_<?php print $i?>" onChange="DisplayLigne2('tr<?php print $i?>',this.value);abs(<?php print $val?>);">
	<option value=0 id='select0' ><?php print LANGRIEN?></option>
	<option value="absent" id='select1'><?php print LANGABS?></option>
	<option value="retard" id='select1'><?php print LANGRTD?></option>
	</select></td>
	<td  align=center>
	<select name="saisie_duree_<?php print $i?>" onChange="abs3(<?php print $val?>);verifjustifier('<?php print $i ?>')" >
	<option value='0' id='select0'><?php print LANGRIEN?></option>
	<option  id='select1'></option>
	<option  id='select1'></option>
	<option  id='select1'></option>
	<option  id='select1'></option>
	<option  id='select1'></option>
	<option  id='select1'></option>
	<option  id='select1'></option>
	<option  id='select1'></option>
	<option  id='select1'></option>
	<option  id='select1'></option>
	<option  id='select1'></option>
	<option  id='select1'></option>
	<option  id='select1'></option>
	<option  id='select1'></option>
	<option  id='select1'></option>
	<option  id='select1'></option>
	</select></td>
	<td>
	<select onChange="motifabsretad22('<?php print $i ?>',this.value); verifjustifier('<?php print $i ?>')" name="saisie_motifs_<?php print $i ?>" id="motif_<?php print $i?>" >
	<option value="0"  id='select0' ><?php print LANGINCONNU ?></option>
	<?php affSelecMotif() ?>
	<option value="autre"  id='select1' ><?php print "autre" ?></option>
	</select>
	<input type="text" name="saisie_motif_<?php print $i?>" size="19" value="<?php print LANGINCONNU ?>" id="saisie_motif_<?php print $i?>"  style="display:none" />
	</td>
	<td align='center'><table><tr><td><input type="checkbox" name="saisie_justifie_<?php print $i?>" value="1" disabled='disabled' /></td></tr></table></td>


	<td align='left' valign='top' style="padding-left:3px" >
	<?php print $rtdlien."".$displien; ?>
	<input type=hidden size=12 name="saisie_duree1_<?php print $i?>" >
	<input type=hidden name=saisie_pers_<?php print $i?> value="<?php print $data[$i][1]?>">
	</td>
	</tr>
<?php
}
        }
	$sub=1;
	}
      }
print "</table>";
?>
<?php if ($sub == 1) { ?>
<BR>
<input type=hidden name="saisie_id"   value="<?php print count($data)?>">
<input type=hidden name="nomclasse"   value="<?php print $cl ?>">
<input type=hidden name="nommatiere"  value="<?php print "" ?>">
</b>
<table><tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<?php print LANGABS53 ?> :&nbsp;</td><td> <input type=checkbox class="btradio1" name='retard_aucun' value="oui" onclick="fonc1();"> (<?php print LANGOUI?>)</td></tr></table><br><br>
<table align=center><tr><td>
<input type='submit' class="btn btn-primary btn-sm  vat-btn-footer" value="<?php print LANGENR ?>" name='rien' <?php print $disabled ?> >
</td></tr>
</table>
<br>
<div id="inf" style='color:red' ><center><i><?php print LANGMESS427 ?></i></center></div>
<?php if ($disabled == '') {
	print "<script>document.getElementById('inf').style.visibility='hidden';</script>";
}
?>
<br>
<?php } ?>
     <!-- // fin  -->
     </td></tr></table>
	<input type='hidden' name='type' value="<?php print $typechamps ?>"  />
	<input type='hidden' name='typevaleur' value="<?php print $typevaleur ?>" />
     </form>
<?php
}else{
	?>	
	<form name='formulaire' onsubmit='return valide_consul_classe()' method='post' action='gestionABSRtdSanc.php'>
	<font class="T2"><?php print LANGVATEL248 ?> : </font><br><br> <select name='saisie_classe' >
	<option value=0 STYLE='color:#000066;background-color:#FCE4BA'><?php print LANGCHOIX?></option>
	<?php
	include_once("../librairie_php/ajax.php");
	ajax_js();
	select_classe2(25);
	?>
	</select>
	<input type='submit' class="btn btn-primary btn-sm  vat-btn-footer" value="<?php print VALIDER ?>" name='class' >
	</form>
	<br><br><br><br><br><br><br><br><br>
<?php } ?>
		
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
