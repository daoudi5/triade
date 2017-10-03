<?php
session_start();
include_once('../librairie_php/timezone.php');
include_once('../common/config.inc.php');
include_once('../librairie_php/db_triade.php');
include_once('../librairie_php/langue.php');
$cnx=cnx2();

if (isset($_COOKIE["langue-triade"])) {
        $lang=$_COOKIE["langue-triade"];
}else{
        $lang="fr";
}

if (strtolower($lang) == "fr") { include_once("../librairie_php/langue-text-fr.php"); }
if (strtolower($lang) == "en") { include_once("../librairie_php/langue-text-en.php"); }

$start=$_POST["start"];
$end=$_POST["end"];
$idclasse="";
$idprof=$_SESSION['id_pers'];
$idRessource="";

if (isset($_SESSION["idprofviaadmin"])) {
	$idprof=$_SESSION["idprofviaadmin"];
}

$data=listEdt($start,$end,$idclasse,$idprof,$idRessource,$_SESSION["membre"]);
// code,enseignement,date,heure,duree,bgcolor,idclasse,idprof,prestation,idmatiere,coursannule,docdst,reportle,reporta,idressource,id_resa_liste,idgroupe

$event_array = array();
for($i=0;$i<count($data);$i++) {
	$titre=$data[$i][1];
	$date=$data[$i][2];
	$heure=$data[$i][3];
	$duree=$data[$i][4];
	$start="$date $heure";
	list($annee,$mois,$jour)=split('-',$date);
	list($h,$M,$s)=split(':',$heure);
	$id=$data[$i][0];

	$s=conv_en_seconde($heure);	
	$s+=conv_en_seconde($duree);	
	$heureFin=calcul_hours($s);

	$nomMatiere=chercheMatiereNom($data[$i][9]);
        $nomMatiere2=$nomMatiere;
        $coursannule=$data[$i][10];
        $reportle=$data[$i][12];
        $reporta=$data[$i][13];
        $docdst=$data[$i][11];
        $idgroupe=$data[$i][16];
        $Nomclasse=chercheClasse_nom($data[$i][6]);
        if ($idgroupe == 0) {
                $groupelibelle="";
                $grpinfo="";
        }else{
                $groupelibelle=chercheGroupeNom($idgroupe);
                $grpinfo=" groupe : ".$groupelibelle."\n";
        }
        if ($data[$i][15] > 0) { $valideresa=verifResaValider($data[$i][15]); }else{ $valideresa="aucun"; }
        $ressource=recherche_ressource($data[$i][14]);
		if ($ressource != "") $ressource="\nSalle : $ressource";
        $idprof=$data[$i][7];  $nomProf=recherche_personne($idprof);
        if ($nomMatiere != "")  { $nomMatiere="Matière : ".trunchaine($nomMatiere,15); }else{ $nomMatiere=""; }
        if ($nomProf != "")     { $nomProf2=$nomProf ; $nomProf="Ens : ".$nomProf; }else{ $nomProf="";$nomProf2=""; }

        $imgreportele="";
        if ($coursannule == 1) {
                if ($reportle != 0000-00-00) {
                        $reportepourleV="Ce cours est reporté pour le ".dateForm($reportle)." &agrave; $reporta";
                        $reportepourleT=" - Reporté le ".dateForm($reportle)." &agrave; $reporta ";
                }else{
                        $reportepourleT=" - Cours pas encore reporté ";
                        $imgreportele="<img src='image/commun/important.png' title='Cours pas encore report&eacute;'/>";
                }
        }
		if ($reportepourleV != "") $reportepourleV="\n$reportepourleV\n$reportepourleT";
        $bgcolor=$data[$i][5];
        if ($bgcolor == "") { $bgcolor="#2199da"; }



	if ($coursannule == "1") {
                $u="<s>"; $uf="</s>"; $Utxt="- Annulé  $reportepourleT ";
        }else{
                $u="";$uf="";$Utxt="";
        }

		
	if ($nomMatiere != "") $nomMatiere="\n$nomMatiere";
	if ($nomProf2 != "") $nomProf2="\nEns : $nomProf2";

	
	$description="$description";
        $objet="$nomMatiere2 ($Nomclasse)";
        if ($nomProf2 != "") { $objet.=" par $nomProf2"; }

	$end="$date $heureFin";	
        $event_array[] = array(
            'id' => "$id",
            'title' => "$titre$nomMatiere$nomProf2$reportepourleV$ressource",
            'start' => "$start",
            'end' => "$end",
            'allDay' => false,
	    'color' => "$bgcolor"
        );


}
echo json_encode($event_array);
Pgclose(); 
?>
