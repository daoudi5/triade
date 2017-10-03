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

<?php
if (isset($_POST["joursms"])) {
	$datesms=dateDMY();
	$datesms=datemoinsn($datesms,$_POST["joursms"]);

}else{
	$datesms=dateDMY2();
}
?>
<?php print "Envoi SMS pour les absences depuis " ?> <?php print dateForm($datesms)?> </font></b></td>

<br>
<form method=post name="formulaire" >
<?php print LANGABS5 ?> 
<select name="joursms" onchange="document.forms.formulaire.submit()">
<option value="0" id='select0' ><?php print LANGCHOIX ?></option>
<option value="0" id='select1' >d'aujourd'hui</option>
<option value="1" id='select1' >Depuis 1 jour</option>
<option value="2" id='select1' >Depuis 2 jours</option>
<option value="3" id='select1' >Depuis 3 jours</option>
<option value="4" id='select1' >Depuis 4 jours</option>
<option value="5" id='select1' >Depuis 5 jours</option>
<option value="6" id='select1' >Depuis 6 jours</option>
<option value="7" id='select1' >Depuis 7 jours</option>
<option value="8" id='select1' >Depuis 8 jours</option>
<option value="9" id='select1' >Depuis 9 jours</option>
<option value="10" id='select1' >Depuis 10 jours</option>
<option value="11" id='select1' >Depuis 11 jours</option>
<option value="12" id='select1' >Depuis 12 jours</option>
<option value="13" id='select1' >Depuis 13 jours</option>
<option value="14" id='select1' >Depuis 14 jours</option>
</select>
<?php 
$idClasse='tous';
?>
<?php print LANGPROFG ?>&nbsp;:&nbsp;<select name="saisie_classe" onchange='this.form.submit()' >
<option value='tous' id='select0' ><?php print LANGCHOIX ?></option>
<?php  if ((isset($_POST["saisie_classe"])) && ($_POST["saisie_classe"] != 'tous')) {
	$idClasse=$_POST["saisie_classe"];
        print "<option  value='".$_POST["saisie_classe"]."' selected  id='select1' >".trunchaine(chercheClasse_nom($_POST["saisie_classe"]),85)."</option>";
}
?>
<!-- <option  value='tous' id='select0' ><?php print LANGAFF5 ?></option> -->
<?php select_classe2(35);?>
</select>



</form>

