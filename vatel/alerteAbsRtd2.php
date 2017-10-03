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

<!-- // fin  -->
<?php
$dateDuJour=dateDMY();
$nb=$_POST["nb"];
for($i=0;$i<$nb;$i++) {
	list($idEleve,$datedebut,$datefin,$duree,$heure,$minute,$seconde) = split(":",$_POST["liste"][$i]);
	if ($idEleve == "")  { continue; }	

		
	$dureeunite="";
	if (preg_match('/heure\(s\)$/',$duree)) {
		$duree=preg_replace("/heure(s)/","",$duree);
		$dureeunite="heure(s)";
	}
	$duree=trim($duree);
	
	// declaration variable
	
	
	$datedebut=dateForm($datedebut);
	$datefin=dateForm($datefin);

	if ($datedebut == $datefin) {
		$dateaffiche="
	le $datedebut";
	}else{
		$dateaffiche="
	du $datedebut au $datefin";
	}
/*
	$nomEleve
	$prenomEleve
	$classe_nom
	$datedebut
	$datefin
	$duree
	$NomResponsable1
	$listingABS
	$dateDuJour
 */

	enrHistoEleve($idEleve,$date,"Envoi email absence non justifiée","");
	valideEnvoiCourrier($idEleve,$datedebut,$datefin,"$heure:$minute:$seconde");

	$message="$dateaffiche d'une durée de $duree \n";
	$tabMail["$idEleve"].=$message;
}

foreach($tabMail as $idEleve => $messageabs) {
	$nomEleve=strtoupper(recherche_eleve_nom($idEleve));
	$prenomEleve=recherche_eleve_prenom($idEleve);
	$idClasse=chercheIdClasseDunEleve($idEleve);
	$classe_nom=strtoupper(chercheClasse_nom($idClasse));
	// adresse de l'élève
	// elev_id,nomtuteur, prenomtuteur, adr1, code_post_adr1, commune_adr1, adr2, code_post_adr2, commune_adr2, numero_eleve, class_ant, date_naissance, regime, civ_1, civ_2,nom,prenom,nom_resp_2,prenom_resp_2,lieu_naissance
	$dataadresse=chercheadresse($idEleve);
	$nomtuteur=strtoupper($dataadresse[0][1]);
	$prenomtuteur=$dataadresse[0][2];
	$NomResponsable1=strtoupper($nomtuteur);
	$civ_1=civ($dataadresse[0][13]);

	$idsite=chercherIdSiteClasse($idClasse);
	$data=visu_paramViaIdSite($idsite);
        //nom_ecole,adresse,postal,ville,tel,email,directeur,urlsite,academie,pays,departement,annee_scolaire FROM
	for($i=0;$i<count($data);$i++) {
		$nom_etablissement=trim($data[$i][0]);
	       	$mail=trim($data[$i][5]);
  	}
	$message="

	Bonjour $civ_1 $NomResponsable1,

	Nous vous informons que votre enfant $nomEleve $prenomEleve fût absent(e) :
	$messageabs

	Merci de nous contacter afin de justifier ce ou ces absences.

";
	$objet="VATEL :  Absence(s) de $nomEleve $prenomEleve";
	$objet=TextNoAccent($objet) ;
	$objet=stripslashes($objet);
	$sujet = "$nom_etablissement : $objet";
	$nom_expediteur=expediteur_triade();
	$email_expediteur=MAILREPLY;
	$message=TextNoAccent($message);
	$email_expediteur=trim($email_expediteur);
	$emailparent1=cherchemailparent($idEleve);
	if (ValideMail($emailparent1)) {
		$to=$emailparent1;
		mailTriade($sujet,$message,$message,$to,$email_expediteur,$email_expediteur,$nom_expediteur,"");
	}

	$emailparent2=cherchemailparent2($idEleve);
	if (ValideMail($emailparent2)) {
		$to=$emailparent2;
		mailTriade($sujet,$message,$message,$to,$email_expediteur,$email_expediteur,$nom_expediteur,"");
	}

}

?>

<br />
<br />
<center><?php print "Email Envoyé(s)" ?></center>
<br><br>
<!-- // fin  -->

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
