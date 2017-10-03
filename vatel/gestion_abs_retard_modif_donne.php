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
	
	if (isset($_POST["modif_date"])) {
		$date=$_POST["saisie_date"];
	}else{
		$date=dateDMY();
	}

	if (isset($_POST["sClasseGrp"])) {
		$filtreCLasse=$_POST["sClasseGrp"];
	}else{
		$filtreCLasse="tous";
	}	

?>
	<script language="JavaScript" >
	function print_abs_rtd_du_jour(){
		var ok=confirm(langfunc3);
		if (ok) {
			open('../gestion_abs_retard_du_jour_print.php?id=<?php print dateFormBase($date) ?>&filtre=<?php print $filtreCLasse?>','_blank','');		
		}
	}

	function print_abs_rtd_du_jour_2(){
		var ok=confirm(langfunc3);
		if (ok) {
			open('../gestion_abs_retard_du_jour_print.php?id=<?php print dateFormBase($date) ?>&filtre=<?php print $filtreCLasse?>&inconnu=1','_blank','');		
		}
	}
	</script>

	<script language="JavaScript" src="../librairie_js/lib_absrtdplanifier.js"></script>

	<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL270  ?></span>
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
$refRattrapage="";
//--------------------------------------------------//
if(isset($_POST["supp_retard"])) {
	$motif="saisie_modif_".$_POST["saisie_id_champ"];
	$duree_retourner="saisie_duree_retourner_".$_POST["saisie_id_champ"];
	$justifier="saisie_justifier_".$_POST["saisie_id_champ"];
	$cr=modif_retard2($_POST["saisie_eleve_id"],$_POST["saisie_heure_ret"],$_POST["saisie_date_ret"],$_POST[$duree_retourner],$_POST[$motif],dateDMY2(),$_SESSION["nom"],$_POST[$justifier],$_POST["saisie_heuredoriginsaisie"],$_POST["saisie_date_ret_origine"],$refRattrapage) ;
	if ($cr == "-1") { alertJs("Retard déjà enregistré pour cette même période."); }
}
//--------------------------------------------------//
if(isset($_POST["supp_absence"])) {
	$motif="saisie_modif_".$_POST["saisie_id_champ"];
	$duree_retourner="saisie_duree_retourner_".$_POST["saisie_id_champ"];
	$justifier="saisie_justifier_".$_POST["saisie_id_champ"];
	$cr=modif_absence($_POST["saisie_eleve_id_2"],$_POST["saisie_date_ret_2"],$_POST["saisie_date_saisie"],$_SESSION["nom"],$_POST[$motif],$_POST[$duree_retourner],$_POST["saisie_time"],$_POST["saisie_matiere"],$_POST[$justifier],$_POST["saisie_heuredoriginsaisie"],$_POST["saisie_date_ret_origine"],$_POST["saisie_heuredabsence"],$refRattrapage);
}
//--------------------------------------------------//

if (isset($_GET["ideleve"])) {
	$sql="SELECT c.libelle,e.nom,e.prenom,e.elev_id FROM ${prefixe}eleves e, ${prefixe}classes c WHERE e.elev_id = '".$_GET["ideleve"]."' AND c.code_class = e.classe ORDER BY c.libelle, e.nom, e.prenom";
	$res=execSql($sql);
	$data=chargeMat($res);
}else{
	if (isset($_POST["saisie_eleve_id"])) { $ideleve=$_POST["saisie_eleve_id"]; }
	if (isset($_POST["saisie_eleve_id_2"])) { $ideleve=$_POST["saisie_eleve_id_2"]; }

	// affichage de la liste d'élèves trouvées
	$sql="SELECT c.libelle,e.nom,e.prenom,e.elev_id FROM ${prefixe}eleves e, ${prefixe}classes c WHERE e.elev_id = '$ideleve' AND c.code_class = e.classe ORDER BY c.libelle, e.nom, e.prenom";
	$res=execSql($sql);
	$data=chargeMat($res);
}

if( count($data) <= 0 )
        {
        print("<BR><center><font size=3>".LANGDISP1."</font><BR><BR></center>");
        }
