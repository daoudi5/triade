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
			<span class="vat-capitalize-title"><?php print "Gestion Absences / Retards"  ?></span>
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
<br>
<center><font class='T2'> <B> <?php print LANGABS28?></B></font></center>
<br><br><br><br><br><br><br><br><br><br>
<?php
$id=$_POST["saisie_id"];

if ($_POST["retard_aucun"] == "oui") {
	aucun_retard($_POST["nomclasse"],$_POST["nommatiere"],$_SESSION["nom"],$_SESSION["prenom"],$_POST["datedepart"]);
	history_cmd($_SESSION["nom"],"RTD/ABS","enr. via prof");
}else{

	for ($i=0;$i<$id;$i++) {
		$motif="saisie_".$i;
		$heure="saisie_heure";
		$duree="saisie_duree_".$i;
		$duree1="saisie_duree1_".$i;
		$pers="saisie_pers_".$i;
		$raison="saisie_motif_".$i;
	/*
		print "<BR>a)";
		print $_POST[$motif];
		print "<BR>b)";
		print $_POST[$heure];
		print "<BR>c)";
		print $_POST[$duree];
		print "<BR>d)";
		print $_POST[$pers];
		print "<BR>e)";
		print "Par ".$_SESSION["nom"];
		print "<BR>f)";
		print $_POST["idmatiere"];
		print "<BR>g)";
		print $_POST["idprof"];
		print "<BR>h)";
		print $_POST[$raison];
		print "<BR>i)";
		print $_POST[$duree1];
		print "<hr>";
	 */

		$etape=$_POST[$duree];
		$idmatiere=$_POST["idmatiere"];
		$justifier="saisie_justifie_$i";

		if ($_POST[$justifier] != 1) {
			$justifier=0;
		}else{
			$justifier=1;
		}
		
		$heure=$_POST[$heure];
		list($horaireLibelle,$heure,$horaireFin)=split('#',$heure);
		$creneaux="$horaireLibelle#".timeForm($heure)."#".timeForm($horaireFin);
		$refRattrapage="";
		if ($_POST[$motif] == "retard" ) {

			if ($idmatiere == "") { $idmatiere="-1"; }

			$cr=create_retard($heure,$_POST[$duree],$_POST["datedepart"],$_POST[$pers],dateDMY2(),$_SESSION["nom"],$_POST[$raison],$idmatiere,$justifier,$_POST["idprof"],$creneaux);
			if($cr == 1){
				history_cmd($_SESSION["nom"],"RTD","enr. via Vie Scolaire");
	        }else {
				print "&nbsp;&nbsp;- ".LANGacce1." ".recherche_eleve_nom($_POST[$pers])." ".recherche_eleve_prenom($_POST[$pers])." ".LANGABS55.".<br>";
        	
			}
		}

		if ($_POST[$motif] == "absent" ) {
			$duree=$_POST[$duree];
			if ($_POST[$duree] == "autre") {
				$duree=$_POST[$duree1];
			}
			if ($etape == "heure") {
				$heure=strtoupper($_POST[$duree1]);
				$heure=ereg_replace('H','.',$heure);
			}
			$cr=create_absent($duree,$_POST["datedepart"],$_POST[$pers],dateDMY2(),$_SESSION["nom"],$_POST[$raison],$idmatiere,$justifier,$heure,$_POST["idprof"],$creneaux,$refRattrapage);

	        if($cr == 1){
				history_cmd($_SESSION["nom"],"ABS","enr. via Vie Scolaire");
			}else {
		                print "&nbsp;&nbsp;- ".LANGacce1." ".recherche_eleve_nom($_POST[$pers])." ".recherche_eleve_prenom($_POST[$pers])." ".LANGABS54.".<br>";
	        }
		}
	}
}
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
