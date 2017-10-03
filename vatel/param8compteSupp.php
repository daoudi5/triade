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
 
$anneeScolaire=$_COOKIE["anneeScolaire"];
if (isset($_POST["anneeScolaire"])) {
        $anneeScolaire=$_POST["anneeScolaire"];
        setcookie("anneeScolaire",$anneeScolaire,time()+36000*24*30);
}

include_once("entete.php");
include_once("menu.php");
include_once("../common/config2.inc.php");
$cnx=cnx2();
validerequete("menuadmin");
$type=$_GET["type"];

if ($type == "TUT") $titre=LANGVATEL59;
if ($type == "ENS") $titre=LANGVATEL267;
if ($type == "ADM") $titre=LANGVATEL61;
if ($type == "MVS") $titre=LANGVATEL62;

if ($type == "TUT") $titre2=LANGVATEL268;
if ($type == "ENS") $titre2=LANGVATEL268;
if ($type == "ADM") $titre2=LANGVATEL268;
if ($type == "MVS") $titre2=LANGVATEL268;
?>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print $titre ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param8.php' ><?php print "Menu" ?></a></li>
				<li style="visibility:visible" ><a href='param8compte.php?type=<?php print $type ?>' ><?php print LANGASS8 ?></a></li>
				<li style="visibility:visible" ><a href='param8compteModif.php?type=<?php print $type ?>' ><?php print $titre ?></a></li>
				<li style="visibility:visible" ><a href='param8compteSupp.php?type=<?php print $type ?>' ><?php print $titre2  ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

		<table width=100%>
<?php

if(isset($_GET["saisie_idsupp"])) {
	validerequete("menuadmin");

	if ($type == "ENS") { 
	        $personne=recherche_personne($_GET["saisie_idsupp"]);
	        $cr=@verif_utiliser($_GET["saisie_idsupp"]);
	        if ($cr) {
	                $cr=suppression_personnel($_GET["saisie_idsupp"]) ;
	                if($cr){
	                        @delete_comptaVacation($_GET["saisie_idsupp"]);
	                        @delete_profp($_GET["saisie_idsupp"]);
	                        @delete_prof_com($_GET["saisie_idsupp"]);
	                        @suppEntretienEnseignentPourEtudiant($_POST["saisie_idsupp"]);
	                        @unlink("../data/image_pers/$_GET[saisie_idsupp].gif");
	                        @unlink("../data/image_pers/$_GET[saisie_idsupp].jpg");
        	                $fichier="../data/pdf_bull/edition_".$_SESSION["saisie_idsupp"].".pdf";
	                        @unlink($fichier);
	                        $image="../data/pdf_bull/graph_".$_SESSION["id_pers"].".jpg";
	                        @unlink($image);
	                        alertJs("Compte supprimé --  Service Triade");
	                        history_cmd($_SESSION["nom"],"SUPPRESSION","$personne");
        	                reload_page('suppression_compte_prof.php');
		                }
	        }else {
	                $listematiere=listingMatiereProf($_GET["saisie_idsupp"],'tous');
	                for($i=0;$i<count($listematiere);$i++) {
	                        $classe=chercheClasse_nom($listematiere[$i][1]);
	                        $matiere=chercheMatiereNom($listematiere[$i][0]);
	                        $info.="- En $classe matière $matiere\\n";
	                }
	                alertJs("Impossible de supprimer ce compte. \\n\\n Compte affecté à une classe. \\n\\n$info \\n\\n  Service Triade");
	        }
	}else{
		$personne=recherche_personne($_GET["saisie_idsupp"]);
                $cr=suppression_personnel($_GET["saisie_idsupp"]) ;
                if($cr){
                        @delete_comptaVacation($_GET["saisie_idsupp"]);
                        @unlink("../data/image_pers/".$_GET["saisie_idsupp"].".gif");
                        @unlink("../data/image_pers/".$_GET["saisie_idsupp"].".jpg");
                        alertJs(LANGSUPP6);
                        history_cmd($_SESSION["nom"],"SUPPRESSION",$personne);
                }
	}
}

$data=affPers($type);
for($i=0;$i<count($data);$i++) {
	$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
	print "<tr bgcolor='$bgcolor' >\n";
	print "<td >&nbsp;&nbsp;".civ($data[$i][1])." ".strtoupper($data[$i][2])."</a></td>\n";
	print "<td >".ucfirst($data[$i][3])."</td>\n";
	$imgmail="";
	if (trim($data[$i][6]) != "") {
		$imgmail="<a href='mailto:".$data[$i][6]."' target='_blank' title='".$data[$i][6]."' ><img src='../image/commun/email.gif' border='0' /></a>";
	}else{
		$imgmail="";
	}
	print "<td width='5%' >$imgmail</td>\n";
	print "<td width=5><input type=button value=\"".LANGBT50."\" onclick=\"open('param8compteSupp.php?type=$type&saisie_idsupp=".$data[$i][0]."','_parent','');\" class=\"btn btn-primary btn-sm  vat-btn-footer\" ></td>\n";
	print "</tr>\n";
}
?>
</table>

		

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