else {
for($i=0;$i<count($data);$i++)
        {
        ?>
<table border="0" bordercolor="#000000" width="100%" style="border-collapse: collapse;"  >
<tr>
<td width=55%><?php print LANGTP1 ?> : <B><?php print ucwords(trim($data[$i][1]))?> </b></td>
<td ><?php print LANGCALEN7 ?> : <font color=red><?php print trim($data[$i][0])?></font>
</td></tr>
<tr>
<td ><?php print LANGTP2 ?> : <b><?php print ucwords(trim($data[$i][2]))?></b></td>
<td > <?php print LANGABS62 ?></td>
</tr>
<tr>
<td colspan='2'>Cumul : <b><span id="<?php print "cumul$i" ?>"></span></b></td>

</tr>

</table>
<table border="1" bordercolor="#000000" width="100%" style="border-collapse: collapse;"  >
<TR>
<TD bgcolor='yellow' align=center width=20%><?php print LANGABS13 ?></td>
<TD bgcolor='yellow' align=center width=20%><?php print LANGVATEL265 ?> </td>
<TD bgcolor='yellow' align=center width=15%><?php print LANGABS60 ?> </td>
<TD bgcolor='yellow' align=center width=20%><?php print LANGABS12 ?> </td>
<TD bgcolor='yellow' align=center width=10%><?php print LANGAGENDA30 ?></td>
</TR>
<?php
$cumulretard=0;
$nbabs=0;
$nbheureab=0;

$data_2=affRetard($data[$i][3],$anneeScolaire);
// $data : tab bidim - soustab 3 champs
// elev_id, heure_ret, date_ret, date_saisie, origin_saisie, duree_ret, motif, idmatiere, justifier, heure_saisie, creneaux, idrattrapage
$cumulretard=count($data_2);
for($j=0;$j<count($data_2);$j++) {
	list($creneaux,$crenDebut,$crenFin)=split('#',$data_2[$j][10]);
	$idrattrapage=$data_2[$j][11];
	$elev_id=$data_2[$j][0];
	$heure_ret=$data_2[$j][1];
	$date_ret=$data_2[$j][2];
	$date_saisie=$data_2[$j][3];
	$duree_ret=$data_2[$j][5];
	$idmatiere=$data_2[$j][7];
	$justifier=$data_2[$j][8];
	$heure_saisie=$data_2[$j][9];
       	$creneaux=addslashes($data_2[$j][10]);
	if ($idrattrapage == "") {
		$idrattrapage=verifRattrapageRetards($elev_id, $heure_ret, $date_ret, $date_saisie, $duree_ret, $idmatiere, $justifier, $heure_saisie, $creneaux);
	}

	$matiere=chercheMatiereNom($data_2[$j][7]);
	if (($matiere == "") || ($matiere < 0)) { $matiere="";  }
?>
<TR class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
<form method='POST' name="formulaire_<?php print $i.$j?>" >
<TD align=center valign=top><?php print date_jour(dateForm($data_2[$j][2])); ?><br>

<span id='ida_<?php print $j?>' ><a href="#" onclick="document.getElementById('ida_<?php print $j?>').style.display='none';document.getElementById('idaa_<?php print $j?>').style.display='block'; return false;" ><?php print dateForm($data_2[$j][2])?></a></span>
<input type=text size=9 style="display:none" name='saisie_date_ret' id="idaa_<?php print $j?>" value="<?php print dateForm($data_2[$j][2])?>" onKeyPress="onlyChar(event)" />
</td>
<TD  align=center valign=top><?php print timeForm($data_2[$j][1]) ?> - <?php print $crenFin ?> (<?php print trunchaine(trim($matiere),11) ?>) </td>
<TD  align=center valign=top>
<select name="saisie_duree_<?php print $i?>" onChange="chargement_pendant('','<?php print $i?>','<?php print $i.$j?>')" >
<option STYLE='color:#000066;background-color:#FCE4BA'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
</select>
<input type=hidden onfocus=this.blur() name="saisie_duree_retourner_<?php print $i?>" value="<?php print $data_2[$j][5]?>"  >
<?php
$yy=$data_2[$j][5];
if ($data_2[$j][5] == 0) {
	$yy="???";
}
?>
<script langage=Javascript>
chargement_pendant('<?php print trim($yy)?>','<?php print $i?>','<?php print $i.$j?>');
</script>
</td>
<TD  valign=top>
<?php
	$motiftext=$data_2[$j][6] ;
	if ($data_2[$j][6] == "inconnu") { $motiftext=LANGINCONNU; }
	if (trim($data_2[$j][6]) == "0") { $motiftext=LANGINCONNU; }
	$motiftext=ereg_replace('"'," ",$motiftext);
?>
<select onChange="demandeMotif2('<?php print $i.$j?>',this.value)" id="motif2<?php print $i.$j?>" >
<option value="<?php print $motiftext ?>"  STYLE="color:#000066;background-color:#FCE4BA" ><?php print $motiftext ?></option>
<?php affSelecMotif() ?>
<option value="autre" STYLE='color:red;background-color:#CCCCFF' ><?php print "autre" ?></option>
</select>
<input type='text' value="<?php print $motiftext ?>" name="saisie_modif_<?php print $i?>" style="display:none" id="saisie_motif2_<?php print $i.$j?>" />
<br>
( <input type=checkbox name="saisie_justifier_<?php print $i?>" value="1" <?php if ($data_2[$j][8] == 1) { print "checked='checked'"; } ?> > <?php print LANGRTDJUS ?>)
</td>
<TD  align=center valign=top>
<input type="submit" name="supp_retard" value="<?php print LANGPER30 ?>" class="btn btn-primary btn-sm pull-right vat-btn-footer" ><br><br>
<input type="hidden" name="saisie_eleve_id" value="<?php print $data[$i][3]?>">
<input type="hidden" name="saisie_heure_ret" value="<?php print $data_2[$j][1]?>">
<input type="hidden" name="saisie_date_ret_origine" value="<?php print $data_2[$j][2]?>">
<input type="hidden" name="saisie_id_champ" value="<?php print $i?>">
<input type="hidden" name="saisie_nom_eleve" value="<?php print $data[$i][1]?>">
<input type="hidden" name="saisie_heuredoriginsaisie" value="<?php print $data_2[$j][9]?>">
</form>
<form method='post' action='../rattrapage.php' onsubmit="var Nwin = window.open('../rattrapage.php', 'Nwin', 'width=430,height=230,toolbar=no,location=no,directories=no, status=no,scrollbars=no,resizable=no,menubar=no'); return true;" target='Nwin'  >
<input type="submit" value="<?php print "Rattrap." ?>" name='acces'  class="btn btn-primary btn-sm pull-right vat-btn-footer" title="Rattrapage" >
<input type='hidden' name=idrattrappage value="<?php print $idrattrapage?>">
</form>

</td></TR>
<?php
        }
?>
</table>
<BR>
<table border="1" bordercolor="#000000" width="100%" style="border-collapse: collapse;"  >
<TR>
<TD bgcolor='yellow' align=center width=20%><?php print LANGPARENT8 ?> </td>
<TD bgcolor='yellow' align=center width=15%><?php print LANGABS60 ?> </td>
<TD bgcolor='yellow' align=center width=25%>&nbsp;<?php print LANGVATEL265 ?>&nbsp;</td>
<TD bgcolor='yellow' align=center width=20%><?php print LANGABS12 ?> </td>
<TD bgcolor='yellow' align=center width=10%><?php print LANGAGENDA30 ?></td>
</TR>

<?php
$data_3=affAbsence($data[$i][3],$anneeScolaire);
//   elev_id, date_ab, date_saisie, origin_saisie, duree_ab ,date_fin, motif,  duree_heure, id_matiere, time, justifier,  heure_saisie, heuredabsence, creneaux, smsenvoye , idrattrapage
$nbjoursabs=0;$nbheureabs=0;
for($j=0;$j<count($data_3);$j++) {

	$idrattrapage=$data_3[$j][15];
	if (trim($idrattrapage) == "") {
		$elev_id=$data_3[$j][0];
		$date_saisie=$data_3[$j][2];
		$idmatiere=$data_3[$j][8];
		$heure_saisie=$data_3[$j][11];
		$creneaux=addslashes($data_3[$j][13]);
		$date_ab=$data_3[$j][1];
		$duree_ab=$data_3[$j][4];
		$date_fin=$data_3[$j][5]; 
		$time=$data_3[$j][9];

		$idrattrapage=verifRattrapageAbsences($elev_id, $date_ab, $date_saisie, $duree_ab, $date_fin,  $idmatiere, $time, $heure_saisie, $creneaux);
	}

	if ($data_3[$j][13] != "") {
		list($creneaux,$crenDebut,$crenFin)=split('#',$data_3[$j][13]);
	}else{
		$crenDebut="??:??:??";
		$crenFin="??:??:??";
	}
	$heuredabsence=$data_3[$j][12];
	$matiere=chercheMatiereNom($data_3[$j][7]);
	$nomMatiere=chercheMatiereNom($data_3[$j][8]);

	if ($data_3[$j][4] > 0) {
		$nbjoursabs = $nbjoursabs + $data_3[$j][4];
	}else{
		$nbheureabs = $nbheureabs + $data_3[$j][7];	
	}

	if ($data_3[$j][14] == 1) { $imgsms="<img src='../image/commun/sms.gif' title='SMS ENVOYE' width='20' height='18' align='center'/>"; }else{ $imgsms=""; }

?>
<TR class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
<form method=POST name="formulaire_3_<?php print $i.$j?>" >
<TD  align=center valign=top><?php print date_jour(dateForm($data_3[$j][1])); ?><br>
<span id='idb_<?php print $i.$j?>' ><a href="#" onclick="document.getElementById('idb_<?php print $i.$j?>').style.display='none';document.getElementById('saisie_date_ret_2_<?php print $i.$j?>').style.display='block';return false;" ><?php print dateForm($data_3[$j][1])?></a></span>
<input type=text size=9 name='saisie_date_ret_2' style="display:none" value="<?php print dateForm($data_3[$j][1])?>" onKeyPress="onlyChar(event)" id="saisie_date_ret_2_<?php print $i.$j ?>"/>
</td>
<TD  align=center valign=top>
<select name="saisie_duree_<?php print $i?>" onChange="chargement_pendant_jour('','<?php print $i?>','<?php print $i.$j?>')" >
<option STYLE='color:#000066;background-color:#FCE4BA'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
<option STYLE='color:#000066;background-color:#CCCCFF'></option>
</select>
<input type=hidden onfocus=this.blur() name="saisie_duree_retourner_<?php print $i?>" value="<?php print $data_3[$j][4]?>"  >
<?php
$yy=$data_3[$j][4]." J";
if ($data_3[$j][4] == 0) {
	$yy="???";
}
if ($data_3[$j][4] == -1) {
	$yy=preg_replace('/\./','H',$data_3[$j][7]);
//	$yy=$data_3[$j][7]."H";
}
?>
<script language='Javascript'>
chargement_pendant_jour('<?php print trim($yy)?>','<?php print $i?>','<?php print $i.$j?>');
</script>
	<TD align=center valign=top><?php print timeForm($crenDebut)."&nbsp;-&nbsp;".timeForm($crenFin) ?> 
		<?php $idclasse=chercheClasseEleve($data_3[$j][0]); ?>
		<br><br><a href='#' onclick="open('../edt_visu.php?idclasse=<?php print $idclasse ?>&date=<?php print $data_3[$j][1] ?>','edt','width=1050,height=650,resizable=yes,personalbar=no,toolbar=no,statusbar=no,locationbar=no,menubar=no,scrollbars=yes'); return false;" ><img src="../image/commun/calendar3.gif" border='0' /></a>
	</td>
<TD valign=top>
<?php $motiftext=$data_3[$j][6];
      if ($data_3[$j][6] == "inconnu") { $motiftext=LANGINCONNU; }
      if (trim($data_3[$j][6]) == "0") { $motiftext=LANGINCONNU; }
      $motiftext=ereg_replace('"'," ",$motiftext);
?>
<select  onchange="demandeMotif('<?php print $i.$j?>',this.value)" id="motif<?php print $i.$j?>" >
<option value="<?php print $motiftext ?>"  STYLE="color:#000066;background-color:#FCE4BA" title="<?php print $motiftext ?>"  ><?php print trunchaine($motiftext,30) ?></option>
<?php affSelecMotif() ?>
<option value="autre" STYLE='color:red;background-color:#CCCCFF' ><?php print "autre" ?></option>
</select>
<input type='text' value="<?php print $motiftext ?>" name="saisie_modif_<?php print $i?>" style="display:none" id="saisie_motif_<?php print $i.$j?>" />
<br>
<?php print $imgsms ?> (<input type=checkbox name="saisie_justifier_<?php print $i?>" value="1" <?php if ($data_3[$j][10] == 1) { print "checked='checked'"; } ?> > <?php print LANGRTDJUS?>) <br> <?php print LANGASS18 ?> : <a title="<?php print $nomMatiere?>"><?php print trunchaine($nomMatiere,15) ?></a>

</td>
<TD align=center valign=top><input type=submit name=supp_absence value="<?php print LANGPER30 ?>" name="supp_absent" class="btn btn-primary btn-sm pull-right vat-btn-footer"  ><br>&nbsp;le&nbsp;<?php print dateJJMM($data_3[$j][2])?> <?php if (($data_3[$j][11] != "") && ($data_3[$j][11] != "00:00:00") ){ print timeForm($data_3[$j][11]); }?> 
<br />
<input type=hidden name=saisie_eleve_id_2 value="<?php print $data[$i][3]?>">
<input type=hidden name=saisie_date_ret_origine value="<?php print $data_3[$j][1]?>">
<input type=hidden name=saisie_nom_eleve value="<?php print $data[$i][1]?>">
<input type=hidden name=saisie_id_champ value="<?php print $i?>">
<input type=hidden name=saisie_time value="<?php print $data_3[$j][9]?>">
<input type=hidden name=saisie_matiere value="<?php print $data_3[$j][8]?>">
<input type=hidden name=saisie_heuredoriginsaisie value="<?php print $data_3[$j][11]?>">
<input type=hidden name=saisie_date_saisie value="<?php print $data_3[$j][2]?>">
<input type=hidden name=saisie_heuredabsence value="<?php print $heuredabsence?>">
</form>
<form method='post' action='../rattrapage.php' onsubmit="var Nwin = window.open('../rattrapage.php', 'Nwin', 'width=430,height=230,toolbar=no,location=no,directories=no, status=no,scrollbars=no,resizable=no,menubar=no'); return true;" target='Nwin'  >
<input type="submit" value="<?php print "Rattrap." ?>" name='acces' class="btn btn-primary btn-sm pull-right vat-btn-footer"  title="Rattrapage" >
<input type="hidden" name=idrattrappage value="<?php print $idrattrapage?>" />
</form>
</td>
</TR>
<?php
	}

	$nbabs=$nbjoursabs * 2;
?>

</table>
<BR>
<!-- 
<form method=post action="gestion_abs_retard_impr.php" >
<input type=submit  value="Imprimer Rtd/Abs de <?php print ucwords(trim($data[$i][1]))." ".ucwords(trim($data[$i][2])) ?>" STYLE="font-family: Arial;font-size:10px;color:#CC0000;background-color:#CCCCFF;font-weight:bold;" />
<input type='hidden' name="idEleve" value="<?php print $data[$i][3]?>" />
<input type='hidden' name="saisie_nom_eleve" value="<?php print trim($_POST["saisie_nom_eleve"]) ?>" />
</form>
-->

<BR><BR>
<?php
	print "<script>document.getElementById('cumul$i').innerHTML=\"Nbr de retards: $cumulretard / Nbr d'absences: $nbabs demi-journ&eacute;e(s) - $nbheureabs heure(s)\"; </script>";
	}
	$cumulretard=0;
	$nbabs=0;
	$nbheureabs=0;
	
}


// $cumulretard
// $nbabs
// $nbheureab


?>


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
