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
?>
<script language="JavaScript" src="../librairie_js/lib_absrtd2.js"></script>
<script language="JavaScript" src="../librairie_js/lib_absrtdplanifier.js"></script>

	<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL47  ?></span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='gestionABSRtdSanc.php' ><?php print LANGVATEL21 ?></a></li>
				<li style="visibility:visible" ><a href='consulterABSRtd.php' ><?php print LANGBT28 ?></a></li>
				<li style="visibility:visible" ><a href='alerteAbsRtd.php' ><?php print "Alerte Absences" ?></a></li>
                                <li style="visibility:visible" ><a href='alerteAbsRtdSMS.php' ><?php print "Alerte SMS" ?></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

		<?php
$taille="width='100%' height='100%'"; 
// affichage de la liste d'élèves trouvées
$user=$_SESSION["nom"];
$nb_pers=$_POST["nb_pers"];

for($i=0;$i<$nb_pers;$i++)  {
	$id_i=$_POST["id_i"][$i];
	$refRattrapage="idrattrapage$id_i";
	$refRattrapage=$_POST[$refRattrapage];
	suppRattrappage($refRattrapage);
}


for($i=0;$i<$nb_pers;$i++)  {
	$id_i=$_POST["id_i"][$i];

	$rattra_heure_1="";
	$rattra_date_1="";
	$rattra_duree_1="";
	$rattra_heure_2="";
	$rattra_date_2="";
	$rattra_duree_2="";
	$rattra_heure_3="";
	$rattra_date_3="";
	$rattra_duree_3="";

	$type="saisie_$id_i";
	$duree="saisie_duree_$id_i";
	$motif="saisie_motif_$id_i";
	$heure="saisie_heure_$id_i";
	$heure2="saisie_heure_2$id_i";
	$id_eleve="saisie_pers_$id_i";
	$justifier="saisie_justifier_$id_i";
	$heurederetard="heurederetard_$id_i";
	$idmatiere="matiere_$id_i";
	$time="time_$id_i";

	$rattra_heure_1="rattra_heure_1$id_i";
	$rattra_date_1="rattra_date_1$id_i";
	$rattra_duree_1="rattra_duree_1$id_i";
	$rattra_heure_2="rattra_heure_2$id_i";
	$rattra_date_2="rattra_date_2$id_i";
	$rattra_duree_2="rattra_duree_2$id_i";
	$rattra_heure_3="rattra_heure_3$id_i";
	$rattra_date_3="rattra_date_3$id_i";
	$rattra_duree_3="rattra_duree_3$id_i";

	$refRattrapage="idrattrapage$id_i";

	$rattra_heure_1=$_POST[$rattra_heure_1];
	$rattra_date_1=$_POST[$rattra_date_1];
	$rattra_duree_1=$_POST[$rattra_duree_1];
	$rattra_heure_2=$_POST[$rattra_heure_2];
	$rattra_date_2=$_POST[$rattra_date_2];
	$rattra_duree_2=$_POST[$rattra_duree_2];
	$rattra_heure_3=$_POST[$rattra_heure_3];
	$rattra_date_3=$_POST[$rattra_date_3];
	$rattra_duree_3=$_POST[$rattra_duree_3];
	$departideleve=$_POST[$id_eleve];

	$refRattrapage=$_POST[$refRattrapage];

	$type=$_POST[$type];
	$duree=$_POST[$duree];
	$motif=$_POST[$motif];
	$heure=$_POST[$heure];
	$heure2=$_POST[$heure2];
	$justifier=$_POST[$justifier];
	$datecal=dateFormBase($_POST["datecal"]);


	$nomeleve=recherche_eleve($departideleve);

	$base_depart=$_POST["base_depart"][$i];
	$departdate=$_POST["departdate"][$i];
	$departdatesaisie=$_POST["departdatesaisie"][$i];
	$departheurertd=$_POST[$heurederetard];
	$idmatiere=$_POST[$idmatiere];
	$time=$_POST[$time];
	$heuredoriginret=$_POST["departheurertd"][$i];
	$heuredoriginsaisie=$_POST["heuredatesaisie"][$i];
	$date_de_saisie=$departdatesaisie;
	$heuredabsence=$_POST["heuredabsence"][$i];

	$saisie_date_ret_origine=$departdate;


	print "$type - $base_depart<br>";
	print "$heure<br>";
	print "$departdate<br>";
	print "$departdatesaisie<br>";
	print "$heuredoriginret<br>";
	print "motif => $motif<br>";
	print "time => $time<br>";
	print "Durée => $duree<br>";

	if ($type == "100") {
		supp_absretard($base_depart,$departideleve,$heure,$departdate,$time,$idmatiere);
		continue;
	}
	if (($motif == "inconnu" )  || ($motif == "") || ($duree == "0" )) {
		continue;
	}else{
		if ( ($rattra_date_1 != "") || ($rattra_date_2 != "") || ($rattra_date_3 != "")) {
			if ($refRattrapage == "") $refRattrapage="$departideleve#ref#".rand(0000,9999);
			if ($rattra_date_1 != "") enrRattrappage($refRattrapage,$rattra_date_1,$rattra_heure_1,$rattra_duree_1);
			if ($rattra_date_2 != "") enrRattrappage($refRattrapage,$rattra_date_2,$rattra_heure_2,$rattra_duree_2);
			if ($rattra_date_3 != "") enrRattrappage($refRattrapage,$rattra_date_3,$rattra_heure_3,$rattra_duree_3);
		}	
		if ($type == "absent") {
			if ($base_depart == "retard") {
	                	//$duree,$date,$saisie_pers,$date_saisie,$user,$motif
	                	$cr=create_absent($duree,$heure,$departideleve,$date_de_saisie,$user,$motif,$idmatiere,$justifier,$heure2,$refRattrapage);
				if ($cr) {
					history_cmd($_SESSION["nom"],"Abs/rtd",$nomeleve);
	                 		$departheurertd=ereg_replace("h",":",$departheurertd);
					suppression_retard($departideleve,$departheurertd,$departdate);
				}
			}else {
				if (ereg('/',$heure)) { $heure=dateFormBase($heure); }
				history_cmd($_SESSION["nom"],"Abs/rtd",$nomeleve);
				modif_absence($departideleve,$heure,$date_de_saisie,$user,$motif,$duree,$time,$idmatiere,$justifier,$heuredoriginsaisie,$saisie_date_ret_origine,$heuredabsence,$refRattrapage);
			}
		}
		if ($type == "retard") {
			if ($base_depart == "absent") {
	                 	$departheurertd=ereg_replace("h",":",$departheurertd);
			 	$cr=create_retard2($departheurertd,$duree,$heure,$departideleve,$date_de_saisie,$user,$motif,'',$justifier,$datecal,$refRattrapage);
				if ($cr) {
					history_cmd($_SESSION["nom"],"Abs/rtd",$nomeleve);
						suppression_absence($departideleve,$departdate,$time,$idmatiere);
				}
			 }else {
				history_cmd($_SESSION["nom"],"Abs/rtd",$nomeleve);
				modif_retard($departideleve,$heure,$departdate,$duree,$motif,$date_de_saisie,$user,$justifier,$heuredoriginret,$heuredoriginsaisie,$refRattrapage);
			 }
		}
	}
}
?>
<br>
<br>
<table align=center><tr><td>
<input type='button' value="<?php print LANGGRP61 ?>" onclick="open('gestion_abs_retard_du_jour_misaj.php?date=<?php print $_POST["date_ref"] ?>&filtre=<?php print $_POST["filtre"] ?>','_parent','')"; class="btn btn-primary btn-sm  vat-btn-footer" />
</td></tr></table>
<br>
<br>

		
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
