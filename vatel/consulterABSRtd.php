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
	<script language="JavaScript" src="./librairie_js/lib_absrtdplanifier.js"></script>

	<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL47  ?></span>
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
<br>
<font class='T2'>&nbsp;&nbsp;<?php print LANGABS37 ?> :</font>
<a href="#" onclick="print_abs_rtd_du_jour();"><img src="../image/commun/print.gif" align=center border=0 alt="Imprimer tous"></A>
<a href="#" onclick="print_abs_rtd_du_jour_2();"><img src="../image/commun/print2.gif" align=center border=0 alt="Imprimer seulement les inconnus"></A>
<br><br>
<form method='post' name="formulaire" >
<font class=T2><?php print LANGMESS158 ?> : </font><select name="sClasseGrp" size="1" >
<?php 
if ($filtreCLasse != "tous") {
	$classeS=chercheClasse($filtreCLasse);
	print "<option value='$filtreCLasse' id='select0' >".$classeS[0][1]."</option>";
	print "<option value='tous' id='select0' >Aucun</option>";
}else{
	print "<option id='select0' value='tous' >".LANGCHOIX."</option>";
}
select_classe(); // creation des options ?>
</select>
&nbsp;&nbsp;&nbsp;
<input type='text' name='saisie_date' value="<?php print $date?>"  onclick="this.value=''" size=12   onKeyPress="onlyChar(event)">
<?php
include_once("../librairie_php/calendar.php");
calendarVatel("id1","document.formulaire.saisie_date",$_SESSION["langue"],"0");
?>&nbsp;&nbsp;
<input type='submit' name="modif_date" value="<?php print LANGBT28 ?>"   class="btn btn-primary btn-sm  vat-btn-footer"  >
<br><br><br>
<input type='button' value="<?php print LANGABS74?>" onclick="open('gestion_abs_retard_du_jour_misaj.php?date=<?php print dateFormBase($date)?>&filtre=<?php print $filtreCLasse?>','_parent','')"  class="btn btn-primary btn-sm  vat-btn-footer"  >
</form><br><br>
<font class="T2">
<?php
	$data=recup_abs_rtd_aucun($date);
	// id,classe,date,heure,matiere,nbabs,nbrtd
	if (count($data) > 0) {
		print "<br><br><b>Abs, rtd effectués.</b> <br><br>";
		print "<div style=\"width:400; height:180; overflow:auto; border:solid 0px black;\" >";
		for($j=0;$j<count($data);$j++) {
			$nbabs=$data[$j][5];
			$nbrtd=$data[$j][6];
			if (empty($nbabs)) {
				print ucwords(LANGABS33)." ". $data[$j][1]." (".trim(trunchaine($data[$j][4],20)).") ".LANGABS76." ".timeForm($data[$j][3])."<br><ul><i>0 absence / 0 retard</i></ul>" ;
			}else{
				print ucwords(LANGABS33)." ". $data[$j][1]." (".trim(trunchaine($data[$j][4],20)).") ".LANGABS76." ".timeForm($data[$j][3])."<br><ul><i>$nbabs absence(s) / $nbrtd retard(s)</i></ul>" ;
			}

		}
		print "<div>";
		print "<br><hr width=50%>";
	}