<form method=post action="sms-envoi.php" name=formulaire2 onSubmit="document.formulaire2.create.disabled=true">
<input type='hidden' value="absent(e)" name="type" />
<br>
<table border="1" bordercolor="#000000" width="100%">
<tr>
<TD bgcolor='black'  ><font color='#FFFFF' ><b><?php print LANGMESS247 ?> </b></font></TD>
<TD bgcolor='black' width=10% align=center><font color='#FFFFFF'><b> SMS </b></font></TD>
<?php
	$nb=0;
	$data_3=affAbsNonJustifSms($datesms);
	//  elev_id, date_ab, date_saisie, origin_saisie, duree_ab ,date_fin, motif, duree_heure, id_matiere, time, smsenvoye
	// $data : tab bidim - soustab 3 champs
	for($j=0;$j<count($data_3);$j++) {
		$couleur="class=\"tabnormal\" onmouseover=\"this.className='tabover'\" onmouseout=\"this.className='tabnormal'\"";
		$ideleve=$data_3[$j][0];
		
		$date_ab=$data_3[$j][1];
		$time=$data_3[$j][9];

		$classe=chercheIdClasseDunEleve($data_3[$j][0]);
		if (($idClasse != $classe) && ($idClasse != 'tous')) continue ;
		$classe=chercheClasse($classe);
		$smsenvoye=$data_3[$j][10];
                if (($data_3[$j][6] != "inconnu")  && ($data_3[$j][4] != 0 ) ){
                        $couleur="bgcolor='#FFFF99'";
		}
		if ($smsenvoye == '1') {
			$smsenvoye="<br><b><i><font color='colort1'>SMS envoyé !</font></i></b>";
		}else{
			$smsenvoye="";
		}

	$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
        print "<tr bgcolor='$bgcolor' id='tr$j' >\n";
?>

	<td id='bordure' valign='top'><img src="image_trombi.php?idE=<?php print $ideleve ?>"  align='left' border=0 ><b><?php print strtoupper(recherche_eleve_nom($ideleve))?></b> <?php print ucwords(strtolower(recherche_eleve_prenom($ideleve)))?> 
	[<font color=green><?php print $classe[0][1] ?></font>]
	<br /><br />
	<?php print LANGABS42?> <?php 
		if ($data_3[$j][4] >= 0) {
			print dateForm($data_3[$j][1])?> <?php print LANGABS43?> <?php
			if ($data_3[$j][4] == 0) {
				print "???";
			}else {
				print $data_3[$j][4];
				print " ".LANGABS44;
			}
		}else{
			print dateForm($data_3[$j][1])?> <?php print LANGABS43?> <?php
			print  $data_3[$j][7];
			print "h";
		}
	?> 
	</td>
	<td align=left id='bordure' valign='top'>
<?php 

		$filtreSMS=config_param_visu('smsfiltre');
		$filtreSMS=$filtreSMS[0][0];

		$telok=0;
		$telsms=trim(cherchetel($ideleve));
		if (ereg("^$filtreSMS",$telsms)) {
			$telsms=ereg_replace(" ","",$telsms);
			$telsms=ereg_replace("\.","",$telsms);
			$telsms=ereg_replace("/","",$telsms);
			$telsms=ereg_replace("-","",$telsms);
			$telsms=ereg_replace("_","",$telsms);
			if (is_numeric($telsms)) { 
				$nb++; 
				print "<u>Principal:</u><br>".$telsms."&nbsp;<input type=checkbox name='sms[]' value='$ideleve#$telsms#$date_ab#$time' ><br>";
				$telok=1;  
			}
		}

		$telsms=trim(cherchetelpere($ideleve));
		if (ereg("^$filtreSMS",$telsms)) {
			$telsms=ereg_replace(" ","",$telsms);
			$telsms=ereg_replace("\.","",$telsms);
			$telsms=ereg_replace("/","",$telsms);
			$telsms=ereg_replace("-","",$telsms);
			$telsms=ereg_replace("_","",$telsms);
			if (is_numeric($telsms)) { 
				$nb++; 
				print "<u>".LANGVATEL262." :</u><br>".$telsms."&nbsp;<input type=checkbox name='sms[]' value='$ideleve#$telsms#$date_ab#$time' ><br>";
				$telok=1;  
			}
		}

		
		$telsms=trim(cherchetelmere($ideleve));
		if (ereg("^$filtreSMS",$telsms)) {
			$telsms=ereg_replace(" ","",$telsms);
			$telsms=ereg_replace("\.","",$telsms);
			$telsms=ereg_replace("/","",$telsms);
			$telsms=ereg_replace("-","",$telsms);
			$telsms=ereg_replace("_","",$telsms);
			if (is_numeric($telsms)) { 
				$nb++; 
				print "<u>".LANGVATEL261." :</u><br>".$telsms."&nbsp;<input type=checkbox name='sms[]' value='$ideleve#$telsms#$date_ab#$time' ><br>";
				$telok=1;  
			}
		}

		$telsms=trim(cherchetelportable1($ideleve));
		if (ereg("^$filtreSMS",$telsms)) {
			$telsms=ereg_replace(" ","",$telsms);
			$telsms=ereg_replace("\.","",$telsms);
			$telsms=ereg_replace("/","",$telsms);
			$telsms=ereg_replace("-","",$telsms);
			$telsms=ereg_replace("_","",$telsms);
			if (is_numeric($telsms)) { 
				$nb++; 
				print "<u>".LANGVATEL260." 1:</u><br>".$telsms."&nbsp;<input type=checkbox name='sms[]' value='$ideleve#$telsms#$date_ab#$time' ><br>";
				$telok=1;  
			}
		}


		$telsms=trim(cherchetelportable2($ideleve));
		if (ereg("^$filtreSMS",$telsms)) {
			$telsms=ereg_replace(" ","",$telsms);
			$telsms=ereg_replace("\.","",$telsms);
			$telsms=ereg_replace("/","",$telsms);
			$telsms=ereg_replace("-","",$telsms);
			$telsms=ereg_replace("_","",$telsms);
			if (is_numeric($telsms)) { 
				$nb++; 
				print "<u>".LANGVATEL260." 2:</u><br>".$telsms."&nbsp;<input type=checkbox name='sms[]' value='$ideleve#$telsms#$date_ab#$time' ><br>";
				$telok=1;  
			}
		}

		$telsms=trim(cherchetelEleve($ideleve));
		if (ereg("^$filtreSMS",$telsms)) {
			$telsms=ereg_replace(" ","",$telsms);
			$telsms=ereg_replace("\.","",$telsms);
			$telsms=ereg_replace("/","",$telsms);
			$telsms=ereg_replace("-","",$telsms);
			$telsms=ereg_replace("_","",$telsms);
			if (is_numeric($telsms)) { 
				$nb++; 
				print "<u>".LANGVATEL259." :</u><br>".$telsms."&nbsp;<input type=checkbox name='sms[]' value='$ideleve#$telsms#$date_ab#$time' ><br>";
				$telok=1; 
			}
		}

		print "<center>$smsenvoye</center>";
		if ($telok==0) { print "<i>".LANGVATEL257."</i>"; }
 	?>
	</td></TR>
<?php
}
print "</table><br /><br />";
print "<input type=hidden name='nb' value='$nb' >";
print "<table align=center border='0'><tr><td><script language=JavaScript>buttonMagicSubmitVATEL(\"".LANGVATEL258."\",\"create\"); </script></td></tr></table>";
print "</form>";
?>
<BR><BR>

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
