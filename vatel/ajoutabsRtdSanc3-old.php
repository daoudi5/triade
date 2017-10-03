<?php
session_start();
$anneeScolaire=$_COOKIE["anneeScolaire"];
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
include_once("../common/config.inc.php"); // futur : auto_prepend_file
include_once("../librairie_php/db_triade.php");
include_once("../common/config2.inc.php");
include_once("../librairie_php/timezone.php");

include_once("entete.php");


$cnx=cnx2();
// affichage de la classe
$ident=array('sClasseGrp','cgrp','sMat');
$HPV=hashPostVar($ident);
unset($ident);
$listTmp=explode(":",$HPV[cgrp]);
unset($HPV[cgrp]);
$HPV[cid]=$listTmp[0];
$HPV[gid]=$listTmp[1];
unset($listTmp);
$cl=chercheClasse($HPV[cid]);
$saisie_classe=$HPV[cid];
$nomclasse=$cl[0][1];
$who=" en ". LANGABS31." <font color='red' >".$cl[0][1] ."</font>";
	
	
// ne fonctionne que si au moins 1 élève dans la classe
// nom classe
$nommatiere=chercheMatiereNom($_POST["sMat"]);
include_once("menu.php");

?> 
	<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL34 ?> - <?php print $who." - <font color='green'>".$nommatiere."</font>" ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				
			</ul>
			</div>
		</header>
		
		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px" >
<?php

/*
name="saisie_heure"
name='ideleve_<?php print $i ?>'  
name='saisie_id'   
name='idmatiere'   
name='nomclasse'   
name='nommatiere'  
name='idprof' 		
name='retard_aucun' 
*/


$id=$_POST["saisie_id"];
$date=dateDMY();
$cnx=cnx2();
if ($_POST["retard_aucun"] == "oui") {
	aucun_retard($_POST["nomclasse"],$_POST["nommatiere"],$_SESSION["nom"],$_SESSION["prenom"],$date);
	history_cmd($_SESSION["nom"],"RTD/ABS","enr. via prof");
}else{
	list($horaireLibelle,$heure,$horaireFin)=split('#',$_POST["saisie_heure"]);
	$idprof=$_POST["idprof"];
	$creneaux="$horaireLibelle#".timeForm($heure)."#".timeForm($horaireFin);
	$idmatiere=$_POST["idmatiere"];
	    
	for ($i=0;$i<$id;$i++) {
		$motif="inconnu";
		$duree="????";
		$pers="ideleve_".$i;
		$raison="";
		$justifier=0;
		
		if ($_POST[$pers] != "oui") continue ;
		
		$idpers=$_POST["idpers_$i"];
		if ($idpers <= 0) continue; 
		
		// $duree,$date,$saisie_pers,$date_saisie,$user,$motif,$idmatiere,$justifier,$heuredabsence,$idprof,$creneaux,$refRattrapage
		$cr=create_absent($duree,dateDMY(),$idpers,dateDMY2(),$_SESSION["nom"],$motif,$idmatiere,$justifier,$heure,$idprof,$creneaux,'');
		if($cr == 1){
			$listing.=" - ".recherche_eleve_nom($idpers)." ".recherche_eleve_prenom($idpers)."<br>";
			history_cmd($_SESSION["nom"],"ABS","enr. via prof");
			$nbabs++;
	    }else {
            print "&nbsp;&nbsp;- ".LANGacce1." ".recherche_eleve_nom($idpers)." ".recherche_eleve_prenom($idpers)." ".LANGABS54.".<br>";	        	
		}
		
	}
	enrAbsrtdHisto($_POST["nomclasse"],$_POST["nommatiere"],$_SESSION["nom"],$_SESSION["prenom"],$date,$nbabs,$nbrtd);
}
?>
<font class='T2'><?php print $nbabs ?> <?php print LANGVATEL35 ?>. <br><br><font class='colorText'><?php print $listing ?> </font></font>
<!-- // fin  -->
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