?>
</font>
</ul>
<?php
// affichage de la liste d'élèves trouvées
$date_du_jour=$date;
?>
<table border="1" bordercolor="#000000" width="100%" style="border-collapse:collapse;padding:10px " >
<tr>
<TD bgcolor=black width='30%'><font color='#FFFFFF'><b><?php print LANGNA1?> <?php print LANGNA2?> / <?php print LANGELE4?></b> </font></TD>
<TD bgcolor=black width='20%'><font color='#FFFFFF'><b><?php print LANGABS20?></b></font></TD>
<TD bgcolor=black ><font color='#FFFFFF'><b><?php print LANGABS22?></b></font></TD>
<TD bgcolor=black ><font color='#FFFFFF'><b><?php print LANGABS38?></b></font></TD>
<?php
	$data_2=affRetarddujour3($date);
	//  elev_id, heure_ret, date_ret, date_saisie, origin_saisie, duree_ret, motif, idmatiere, justifier, heure_saisie, smsenvoye
	// $data : tab bidim - soustab 3 champs
	for($j=0;$j<count($data_2);$j++) {
		
		$color=($color=="#87C1E6") ? $color="#BCDAF0" : $color="#87C1E6" ; 
		
		$ideleve=$data_2[$j][0];
		$idmatiere=$data_2[$j][7];
		$originesaisie=$data_2[$j][4];
		$etude="";
		if ($idmatiere < 0) { $etude="En Etude "; }

		if ($data_2[$j][11] == '1') { $imgsms="<br><img src='../image/commun/sms.gif' title='SMS ENVOYE' width='20' height='18' align='center'/>"; }else{ $imgsms=""; }

		if ($idmatiere != null) {
			$nomMatiere=chercheMatiereNom($idmatiere);
		}
		if ((strtolower($data_2[$j][6]) != "inconnu") && ($data_2[$j][5] != 0 ) ){
			$color="#FFFF99";
		}
		$classe=chercheIdClasseDunEleve($ideleve);
		if (($filtreCLasse != $classe) && ($filtreCLasse != "tous")) {
			continue;
		}
		$classe=chercheClasse($classe);

		if ($data_2[$j][9] != "") {
			$heuresignale=timeForm($data_2[$j][9]);
		}else{
			$heuresignale="??:??";
		}

		if ($nomMatiere == "") { $nomMatiere=LANGSMS2; }

		$photoeleve="../image_trombi.php?idE=".$ideleve;	
		$regime=recupRegime($ideleve);	
		if ($regime != "") $regime=" (<i>$regime</i>)";

		
?>

	<tr bgcolor='<?php print $color ?>' >
	<td id='bordure' valign="top"><b><?php 
	$infoProba=getProbaEleve($ideleve);
	if ($infoProba == 1) {
        	$infoprobatoire="<img src='../image/commun/important.png' title=\"En p&eacute;riode probatoire !!\" />";
	}else{
        	$infoprobatoire="";
	}
	print "$infoprobatoire &nbsp;".strtoupper(recherche_eleve_nom($ideleve))." "; ?></b> <?php print ucwords(strtolower(trunchaine(recherche_eleve_prenom($ideleve),10)))?><?php print $regime ?> / <?php print LANGBULL33 ?> : <?php print $classe[0][1]?> / <?php print LANGASS18 ?> : <?php print trunchaine($nomMatiere,25) ?> </td>	
	<td id='bordure' valign="top" >&nbsp;<?php print LANGABS13 ?> <?php print dateForm($data_2[$j][2]); ?> - <?php print timeForm($data_2[$j][1]) ?>   <br>&nbsp;<i><?php print LANGVATEL46 ?><?php print dateForm($data_2[$j][3])." - ".$heuresignale ?></i>
	<br>&nbsp;<?php print LANGDISC9 ?> <?php print $originesaisie ?> </td>
	<td align='left' valign='top' id='bordure' >&nbsp;
	<?php $motiftext=$data_2[$j][6]; if ($data_2[$j][6] == "inconnu") { $motiftext=LANGINCONNU; } if (trim($data_2[$j][6]) == "0") { $motiftext=LANGINCONNU; } $motiftext=ereg_replace('"',"",$motiftext); $motiftext=ereg_replace("'","\'",$motiftext);?>
	<?php print $motiftext ?>
	</td>
	<td align='left' id='bordure'>&nbsp;<?php print "Portable 1 " ?> : <b><?php print cherchetelportable1($ideleve)?> </b> <br>&nbsp;<?php print "Portable 2 " ?> : <b><?php print cherchetelportable2($ideleve)?> </b>
	<BR>&nbsp;<?php print LANGABS39?> : <b><?php print cherchetelpere($ideleve)?></b><BR>&nbsp;<?php print LANGABS40?> : <b><?php print cherchetelmere($ideleve)?> </b> <br>&nbsp;Email : <b><?php print cherchemail($ideleve)?> </b>  </FONT>
	</td>
	</TR>
<?php
      }
    	print "<tr><td colspan='6' bgcolor='#CCCCCC' heigth='5'>&nbsp;</td></tr>";
	$data_3=affAbsence4($date);
	//  elev_id, date_ab, date_saisie, origin_saisie, duree_ab ,date_fin, motif, duree_heure, id_matiere,heure_saisie,justifier,heuredabsence
	// $data : tab bidim - soustab 3 champs
	for($j=0;$j<count($data_3);$j++) {
		$ideleve=$data_3[$j][0];
		$idmatiere=$data_3[$j][8];
		$heureabs=timeForm($data_3[$j][11]);
		$nomMatiere=chercheMatiereNom($idmatiere);
		$classe=chercheIdClasseDunEleve($data_3[$j][0]);
		$regime=recupRegime($ideleve);	
		if ($regime != "") $regime=" (<i>$regime</i>)";
		if (($filtreCLasse != $classe) && ($filtreCLasse != "tous")) {
			continue;
		}
                $classe=chercheClasse($classe);
                if ((strtolower($data_3[$j][6]) != "inconnu")  && ($data_3[$j][4] != 0 ) ){
                        $color="#FFFF99";
                }
		$photoeleve="image_trombi.php?idE=".$ideleve;
		if ($nomMatiere == "") { $nomMatiere=LANGSMS2; }
		if ($data_3[$j][13] == '1') { $imgsms="<br><img src='../image/commun/sms.gif' title='SMS ENVOYE' width='20' height='18' align='center'/>"; }else{ $imgsms=""; }
?>
	<tr  bgcolor='<?php print $color ?>' >
	<td id='bordure' valign="top"><?php 
	$infoProba=getProbaEleve($ideleve);
        if ($infoProba == 1) {
                $infoprobatoire="<img src='../image/commun/important.png' title=\"En p&eacute;riode probatoire !!\" />";
        }else{
                $infoprobatoire="";
        }

        print "$infoprobatoire &nbsp; <b>".strtoupper(recherche_eleve_nom($ideleve)).""; ?></b> <?php print ucwords(strtolower(recherche_eleve_prenom($ideleve)))?><?php print $regime ?> / <?php print LANGBULL33 ?> : <?php print $classe[0][1]?> / <?php print LANGASS18 ?> : <?php print trunchaine($nomMatiere,25) ?> </td>
	<td id='bordure' valign="top" >&nbsp;<?php print LANGABS42 ?> <?php 
		if ($data_3[$j][4] >= 0) {
			print dateForm($data_3[$j][1])?> <br />&nbsp;A <?php print $heureabs ?> <?php print LANGABS43?> <?php
			if ($data_3[$j][4] == 0) {
				print "???";
			}else {
				print $data_3[$j][4];
				print " ".LANGABS44;
			}
		}else{
			print dateForm($data_3[$j][1])?> <br />&nbsp;A <?php print $heureabs ?> <?php print LANGABS43?> <?php
			print  preg_replace('/\./','h',$data_3[$j][7]);
		}
		if ($data_3[$j][9] != "") {
			$heuresignale=timeForm($data_3[$j][9]);
		}else{
			$heuresignale="??:??";
		}
	?> 
	<br>&nbsp;<i> <?php print LANGVATEL46 ?> <?php print dateForm($data_3[$j][2])." - ".$heuresignale ?></i> </td>
	<td valign='top' id='bordure'>&nbsp;
	<?php $motiftext=$data_3[$j][6]; if ($data_3[$j][6] == "inconnu") { $motiftext=LANGINCONNU; } if (trim($data_3[$j][6]) == "0") { $motiftext=LANGINCONNU; } $motiftext=ereg_replace('"',"",$motiftext); $motiftext=ereg_replace("'","\'",$motiftext); ?>
	<?php print $motiftext?>
	</td>
	<td valign='top' id='bordure'>&nbsp;
	<font size=2><?php print LANGABS41?> : <b><?php print cherchetel($ideleve)?></B> <BR>&nbsp;<?php print "Portable 1 " ?> : <b><?php print cherchetelportable1($ideleve)?> </b> 
	<br>&nbsp;<?php print "Portable 2 " ?> : <b><?php print cherchetelportable2($ideleve)?> </b> <BR>&nbsp;<?php print LANGABS39?> : <b><?php print cherchetelpere($ideleve)?></b><BR>&nbsp;<?php print LANGABS40?> : <b><?php print cherchetelmere($ideleve)?> </b> 
	<br>&nbsp;Email : <b><?php print cherchemail($ideleve)?> </b>  </FONT>
	</td>
	</TR>
<?php
		}

	$data_4=affDispence3($date);
	//  elev_id, code_mat, date_debut, date_fin, date_saisie, origin_saisie, certificat, motif, heure1, jour1, heure2, jour2, heure3, jour3
	// $data : tab bidim - soustab 3 champs
	for($j=0;$j<count($data_4);$j++) {
	
		$aujourdhui=dateD();
		if ($aujourdhui == "Mon") { $aujourdhui="Lundi";    }
		if ($aujourdhui == "Tue") { $aujourdhui="Mardi";    }
		if ($aujourdhui == "Wed") { $aujourdhui="Mercredi"; }
		if ($aujourdhui == "Thu") { $aujourdhui="Jeudi";    }
		if ($aujourdhui == "Fri") { $aujourdhui="Vendredi"; }
		if ($aujourdhui == "Sat") { $aujourdhui="Samedi";   }
		if ($aujourdhui == "Sun") { $aujourdhui="Dimanche"; }

		if ($aujourdhui == trim($data_4[$j][9])) { $heure_jour="<BR> à ".trim($data_4[$j][8])." (heure)"; }
		if ($aujourdhui == trim($data_4[$j][11])) { $heure_jour="<BR> à ".trim($data_4[$j][10])." (heure)"; }
		if ($aujourdhui == trim($data_4[$j][13])) { $heure_jour="<BR> à ".trim($data_4[$j][12])." (heure)"; }

                $ideleve=$data_4[$j][0];
		$classe=chercheIdClasseDunEleve($ideleve);
		if (($filtreCLasse != $classe) && ($filtreCLasse != "tous")) {
			continue;
		}
                $classe=chercheClasse($classe);
		$photoeleve="image_trombi.php?idE=".$ideleve;
		$k=$data_4[$j][1];
		$sql="SELECT code_mat, libelle FROM ${prefixe}matieres WHERE  code_mat='$k' ORDER BY code_mat";
		$res=execSql($sql);
		$data_matiere=chargeMat($res);
		$regime=recupRegime($ideleve);	
		if ($regime != "") $regime=" (<i>$regime</i>)";
?>
	<TR bgcolor='<?php print $color ?>' >
        <td id='bordure' valign="top"><b><?php 
	$infoProba=getProbaEleve($ideleve);
        if ($infoProba == 1) {
                $infoprobatoire="<img src='../image/commun/important.png' title=\"En p&eacute;riode probatoire !!\" />";
        }else{
                $infoprobatoire="";
        }

	print "$infoprobatoire ".strtoupper(recherche_eleve_nom($ideleve))?></a></b> <?php print ucwords(strtolower(recherche_eleve_prenom($ideleve)))?><?php print $regime ?><br> <?php print LANGPER25 ?> : <?php print $classe[0][1]?> </td>
	<td id='bordure'>Dispense de <B><?php print $data_matiere[0][1]?></B><BR> du <?php print dateForm($data_4[$j][2])?> au <?php print dateForm($data_4[$j][3])?>
	<?php print $heure_jour?> 
	</td>
	<td align=center id='bordure'>
<?php 		$motiftext=$data_4[$j][7];  
		if ($data_4[$j][7] == "inconnu") { $motiftext=LANGINCONNU; } 
		if (trim($data_4[$j][7]) == "0") { $motiftext=LANGINCONNU; } 
		$motiftext=ereg_replace('"',"",$motiftext); 
		$motiftext=ereg_replace("'","\'",$motiftext);
	?>
	<?php print $motiftext?>
	</td>
	<td  align=center id='bordure'>
	<font size=2> <?php print LANGABS41?> : <b><?php print cherchetel($ideleve)?></B> <BR> <?php print "Portable 1 " ?> : <b><?php print cherchetelportable1($ideleve)?> </b> 
	<br> <?php print "Portable 2 " ?> : <b><?php print cherchetelportable2($ideleve)?> </b> <BR> <?php print LANGABS39?> : <b><?php print cherchetelpere($ideleve)?></b>
	<BR> <?php print LANGABS40?> : <b><?php print cherchetelmere($ideleve)?> </b> <br> Email : <b><?php print cherchemail($ideleve)?> </b>  </FONT>
	</td>
	</TR>

<?php
		}
print "</table>";
?>
		<br><br><br><br><br>
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
