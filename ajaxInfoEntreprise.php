<?php
session_start();
if ( (empty($_SESSION["nom"])) && (empty($_SESSION["membre"]) ) ) { exit; }

error_reporting(0);
include_once("./common/config.inc.php");
include_once("./librairie_php/db_triade.php");
include_once("./librairie_php/choixlangue.php");
include_once("./librairie_php/langue.php");

$cnx=cnx();
if (isset($_POST["idEntreprise"])) {
	$data=recherche_activite_id($_POST["idEntreprise"]);
	// id_serial,nom,contact,adresse,code_p,ville,secteur_ac,activite_prin,tel,fax,email,info_plus,bonus,nbchambre,siteweb,grphotelier,nbetoile,registrecommerce,siren,siret,formejuridique,secteureconomique,INSEE,NAFAPE,NACE,typeorganisation
	for($i=0;$i<count($data);$i++) {
		$infoEntreprise.="<font class=T2>";
		$infoEntreprise.=utf8_encode(LANGSTAGE39)." : <b><font color=red>".$data[$i][1]."</font></b><br>";

		$infoEntreprise.=utf8_encode("Registre du commerce")." : <b>".utf8_encode($data[$i][17])."</b><br>";
		$infoEntreprise.=utf8_encode("SIREN")." : <b>".utf8_encode($data[$i][18])."</b><br>";
		$infoEntreprise.=utf8_encode("SIRET")." : <b>".utf8_encode($data[$i][19])."</b><br>";
		$infoEntreprise.=utf8_encode("Forme juridique")." : <b>".utf8_encode($data[$i][20])."</b><br>";
		$infoEntreprise.=utf8_encode("Secteur économique")." : <b>".utf8_encode($data[$i][21])."</b><br>";
		$infoEntreprise.=utf8_encode("Secteur INSEE")." : <b>".utf8_encode($data[$i][22])."</b><br>";
		$infoEntreprise.=utf8_encode("Code NAF/APE")." : <b>".utf8_encode($data[$i][23])."</b><br>";
		$infoEntreprise.=utf8_encode("Branche d'activité (NACE)")." : <b>".utf8_encode($data[$i][24])."</b><br>";
		$infoEntreprise.=utf8_encode("Type d'organisation")." : <b>".utf8_encode($data[$i][25])."</b><br>";
 



		$infoEntreprise.=utf8_encode(LANGSTAGE40)." : <b>".utf8_encode($data[$i][7])."</b><br>";
		$infoEntreprise.=utf8_encode(LANGSTAGE28)." : <b>".utf8_encode($data[$i][3])."</b><br>";
		$infoEntreprise.=utf8_encode(LANGSTAGE30)." : <b>".utf8_encode($data[$i][5])."</b><br>";
		$infoEntreprise.=utf8_encode(LANGSTAGE29)." : <b>".utf8_encode($data[$i][4])."</b><br>";
		$infoEntreprise.=utf8_encode(LANGSTAGE27)." : <b>".utf8_encode($data[$i][2])."</b><br>";
		$infoEntreprise.=utf8_encode(LANGSTAGE42)." : <b>".utf8_encode($data[$i][8])." / ".utf8_encode($data[$i][9])." </b><br>";
		$infoEntreprise.=utf8_encode(LANGSTAGE36)." : <b>".utf8_encode($data[$i][10])." </b><br>";
		$infoEntreprise.="Site web :     <b>".$data[$i][14]." </b><br>";
		$infoEntreprise.=utf8_encode("Groupe Hôtelier ").": <b>".utf8_encode($data[$i][15])."</b><br>";
		$infoEntreprise.=utf8_encode("Nbr d'étoiles ").": <b>".$data[$i][16]."</b><br>";
		$infoEntreprise.="Nbr Chambres : <b>".$data[$i][13]."</b><br>";
		$infoEntreprise.=utf8_encode(LANGSTAGE37)." : <b>".utf8_encode($data[$i][11])."</b><br>";
		$infoEntreprise.="</font>";
	}
}
if (trim($infoEntreprise) == "") { 
	$infoEntreprise="<center><font class='T2'>AUCUNE INFORMATION</font></center>";	
}
Pgclose();
sleep(1);
print $infoEntreprise;

?>
